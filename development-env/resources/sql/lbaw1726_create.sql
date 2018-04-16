------------------------------------------
--Tables
------------------------------------------
--1

CREATE TABLE administrator (
    id SERIAL PRIMARY KEY,
    username text NOT NULL UNIQUE,
    password text NOT NULL
);

--2
CREATE TABLE country (
    id SERIAL PRIMARY KEY,
    countryName text NOT NULL UNIQUE
);


--3
CREATE TABLE member (
    id SERIAL PRIMARY KEY,
    address text,
    age SMALLINT NOT NULL,
    email text NOT NULL UNIQUE,
    name text NOT NULL,
    password text NOT NULL,
    paypalEmail text,
    phone text NOT NULL,
    postalCode text NOT NULL,
    username text NOT NULL UNIQUE,
    dateCreated TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    member_status text NOT NULL DEFAULT 'normal'::text,
    dateBanned TIMESTAMP WITH TIME zone DEFAULT NULL,
    dateSuspended TIMESTAMP WITH TIME zone DEFAULT NULL,
    dateTerminated  TIMESTAMP WITH TIME zone DEFAULT NULL,
    idCountry  INTEGER NOT NULL REFERENCES country(id),
    CONSTRAINT status_ck CHECK ((member_status = ANY (ARRAY['moderator'::text, 'suspended'::text, 'banned'::text, 'normal'::text, 'terminated'::text]))),
    CONSTRAINT age_ck CHECK (age>=18)
);



--4
CREATE TABLE requested_termination (
    id SERIAL PRIMARY KEY,
    dateRequested  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    idMember INTEGER NOT NULL REFERENCES member(id)
);

--6
CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    categoryName text NOT NULL UNIQUE
);

--7
CREATE TABLE publisher (
    id SERIAL PRIMARY KEY,
    publisherName  text NOT NULL UNIQUE
);

--8

CREATE TABLE language (
    id SERIAL PRIMARY KEY,
    languageName text NOT NULL UNIQUE
);


--5

CREATE TABLE auction (
    id SERIAL PRIMARY KEY,
    author  text NOT NULL,
    description  text NOT NULL,
    duration interval NOT NULL,
    ISBN  text NOT NULL,
    title  text NOT NULL,
    dateCreated TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    auction_status text NOT NULL DEFAULT 'waitingApproval'::text,
    dateApproved TIMESTAMP WITH TIME zone DEFAULT NULL,
    dateRemoved TIMESTAMP WITH TIME zone DEFAULT NULL,
    idPublisher INTEGER REFERENCES publisher(id),
    idLanguage INTEGER NOT NULL REFERENCES language(id),
    idSeller INTEGER NOT NULL REFERENCES member(id),
    CONSTRAINT auction_status_ck CHECK ((auction_status = ANY (ARRAY['approved'::text, 'removed'::text, 'waitingApproval'::text]))),
    CONSTRAINT duration_ck CHECK (duration >= '00:05:00'::interval)
);

--9

CREATE TABLE category_auction (
    idCategory INTEGER NOT NULL REFERENCES category(id),
    idAuction INTEGER NOT NULL REFERENCES auction(id),
    CONSTRAINT category_auction_pk PRIMARY KEY (idCategory, idAuction)
);

--10
CREATE TABLE whishlist (
    idBuyer INTEGER NOT NULL REFERENCES member(id),
    idAuction INTEGER NOT NULL REFERENCES auction(id),
    CONSTRAINT wish_list_pk PRIMARY KEY (idBuyer, idAuction)
);

--11
CREATE TABLE bid (
    idBuyer INTEGER NOT NULL REFERENCES member(id),
    idAuction INTEGER NOT NULL REFERENCES auction(id),
    bidDate TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    bidValue REAL,
    CONSTRAINT bid_value_ck CHECK (bidValue > 0.0),
    CONSTRAINT bid_pk PRIMARY KEY (idBuyer, idAuction)
);

--12
CREATE TABLE auction_modification (
    id SERIAL PRIMARY KEY,
    dateRequested TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    newDescription text,
    is_approved boolean,
    dateApproved TIMESTAMP WITH TIME zone,
    idApprovedAuction INTEGER NOT NULL REFERENCES auction(id)
);


--13
CREATE TABLE notification (
    id SERIAL PRIMARY KEY,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    information text,
    is_seen boolean DEFAULT FALSE,
    dateSeen TIMESTAMP WITH TIME zone,
    idMember INTEGER NOT NULL REFERENCES member(id)
);


--14

CREATE TABLE notification_auction (
    idAuction INTEGER NOT NULL REFERENCES auction(id),
    idNotification INTEGER NOT NULL REFERENCES notification(id),
    CONSTRAINT notification_auction_pk PRIMARY KEY (idAuction, idNotification)
);

--15
CREATE TABLE image (
    id SERIAL PRIMARY KEY,
    source text NOT NULL UNIQUE,
    idAuction  INTEGER REFERENCES auction(id),
    idAuctionModification  INTEGER REFERENCES auction_modification(id),
	idMember INTEGER REFERENCES member(id)
);

--16
CREATE TABLE message (
    id SERIAL PRIMARY KEY,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    message_text text NOT NULL,
    idSender INTEGER NOT NULL REFERENCES member(id),
    idReceiver INTEGER NOT NULL REFERENCES member(id),
    CONSTRAINT check_sender_receiver CHECK (idSender != idReceiver)
);

--17
CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    datePosted TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    liked boolean,
    comment_text text NOT NULL,
    is_removed boolean DEFAULT FALSE,
    idParent INTEGER REFERENCES comment(id),
    idSender INTEGER NOT NULL REFERENCES member(id),
    idReceiver INTEGER NOT NULL REFERENCES member(id),
    CONSTRAINT check_comment_parent CHECK (id != idParent)
);

-----------------------------------------------------
 --INDEXES
----------------------------------------------------

CREATE INDEX user_id ON member USING hash (id);

CREATE INDEX auction_id ON auction USING hash (id);

CREATE INDEX notification_id ON notification USING hash (id) WHERE is_seen = false;

CREATE INDEX bid_index ON bid USING btree (idBuyer, idAuction);

CREATE INDEX image_index ON image USING hash (id);

CREATE INDEX isbn_index ON auction USING hash (ISBN);

CREATE INDEX title_index ON auction USING GIST (to_tsvector('english', title));

CREATE INDEX author_index ON auction USING GIST (to_tsvector('english', author));


-----------------------------------------------------
 --TRIGGERS AND UDFs
----------------------------------------------------

CREATE FUNCTION check_number_of_row_admin() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF ((SELECT count(*) FROM administrator) > 0)
    THEN
        RAISE EXCEPTION 'There can be only one administrator';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_check_number_of_row_admin
  BEFORE INSERT ON administrator
  FOR EACH ROW
    EXECUTE PROCEDURE check_number_of_row_admin();


CREATE FUNCTION change_member_status() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM member WHERE NEW.id = member.id) THEN
	    IF NEW.member_status='banned' THEN
            NEW.dateBanned := now();
        ELSIF NEW.member_status='suspended' THEN
            NEW.dateSuspended:= now();
        ELSIF NEW.member_status='terminated' THEN
            NEW.dateTerminated:= now();
        END IF;
    END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_change_member_status
    BEFORE UPDATE ON member
        FOR EACH ROW
		      EXECUTE PROCEDURE change_member_status();


CREATE FUNCTION change_auction_status() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM auction WHERE NEW.id = auction.id) THEN
	    IF NEW.auction_status='approved' THEN
            NEW.dateApproved := now();
        ELSIF NEW.auction_status='removed' THEN
            NEW.dateRemoved:= now();
        END IF;
    END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_change_auction_status
    BEFORE UPDATE ON auction
        FOR EACH ROW
		      EXECUTE PROCEDURE change_auction_status();

CREATE FUNCTION check_buyer() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF EXISTS (SELECT * FROM auction WHERE NEW.idAuction = auction.id AND NEW.idBuyer = auction.idSeller) THEN
    RAISE EXCEPTION 'A User cant interact with is own auctions.';
  END IF;
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_whishlist_check_buyer
  BEFORE INSERT OR UPDATE ON whishlist
  FOR EACH ROW
    EXECUTE PROCEDURE check_buyer();

CREATE TRIGGER tr_bid_check_buyer
  BEFORE INSERT OR UPDATE ON bid
  FOR EACH ROW
    EXECUTE PROCEDURE check_buyer();


CREATE FUNCTION check_approved_auction() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF EXISTS (SELECT * FROM auction WHERE NEW.idApprovedAuction = auction.id AND auction.auction_status != 'approved') THEN
    RAISE EXCEPTION 'A User cant request an auction modification if its not approved.';
  END IF;
  RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_check_approved_auction
  BEFORE INSERT OR UPDATE ON auction_modification
  FOR EACH ROW
    EXECUTE PROCEDURE check_approved_auction();

CREATE FUNCTION change_auction_modification_is_approved() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM auction WHERE NEW.id = auction.id) THEN
	    IF NEW.is_approved=TRUE THEN
            NEW.dateApproved := now();
        END IF;
    END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_change_auction_modification_is_approved
    BEFORE UPDATE ON auction_modification
        FOR EACH ROW
		      EXECUTE PROCEDURE change_auction_modification_is_approved();
			  
CREATE FUNCTION image_auction_or_member() RETURNS TRIGGER AS
$BODY$
BEGIN
    
	IF (NEW.idMember!=NULL) AND (NEW.idAuction!=NULL OR NEW.idAuctionModification!= NULL) THEN
        RAISE EXCEPTION 'An image cant belong to an auction and an user';
    END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_image_auction_or_member
     BEFORE INSERT OR UPDATE ON image
        FOR EACH ROW
		      EXECUTE PROCEDURE image_auction_or_member();

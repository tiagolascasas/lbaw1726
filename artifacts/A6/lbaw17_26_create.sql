------------------------------------------
--Tables
------------------------------------------
--1

CREATE TABLE administrator (
    id SERIAL NOT NULL PRIMARY KEY,
    username text NOT NULL UNIQUE,
    password text NOT NULL
);

--2
CREATE TABLE country (
    id SERIAL NOT NULL PRIMARY KEY,
    countryName text NOT NULL UNIQUE
);

--3
CREATE TABLE member (
    id SERIAL NOT NULL PRIMARY KEY,
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
    idCountry  INTEGER NOT NULL,
    idImage  INTEGER,
    CONSTRAINT status_ck CHECK ((member_status = ANY (ARRAY['moderator'::text, 'suspended'::text, 'banned'::text, 'normal'::text, 'terminated'::text]))),
    CONSTRAINT age_ck CHECK (age>=18)
);


--4
CREATE TABLE requested_termination (
    id SERIAL NOT NULL PRIMARY KEY,
    dateRequested  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    idMember INTEGER NOT NULL
);

--5

CREATE TABLE auction (
    id SERIAL NOT NULL PRIMARY KEY,
    author  text NOT NULL,
    description  text NOT NULL,
    duration interval NOT NULL,
    ISBN  text NOT NULL,
    title  text NOT NULL,
    dateCreated TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    auction_status text NOT NULL DEFAULT 'waitingApproval'::text,
    dateApproved TIMESTAMP WITH TIME zone DEFAULT NULL,
    dateRemoved TIMESTAMP WITH TIME zone DEFAULT NULL,
    idPublisher INTEGER,
    idLanguage INTEGER NOT NULL,
    idSeller INTEGER NOT NULL,
    CONSTRAINT auction_status_ck CHECK ((auction_status = ANY (ARRAY['approved'::text, 'removed'::text, 'waitingApproval'::text]))),
    CONSTRAINT duration_ck CHECK (duration >= '00:05:00'::interval)
);

--6
CREATE TABLE category (
    id SERIAL NOT NULL PRIMARY KEY,
    categoryName text NOT NULL UNIQUE
);

--7
CREATE TABLE publisher (
    id SERIAL NOT NULL PRIMARY KEY,
    publisherName  text NOT NULL UNIQUE
);

--8

CREATE TABLE language (
    id SERIAL NOT NULL PRIMARY KEY,
    languageName text NOT NULL UNIQUE
);

--9

CREATE TABLE category_auction (
    idCategory INTEGER NOT NULL,
    idAuction INTEGER NOT NULL,
    CONSTRAINT categoryAuction_pk PRIMARY KEY (idCategory, idAuction)
);

--10
CREATE TABLE whishlist (
    idBuyer INTEGER NOT NULL,
    idAuction INTEGER NOT NULL,
    CONSTRAINT wishList_pk PRIMARY KEY (idBuyer, idAuction)
);

--11
CREATE TABLE bid (
    idBuyer INTEGER NOT NULL,
    idAuction INTEGER NOT NULL,
    bidDate TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    bidValue REAL,
    CONSTRAINT bidValue_ck CHECK (bidValue > 0.0),
    CONSTRAINT bid_pk PRIMARY KEY (idBuyer, idAuction)
);

--12
CREATE TABLE auction_modification (
    id SERIAL NOT NULL PRIMARY KEY,
    dateRequested TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    newDescription text,
    is_approved boolean,
    dateApproved TIMESTAMP WITH TIME zone,
    idApprovedAuction INTEGER NOT NULL
);


--13
CREATE TABLE notification (
    id SERIAL NOT NULL PRIMARY KEY,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    information text,
    is_seen boolean DEFAULT FALSE,
    dateSeen TIMESTAMP WITH TIME zone,
    idMember INTEGER NOT NULL
);


--14

CREATE TABLE notification_auction (
    idAuction INTEGER NOT NULL,
    idNotification INTEGER NOT NULL,
    CONSTRAINT notificationAuction_pk PRIMARY KEY (idAuction, idNotification)
);


--15
CREATE TABLE image (
    id SERIAL NOT NULL PRIMARY KEY,
    source text NOT NULL UNIQUE,
    idAuction  INTEGER,
    idAuctionModification  INTEGER
);

--16
CREATE TABLE message (
    id SERIAL NOT NULL PRIMARY KEY,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    message_text text NOT NULL,
    idSender INTEGER NOT NULL,
    idReceiver INTEGER NOT NULL
);

--17
CREATE TABLE comment (
    id SERIAL NOT NULL PRIMARY KEY,
    datePosted TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    liked boolean,
    comment_text text NOT NULL,
    is_removed boolean DEFAULT FALSE,
    idParent INTEGER,
    idSender INTEGER NOT NULL,
    idReceiver INTEGER NOT NULL
);


-----------------------------------------------------
 --FOREIGN KEYS
----------------------------------------------------

--3

ALTER TABLE ONLY member
    ADD CONSTRAINT member_id_country_fk FOREIGN KEY (idCountry) REFERENCES country(id) ON UPDATE CASCADE;

ALTER TABLE ONLY member
    ADD CONSTRAINT member_id_image_fk FOREIGN KEY (idImage) REFERENCES image(id) ON UPDATE CASCADE;

--4

ALTER TABLE ONLY requested_termination
    ADD CONSTRAINT requestedTermination_id_member_fk FOREIGN KEY (idMember) REFERENCES member(id) ON UPDATE CASCADE;

--5
ALTER TABLE ONLY auction
    ADD CONSTRAINT auction_id_publisher_fk FOREIGN KEY (idPublisher) REFERENCES publisher(id) ON UPDATE CASCADE;

ALTER TABLE ONLY auction
    ADD CONSTRAINT auction_id_language_fk FOREIGN KEY (idLanguage) REFERENCES language(id) ON UPDATE CASCADE;

ALTER TABLE ONLY auction
    ADD CONSTRAINT auction_id_seller_fk FOREIGN KEY (idSeller) REFERENCES member(id) ON UPDATE CASCADE;


--9
ALTER TABLE ONLY category_auction
    ADD CONSTRAINT categoryAuction_category_fk FOREIGN KEY (idCategory) REFERENCES "category"(id) ON UPDATE CASCADE;

ALTER TABLE ONLY category_auction
    ADD CONSTRAINT categoryAuction_auction_fk FOREIGN KEY (idAuction) REFERENCES auction(id) ON UPDATE CASCADE;

--10

ALTER TABLE ONLY whishlist
    ADD CONSTRAINT wishList_buyer_fk FOREIGN KEY (idBuyer) REFERENCES member(id) ON UPDATE CASCADE;

ALTER TABLE ONLY whishlist
    ADD CONSTRAINT wishList_auction_fk FOREIGN KEY (idAuction) REFERENCES auction(id) ON UPDATE CASCADE;

--11
ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_buyer_fk FOREIGN KEY (idBuyer) REFERENCES member(id) ON UPDATE CASCADE;

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_auction_fk FOREIGN KEY (idAuction) REFERENCES auction(id) ON UPDATE CASCADE;

--12

ALTER TABLE ONLY auction_modification
    ADD CONSTRAINT auctionModification_id_member_fk FOREIGN KEY (idApprovedAuction) REFERENCES auction(id) ON UPDATE CASCADE;

--13
ALTER TABLE ONLY notification
    ADD CONSTRAINT notification_id_member_fk FOREIGN KEY (idMember) REFERENCES member(id) ON UPDATE CASCADE;

--14

ALTER TABLE ONLY notification_auction
    ADD CONSTRAINT notificationAuction_notification_fk FOREIGN KEY (idNotification) REFERENCES notification(id) ON UPDATE CASCADE;

ALTER TABLE ONLY notification_auction
    ADD CONSTRAINT notificationAuction_auction_fk FOREIGN KEY (idAuction) REFERENCES auction(id) ON UPDATE CASCADE;

--15
ALTER TABLE ONLY image
    ADD CONSTRAINT image_auctionModification_fk FOREIGN KEY (idAuctionModification) REFERENCES auction_modification(id) ON UPDATE CASCADE;

ALTER TABLE ONLY image
    ADD CONSTRAINT image_auction_fk FOREIGN KEY (idAuction) REFERENCES auction(id) ON UPDATE CASCADE;

--16

ALTER TABLE ONLY message
    ADD CONSTRAINT message_sender_fk FOREIGN KEY (idSender) REFERENCES member(id) ON UPDATE CASCADE;

ALTER TABLE ONLY message
    ADD CONSTRAINT message_receiver_fk FOREIGN KEY (idReceiver) REFERENCES member(id) ON UPDATE CASCADE;

--17

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_parent_fk FOREIGN KEY (idParent) REFERENCES comment(id) ON UPDATE CASCADE;

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_sender_fk FOREIGN KEY (idSender) REFERENCES member(id) ON UPDATE CASCADE;

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_receiver_fk FOREIGN KEY (idReceiver) REFERENCES member(id) ON UPDATE CASCADE;



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

CREATE FUNCTION check_sender_receiver() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.idSender=NEW.idReceiver THEN
        RAISE EXCEPTION 'A User cant interact with himself';
    END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER tr_check_message_sender_receiber
   BEFORE INSERT OR UPDATE ON message
        FOR EACH ROW
		      EXECUTE PROCEDURE check_sender_receiver();

CREATE FUNCTION check_comment_parent() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NEW.id=NEW.idParent THEN
        RAISE EXCEPTION 'A comment cant follow itself';
    END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER tr_check_comment_parent
   BEFORE INSERT OR UPDATE ON comment
        FOR EACH ROW
		      EXECUTE PROCEDURE check_comment_parent(); 
         


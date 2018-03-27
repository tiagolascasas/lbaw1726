------------------------------------------
--Tables
------------------------------------------
--1
CREATE TABLE ADMINISTRATOR (
    id SERIAL NOT NULL PRIMARY KEY,
    username text NOT NULL UNIQUE,
    password text NOT NULL
);

--2
CREATE TABLE COUNTRY (
    id SERIAL NOT NULL PRIMARY KEY,
    countryName text NOT NULL UNIQUE
);

--3
CREATE TABLE MEMBER (
    id SERIAL NOT NULL PRIMARY KEY,
    "address" text,
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
    dateBanned TIMESTAMP WITH TIME zone NOT NULL,
    dateSuspended TIMESTAMP WITH TIME zone NOT NULL,
    dateTerminated  TIMESTAMP WITH TIME zone NOT NULL,
    idCountry  INTEGER NOT NULL,
    idImage  INTEGER,
    CONSTRAINT status_ck CHECK ((member_status = ANY (ARRAY['moderator'::text, 'suspended'::text, 'banned'::text, 'normal'::text, 'terminated'::text]))),
    CONSTRAINT age_ck CHECK (age>=18)
);


--4
CREATE TABLE REQUESTED_TERMINATION (
    id SERIAL NOT NULL PRIMARY KEY,
    dateRequested  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    idMember INTEGER NOT NULL
);

--5

CREATE TABLE AUCTION (
    id SERIAL NOT NULL PRIMARY KEY,
    author  text NOT NULL,
    description  text NOT NULL,
    duration interval NOT NULL,
    ISBN  text NOT NULL,
    title  text NOT NULL,
    dateCreated TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    auction_status text NOT NULL DEFAULT 'waitingApproval'::text,
    dateApproved TIMESTAMP WITH TIME zone NOT NULL,
    dateRemoved TIMESTAMP WITH TIME zone NOT NULL,
    idPublisher INTEGER,
    idLanguage INTEGER NOT NULL,
    idSeller INTEGER NOT NULL,
    CONSTRAINT auction_status_ck CHECK ((auction_status = ANY (ARRAY['approved'::text, 'removed'::text, 'banned'::text, 'waitingApproval'::text]))),
    CONSTRAINT duration_ck CHECK (duration > '00:05:00'::interval)
);

--6
CREATE TABLE CATEGORY (
    id SERIAL NOT NULL PRIMARY KEY,
    categoryName text NOT NULL UNIQUE
);

--7
CREATE TABLE PUBLISHER (
    id SERIAL NOT NULL PRIMARY KEY,
    publisherName  text NOT NULL UNIQUE
);

--8

CREATE TABLE LANGUAGE (
    id SERIAL NOT NULL PRIMARY KEY,
    "language" text NOT NULL UNIQUE
);

--9

CREATE TABLE CATEGORY_AUCTION (
    idCategory INTEGER NOT NULL,
    idAuction INTEGER NOT NULL,
    CONSTRAINT categoryAuction_pk PRIMARY KEY (idCategory, idAuction)
);

--10
CREATE TABLE WISHLIST (
    idBuyer INTEGER NOT NULL,
    idAuction INTEGER NOT NULL,
    CONSTRAINT wishList_pk PRIMARY KEY (idBuyer, idAuction)
);

--11
CREATE TABLE BID (
    idBuyer INTEGER NOT NULL,
    idAuction INTEGER NOT NULL,
    bidDate TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    bidValue REAL,
    CONSTRAINT bidValue_ck CHECK (bidValue > 0.0),
    CONSTRAINT bid_pk PRIMARY KEY (idBuyer, idAuction)
);

--12
CREATE TABLE AUCTION_MODIFICATION (
    id SERIAL NOT NULL PRIMARY KEY,
    dateRequested TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    newDescription text,
    is_approved boolean,
    dateApproved TIMESTAMP WITH TIME zone,
    idApprovedAuction INTEGER NOT NULL
);


--13
CREATE TABLE NOTIFICATION (
    id SERIAL NOT NULL PRIMARY KEY,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    information text,
    is_seen boolean DEFAULT FALSE,
    dateSeen TIMESTAMP WITH TIME zone,
    idMember INTEGER NOT NULL
);


--14

CREATE TABLE NOTIFICATION_AUCTION (
    idAuction INTEGER NOT NULL,
    idNotification INTEGER NOT NULL,
    CONSTRAINT notificationAuction_pk PRIMARY KEY (idAuction, idNotification)
);


--15
CREATE TABLE IMAGE (
    id SERIAL NOT NULL PRIMARY KEY,
    source text NOT NULL UNIQUE,
    idAuction  INTEGER,
    idAuctionModification  INTEGER
);

--16
CREATE TABLE MESSAGE (
    id SERIAL NOT NULL PRIMARY KEY,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    "text" text NOT NULL,
    idSender INTEGER NOT NULL,
    idReceiver INTEGER NOT NULL
);

--17
CREATE TABLE COMMENT (
    id SERIAL NOT NULL PRIMARY KEY,
    datePosted TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    liked boolean,
    "text" text NOT NULL,
    is_removed boolean DEFAULT FALSE,
    idParent INTEGER,
    idSender INTEGER NOT NULL,
    idReceiver INTEGER NOT NULL
);


-----------------------------------------------------
 --FOREIGN KEYS
----------------------------------------------------

--3

ALTER TABLE ONLY MEMBER
    ADD CONSTRAINT member_id_country_fk FOREIGN KEY (idCountry) REFERENCES COUNTRY(id) ON UPDATE CASCADE;

ALTER TABLE ONLY MEMBER
    ADD CONSTRAINT member_id_image_fk FOREIGN KEY (idImage) REFERENCES IMAGE(id) ON UPDATE CASCADE;

--4

ALTER TABLE ONLY REQUESTED_TERMINATION
    ADD CONSTRAINT requestedTermination_id_member_fk FOREIGN KEY (idMember) REFERENCES MEMBER(id) ON UPDATE CASCADE;

--5
ALTER TABLE ONLY AUCTION
    ADD CONSTRAINT auction_id_publisher_fk FOREIGN KEY (idPublisher) REFERENCES PUBLISHER(id) ON UPDATE CASCADE;

ALTER TABLE ONLY AUCTION
    ADD CONSTRAINT auction_id_language_fk FOREIGN KEY (idLanguage) REFERENCES LANGUAGE(id) ON UPDATE CASCADE;

ALTER TABLE ONLY AUCTION
    ADD CONSTRAINT auction_id_seller_fk FOREIGN KEY (idSeller) REFERENCES MEMBER(id) ON UPDATE CASCADE;


--9
ALTER TABLE ONLY CATEGORY_AUCTION
    ADD CONSTRAINT categoryAuction_category_fk FOREIGN KEY (idCategory) REFERENCES CATEGORY(id) ON UPDATE CASCADE;

ALTER TABLE ONLY CATEGORY_AUCTION
    ADD CONSTRAINT categoryAuction_auction_fk FOREIGN KEY (idAuction) REFERENCES AUCTION(id) ON UPDATE CASCADE;

--10

ALTER TABLE ONLY WISHLIST
    ADD CONSTRAINT wishList_buyer_fk FOREIGN KEY (idBuyer) REFERENCES MEMBER(id) ON UPDATE CASCADE;

ALTER TABLE ONLY WISHLIST
    ADD CONSTRAINT wishList_auction_fk FOREIGN KEY (idAuction) REFERENCES AUCTION(id) ON UPDATE CASCADE;

--11
ALTER TABLE ONLY BID
    ADD CONSTRAINT bid_buyer_fk FOREIGN KEY (idBuyer) REFERENCES MEMBER(id) ON UPDATE CASCADE;

ALTER TABLE ONLY BID
    ADD CONSTRAINT bid_auction_fk FOREIGN KEY (idAuction) REFERENCES AUCTION(id) ON UPDATE CASCADE;

--12

ALTER TABLE ONLY AUCTION_MODIFICATION
    ADD CONSTRAINT auctionModification_id_member_fk FOREIGN KEY (idApprovedAuction) REFERENCES AUCTION(id) ON UPDATE CASCADE;

--13
ALTER TABLE ONLY NOTIFICATION
    ADD CONSTRAINT notification_id_member_fk FOREIGN KEY (idMember) REFERENCES MEMBER(id) ON UPDATE CASCADE;

--14

ALTER TABLE ONLY NOTIFICATION_AUCTION
    ADD CONSTRAINT notificationAuction_notification_fk FOREIGN KEY (idNotification) REFERENCES NOTIFICATION(id) ON UPDATE CASCADE;

ALTER TABLE ONLY NOTIFICATION_AUCTION
    ADD CONSTRAINT notificationAuction_auction_fk FOREIGN KEY (idAuction) REFERENCES AUCTION(id) ON UPDATE CASCADE;

--15
ALTER TABLE ONLY IMAGE
    ADD CONSTRAINT image_auctionModification_fk FOREIGN KEY (idAuctionModification) REFERENCES AUCTION_MODIFICATION(id) ON UPDATE CASCADE;

ALTER TABLE ONLY IMAGE
    ADD CONSTRAINT image_auction_fk FOREIGN KEY (idAuction) REFERENCES AUCTION(id) ON UPDATE CASCADE;

--16

ALTER TABLE ONLY MESSAGE
    ADD CONSTRAINT message_sender_fk FOREIGN KEY (idSender) REFERENCES MEMBER(id) ON UPDATE CASCADE;

ALTER TABLE ONLY MESSAGE
    ADD CONSTRAINT message_receiver_fk FOREIGN KEY (idReceiver) REFERENCES MEMBER(id) ON UPDATE CASCADE;

--17

ALTER TABLE ONLY COMMENT
    ADD CONSTRAINT comment_parent_fk FOREIGN KEY (idParent) REFERENCES COMMENT(id) ON UPDATE CASCADE;

ALTER TABLE ONLY COMMENT
    ADD CONSTRAINT comment_sender_fk FOREIGN KEY (idSender) REFERENCES MEMBER(id) ON UPDATE CASCADE;

ALTER TABLE ONLY COMMENT
    ADD CONSTRAINT comment_receiver_fk FOREIGN KEY (idReceiver) REFERENCES MEMBER(id) ON UPDATE CASCADE;
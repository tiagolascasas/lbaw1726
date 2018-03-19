--1
CREATE TABLE Administrator (
    id SERIAL NOT NULL,
    username text NOT NULL,
    password text NOT NULL
);

ALTER TABLE ONLY Administrator
    ADD CONSTRAINT administrator_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Administrator
    ADD CONSTRAINT administrator_username_key UNIQUE (username);

--2
CREATE TABLE Country (
    id SERIAL NOT NULL,
    countryName text NOT NULL
);

ALTER TABLE ONLY Country
    ADD CONSTRAINT country_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Country
    ADD CONSTRAINT countryName_key UNIQUE (countryName);

--3
CREATE TABLE Member (
    id SERIAL NOT NULL,
    "address" text,
    age SMALLINT NOT NULL CHECK (age>=18),
    email text NOT NULL,
    name text NOT NULL,
    password text NOT NULL,
    paypalEmail text,
    phone text NOT NULL,
    postalCode text NOT NULL,
    username text NOT NULL,
    dateCreated TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    member_status NOT NULL DEFAULT 'normal'::text,
    dateBanned TIMESTAMP WITH TIME zone NOT NULL,
    dateSuspended TIMESTAMP WITH TIME zone NOT NULL,
    dateTerminated  TIMESTAMP WITH TIME zone NOT NULL,
    idCountry  INTEGER NOT NULL,
    idImage  INTEGER,
    CONSTRAINT status_ck CHECK ((member_status = ANY (ARRAY['moderator'::text, 'suspended'::text, 'banned'::text, 'normal'::text, 'terminated'::text])))
);

ALTER TABLE ONLY Member
    ADD CONSTRAINT member_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Member
    ADD CONSTRAINT member_key_email UNIQUE (email);

ALTER TABLE ONLY Member
    ADD CONSTRAINT member_key_username UNIQUE (username);

ALTER TABLE ONLY Member
    ADD CONSTRAINT member_id_country_fk FOREIGN KEY (idCountry) REFERENCES Country(id) ON UPDATE CASCADE;

ALTER TABLE ONLY Member
    ADD CONSTRAINT member_id_image_fk FOREIGN KEY (idImage) REFERENCES "Image"(id) ON UPDATE CASCADE;


--4
CREATE TABLE RequestedTermination (
    id SERIAL NOT NULL,
    dateRequested  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    idMember INTEGER NOT NULL 
);

ALTER TABLE ONLY RequestedTermination
    ADD CONSTRAINT requestedTermination_pkey PRIMARY KEY (id);

ALTER TABLE ONLY RequestedTermination
    ADD CONSTRAINT requestedTermination_id_member_fk FOREIGN KEY (idMember) REFERENCES Member(id) ON UPDATE CASCADE;

--5

CREATE TABLE Auction (
    id SERIAL NOT NULL,
    author  text NOT NULL,
    description  text NOT NULL,
    duration interval NOT NULL CHECK (duration > '00:05:00'::interval),
    ISBN  text NOT NULL,
    title  text NOT NULL,
    dateCreated TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    auction_status NOT NULL DEFAULT 'waitingApproval'::text,
    dateApproved TIMESTAMP WITH TIME zone NOT NULL,
    dateRemoved TIMESTAMP WITH TIME zone NOT NULL,
    idPublisher INTEGER,
    idLanguage INTEGER NOT NULL,
    idSeller INTEGER NOT NULL,
    CONSTRAINT auction_status_ck CHECK ((auction_status = ANY (ARRAY['approved'::text, 'removed'::text, 'banned'::text, 'waitingApproval'::text])))
);

ALTER TABLE ONLY Auction
    ADD CONSTRAINT auction_pkey PRIMARY KEY (id);


ALTER TABLE ONLY Auction
    ADD CONSTRAINT auction_id_publisher_fk FOREIGN KEY (idPublisher) REFERENCES Publisher(id) ON UPDATE CASCADE;

ALTER TABLE ONLY Auction
    ADD CONSTRAINT auction_id_language_fk FOREIGN KEY (idLanguage) REFERENCES "Language"(id) ON UPDATE CASCADE;    

ALTER TABLE ONLY Auction
    ADD CONSTRAINT auction_id_seller_fk FOREIGN KEY (idSeller) REFERENCES Member(id) ON UPDATE CASCADE;

--6
CREATE TABLE Category (
    id SERIAL NOT NULL,
    categoryName text NOT NULL
);

ALTER TABLE ONLY Category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Category
    ADD CONSTRAINT categoryName_key UNIQUE (categoryName);

--7
CREATE TABLE Publisher (
    id SERIAL NOT NULL,
    publisherName  text NOT NULL
);

ALTER TABLE ONLY Publisher
    ADD CONSTRAINT publisher_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Country
    ADD CONSTRAINT publisherName_key UNIQUE (publisherName);  

--8

CREATE TABLE "Language" (
    id SERIAL NOT NULL,
    "language" text NOT NULL
);

ALTER TABLE ONLY "Language"
    ADD CONSTRAINT language_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Country
    ADD CONSTRAINT language_key UNIQUE ("language");
--9

CREATE TABLE CategoryAuction (
    idCategory INTEGER NOT NULL,
    idAuction INTEGER NOT NULL
);

ALTER TABLE ONLY CategoryAuction
    ADD CONSTRAINT categoryAuction_pk PRIMARY KEY (idCategory, idAuction);         

ALTER TABLE ONLY CategoryAuction
    ADD CONSTRAINT categoryAuction_category_fk FOREIGN KEY (idCategory) REFERENCES Category(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY CategoryAuction
    ADD CONSTRAINT categoryAuction_auction_fk FOREIGN KEY (idAuction) REFERENCES Auction(id) ON UPDATE CASCADE;

--10
CREATE TABLE WishList (
    idBuyer INTEGER NOT NULL,
    idAuction INTEGER NOT NULL
);

ALTER TABLE ONLY WishList
    ADD CONSTRAINT wishList_pk PRIMARY KEY (idBuyer, idAuction);         

ALTER TABLE ONLY WishList
    ADD CONSTRAINT wishList_buyer_fk FOREIGN KEY (idBuyer) REFERENCES Member(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY WishList
    ADD CONSTRAINT wishList_auction_fk FOREIGN KEY (idAuction) REFERENCES Auction(id) ON UPDATE CASCADE;   

--11
CREATE TABLE Bid (
    idBuyer INTEGER NOT NULL,
    idAuction INTEGER NOT NULL,
    bidDate TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    bidValue REAL CHECK(bidValue > 0.0)
);

ALTER TABLE ONLY Bid
    ADD CONSTRAINT bid_pk PRIMARY KEY (idBuyer, idAuction);         

ALTER TABLE ONLY Bid
    ADD CONSTRAINT bid_buyer_fk FOREIGN KEY (idBuyer) REFERENCES Member(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY Bid
    ADD CONSTRAINT bid_auction_fk FOREIGN KEY (idAuction) REFERENCES Auction(id) ON UPDATE CASCADE; 


--12
CREATE TABLE AuctionModification (
    id SERIAL NOT NULL,
    dateRequested TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    newDescription text,
    is_approved boolean,
    dateApproved TIMESTAMP WITH TIME zone,
    idApprovedAuction INTEGER NOT NULL 
);

ALTER TABLE ONLY AuctionModification
    ADD CONSTRAINT auctionModification_pkey PRIMARY KEY (id);

ALTER TABLE ONLY AuctionModification
    ADD CONSTRAINT auctionModification_id_member_fk FOREIGN KEY (idApprovedAuction) REFERENCES Auction(id) ON UPDATE CASCADE;

--13
CREATE TABLE "Notification" (
    id SERIAL NOT NULL,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    information text,
    is_seen boolean DEFAULT FALSE,
    dateSeen TIMESTAMP WITH TIME zone,
    idMember INTEGER NOT NULL 
);

ALTER TABLE ONLY "Notification"
    ADD CONSTRAINT notification_pkey PRIMARY KEY (id);

ALTER TABLE ONLY "Notification"
    ADD CONSTRAINT notification_id_member_fk FOREIGN KEY (idMember) REFERENCES Member(id) ON UPDATE CASCADE;

--14

CREATE TABLE NotificationAuction (
    idAuction INTEGER NOT NULL,
    idNotification INTEGER NOT NULL
);

ALTER TABLE ONLY NotificationAuction
    ADD CONSTRAINT notificationAuction_pk PRIMARY KEY (idAuction, idNotification);         

ALTER TABLE ONLY NotificationAuction
    ADD CONSTRAINT notificationAuction_notification_fk FOREIGN KEY (idNotification) REFERENCES "Notification"(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY NotificationAuction
    ADD CONSTRAINT notificationAuction_auction_fk FOREIGN KEY (idAuction) REFERENCES Auction(id) ON UPDATE CASCADE;

--15
CREATE TABLE "Image" (
    id SERIAL NOT NULL,
    source text NOT NULL,    
    idAuction  INTEGER,
    idAuctionModification  INTEGER
);

ALTER TABLE ONLY "Image"
    ADD CONSTRAINT image_pk PRIMARY KEY (id);         

ALTER TABLE ONLY "Image"
    ADD CONSTRAINT image_auctionModification_fk FOREIGN KEY (idAuctionModification) REFERENCES AuctionModification(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY "Image"
    ADD CONSTRAINT image_auction_fk FOREIGN KEY (idAuction) REFERENCES Auction(id) ON UPDATE CASCADE;      

--16
CREATE TABLE "Message" (
    id SERIAL NOT NULL,
    dateSent TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    "text" text NOT NULL,    
    idSender INTEGER NOT NULL,
    idReceiver INTEGER NOT NULL
);

ALTER TABLE ONLY "Message"
    ADD CONSTRAINT message_pk PRIMARY KEY (id);         

ALTER TABLE ONLY "Message"
    ADD CONSTRAINT message_sender_fk FOREIGN KEY (idSender) REFERENCES Member(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY "Message"
    ADD CONSTRAINT message_receiver_fk FOREIGN KEY (idReceiver) REFERENCES Member(id) ON UPDATE CASCADE; 

--17
CREATE TABLE Comment (
    id SERIAL NOT NULL,
    datePosted TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    liked boolean,
    "text" text NOT NULL,
    is_removed boolean DEFAULT FALSE,    
    idParent INTEGER,
    idSender INTEGER NOT NULL,
    idReceiver INTEGER NOT NULL
);

ALTER TABLE ONLY Comment
    ADD CONSTRAINT comment_pk PRIMARY KEY (id);         

ALTER TABLE ONLY Comment
    ADD CONSTRAINT comment_parent_fk FOREIGN KEY (idParent) REFERENCES Comment(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY Comment
    ADD CONSTRAINT comment_sender_fk FOREIGN KEY (idSender) REFERENCES Member(id) ON UPDATE CASCADE;
 
ALTER TABLE ONLY Comment
    ADD CONSTRAINT comment_receiver_fk FOREIGN KEY (idReceiver) REFERENCES Member(id) ON UPDATE CASCADE;
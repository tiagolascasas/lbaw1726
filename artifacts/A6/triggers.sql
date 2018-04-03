CREATE FUNCTION check_number_of_row_admin() RETURNS TRIGGER AS 
$BODY$
BEGIN
  IF EXISTS (SELECT count(*) FROM administrator) > 1
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
    RAISE EXCEPTION 'A User cant interact with is own auctions.';
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
        RAISE EXCEPTION 'A User cant interact with himself himself';
    END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
 
CREATE TRIGGER tr_check_message_sender_receiber
   BEFORE INSERT OR UPDATE ON message
        FOR EACH ROW
		      EXECUTE PROCEDURE check_sender_receiver();

CREATE TRIGGER tr_check_comment_sender_receiber
   BEFORE INSERT OR UPDATE ON comment
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
         


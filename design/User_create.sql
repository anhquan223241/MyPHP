-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2016-07-13 15:39:40.816

-- tables
-- Table: checkin
CREATE TABLE checkin (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    date_checkin date NOT NULL,
    time_checkin time NOT NULL,
    date_modified datetime NULL,
    CONSTRAINT checkin_pk PRIMARY KEY (id)
);

-- Table: checkout
CREATE TABLE checkout (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    date_checkout date NOT NULL,
    time_checkout time NOT NULL,
    date_modified datetime NULL,
    CONSTRAINT checkout_pk PRIMARY KEY (id)
);

-- Table: log_history
CREATE TABLE log_history (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    login_time datetime NOT NULL,
    logout_time datetime NOT NULL,
    CONSTRAINT log_history_pk PRIMARY KEY (id)
);

-- Table: user
CREATE TABLE `user` (
    id int NOT NULL AUTO_INCREMENT,
    fullname varchar(50) NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(32) NOT NULL,
    email varchar(100) NOT NULL,
    role varchar(5) NOT NULL,
    date_created datetime NOT NULL,
    UNIQUE INDEX user_ak_1 (username),
    UNIQUE INDEX user_ak_2 (email),
    CONSTRAINT user_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: checkin_user (table: checkin)
ALTER TABLE checkin ADD CONSTRAINT checkin_user FOREIGN KEY checkin_user (user_id)
    REFERENCES `user` (id);

-- Reference: checkout_user (table: checkout)
ALTER TABLE checkout ADD CONSTRAINT checkout_user FOREIGN KEY checkout_user (user_id)
    REFERENCES `user` (id);

-- Reference: log_history_user (table: log_history)
ALTER TABLE log_history ADD CONSTRAINT log_history_user FOREIGN KEY log_history_user (user_id)
    REFERENCES `user` (id);

-- End of file.


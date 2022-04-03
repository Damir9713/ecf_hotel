CREATE DATABASE HOTEL;
USE HOTEL;
ALTER DATABASE HOTEL CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE admin (
                       id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       firstname_admin VARCHAR(50) NOT NULL,
                       lastname_admin VARCHAR(50) NOT NULL,
                       password text NOT NULL
) engine = innoDB;

CREATE TABLE establishment (
                               id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                               name VARCHAR(50) NOT NULL,
                               city VARCHAR(50) NOT NULL,
                               adress VARCHAR(50) NOT NULL,
                               description VARCHAR(250) NOT NULL,
                               photo varchar(255) null
) engine = innoDB;


CREATE TABLE manager (
                         manager_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                         firstname VARCHAR(50) NOT NULL,
                         lastname VARCHAR(50) NOT NULL,
                         email VARCHAR(250) NOT NULL,
                         password text NOT NULL,
                         establishment_id INT(11) NOT NULL,


                         FOREIGN KEY(establishment_id) REFERENCES  establishment (id) on delete cascade
) engine = innoDB;

CREATE TABLE suite (
                       suite_id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       Title VARCHAR(50) NOT NULL,
                       Price VARCHAR(50) NOT NULL,
                       description text NOT NULL,
                       establishment_id INT(11) NOT NULL,
                       manager_id INT(11) NOT NULL,
                       photo1 varchar(255) null,


                       FOREIGN KEY(establishment_id) REFERENCES  establishment (id) ON DELETE CASCADE,
                       FOREIGN KEY(manager_id) REFERENCES  manager (manager_id) ON DELETE CASCADE
) engine = innoDB;

CREATE TABLE CUSTOMER (
                          id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                          firstname VARCHAR(50) NOT NULL,
                          lastname VARCHAR(50) NOT NULL,
                          email VARCHAR(250) NOT NULL,
                          password text NOT NULL


) engine = innoDB;

CREATE TABLE reservation (
                             id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                             establishment_id INT(11) NOT NULL,
                             suite_id INT(11) NOT NULL,
                             customer_id int(11) NOT NULL,
                             beginningDate DATE NOT NULL,
                             endingDate DATE NOT NULL,

                             FOREIGN KEY(establishment_id) REFERENCES  establishment (id) ON DELETE CASCADE,
                             FOREIGN KEY(suite_id) REFERENCES  suite (suite_id) ON DELETE CASCADE,
                             FOREIGN KEY(customer_id) REFERENCES  customer (id) ON DELETE CASCADE
) engine = innoDB;



CREATE TABLE contactMessage (
                                id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                                subject varchar(250) NOT NULL,
                                description text NOT NULL,
                                firstname varchar(50) NOT NULL,
                                lastname varchar(50) NOT NULL,
                                email varchar(250) NOT NULL

) ENGINE =InnoDB;


mysqldump --user=root --password= --databases hotel  > sauvegarde_hotel.sql


delete from customer where id = 5;

UPDATE hotel.reservation
SET customer_id = '4'
WHERE id = 2;

select * from reservation
                  INNER JOIN establishment on hotel.reservation.establishment_id = establishment.id
where reservation.id = 2
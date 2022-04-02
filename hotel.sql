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



insert into establishment (id, name, city, adress, description) values (1, 'Realblab', 'Busdi', '39750 Prentice Trail', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.');
insert into establishment (id, name, city, adress, description) values (2, 'Meejo', 'Stutterheim', '2871 Raven Terrace', 'In congue. Etiam justo. Etiam pretium iaculis justo.

In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.

Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.');
insert into establishment (id, name, city, adress, description) values (3, 'Pixope', 'Alingsås', '0310 Ludington Terrace', 'In quis justo. Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet.');

insert into manager (manager_id, firstname, lastname, email, password, establishment_id) values (1, 'Miner', 'Ledram', 'mledram0@sitemeter.com', 'HAmcks7', 3);
insert into manager (manager_id, firstname, lastname, email, password, establishment_id) values (2, 'Braden', 'Mariel', 'bmariel1@kickstarter.com', 'olAiphOC', 2);
insert into manager (manager_id, firstname, lastname, email, password, establishment_id) values (3, 'Ian', 'Matusov', 'imatusov2@dropbox.com', 'sAf46H', 1);



insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (1, 'Western Tube Lichen', 508, 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.

Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', 2, 1);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (2, 'Brome-like Sedge', 473, 'Fusce consequat. Nulla nisl. Nunc nisl.

Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.', 3, 1);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (3, 'Canary Island Pine', 614, 'Sed ante. Vivamus tortor. Duis mattis egestas metus.', 3, 1);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (4, 'Rocky Mountain Lousewort', 973, 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.

Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.

Praesent blandit. Nam nulla. Integer pede justo, lacinia eget, tincidunt eget, tempus vel, pede.', 2, 3);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (5, 'Mid Bladderpod', 966, 'Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit.

Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.

Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.', 3, 2);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (6, 'Balloonplant', 347, 'Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.', 2, 1);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (7, 'Controverial Weissia Moss', 620, 'Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.', 2, 2);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (8, 'Dwarf Cupflower', 699, 'Integer ac leo. Pellentesque ultrices mattis odio. Donec vitae nisi.

Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.

Curabitur at ipsum ac tellus semper interdum. Mauris ullamcorper purus sit amet nulla. Quisque arcu libero, rutrum ac, lobortis vel, dapibus at, diam.', 1, 1);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (9, 'Western Tansymustard', 244, 'Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.', 3, 1);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (10, 'Yellow Joyweed', 762, 'Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.

Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.

In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.', 3, 2);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (11, 'Hueso Prieto', 949, 'Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque.

Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus.

In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.', 2, 2);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (12, 'Godfrey''s Thoroughwort', 317, 'Morbi porttitor lorem id ligula. Suspendisse ornare consequat lectus. In est risus, auctor sed, tristique in, tempus sit amet, sem.', 2, 2);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (13, 'Florestina', 599, 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.

In hac habitasse platea dictumst. Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo.

Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.', 3, 1);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (14, 'Red Elderberry', 612, 'Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.', 1, 3);
insert into suite (suite_id, Title, Price, description, establishment_id, manager_id) values (15, 'Willamette Fleabane', 251, 'In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.

Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.', 3, 3);




delete from customer where id = 5;

UPDATE hotel.reservation
SET customer_id = '4'
WHERE id = 2;

select * from reservation
                  INNER JOIN establishment on hotel.reservation.establishment_id = establishment.id
where reservation.id = 2
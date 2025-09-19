drop database if exists sql_injection;
create database sql_injection;
use sql_injection;

create table users (
	id int not null auto_increment,
	username varchar(100) not null,
	password varchar(100) not null,
	email varchar(100) not null,
	admin char(5) not null,
	PRIMARY KEY ( id )
);


insert into users (username, password, email, admin)
values ('user1', '5f4dcc3b5aa765d61d8327deb882cf99', 'user@gmail.com', 'false');
insert into users (username, password, email, admin)
values ('user2', '5f4dcc3b5aa765d61d8327deb882cf99', 'user2@hotmail.fr', 'false');
insert into users (username, password, email, admin)
values ('user3', '5f4dcc3b5aa765d61d8327deb882cf99', 'user3@yahoo.co.uk', 'false');
insert into users (username, password, email, admin)
values ('admin', 'd83374167372baf70c14ad4385447cae', 'admin@myforum.com', 'true');
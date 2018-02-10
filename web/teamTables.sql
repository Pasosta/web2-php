drop table if exists conferences, users, speakers, sessions, notes;

create table conferences(
	id serial primary key not null,
	month smallint not null,
	year smallint not null
);

create table users(
	id serial primary key not null,
	name varchar not null,
	password varchar not null
);

create table speakers(
	id serial primary key not null,
	name varchar not null
);

create table sessions(
	id serial primary key not null,
	conferenceId int not null references conferences,
	name varchar not null
);

create table notes(
	ID Serial Primary Key Not null,
	userId Int not null references users,
	sessionId Int not null references sessions,
	speakerId int not null references speakers,
	content text not null
);
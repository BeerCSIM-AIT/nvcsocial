-- create database nvc_social;

use nvc_social;

create table users (
	id BIGINT auto_increment not null,
	firstName varchar(50) not null,
	lastName varchar(50) not null,
	email varchar(100) not null,
	passwordHash varchar(32) not null,
	tel varchar(10) null,
	profilePicture varchar(255) null,
	gender enum('M','F'),
	status enum('new','approved','rejected','banned')not null default 'new',
	userRole enum('user','administrator') not null default'user',
	createdAt datetime not null default now(),
	updatedAt datetime null,
	unique (email),
	unique (tel),
	primary key (id)
);

create table post (
	id bigint auto_increment not null,
	userId bigint not null,
	message text not null,
	photo varchar(255) null,
	createdAt datetime not null default now(), 
	updatedAt datetime null,
	primary key (id),
	constraint foreign key fk_user (userId) references users(id)
	on delete cascade -- รกยกรฉรคยขยตรจร�รคยปร ยปรงยนยทร�ยด รฆ ยทร‘รฉยงยตร’ร�ร’ยงยทร•รจร�รฉร’ยงร�ร’
	on update cascade
);

create table friend (
	id bigint auto_increment not null,
	sourceId  bigint not null,
	targetId bigint not null,
	status enum('new','accepted','rejected','unfriended')not null default 'new', 
	createdAt datetime not null default now(),
	updatedAt datetime null,
	unique (sourceId,targetId),
	primary key (id),
	constraint foreign key fk_source (sourceId) references users(id)
		on delete cascade
		on update cascade,
	constraint foreign key fk_target (targetId) references users(id)
		on delete cascade
		on update cascade
);

create table comment (
	id bigint auto_increment not null,
	postId bigint not null,
	userId bigint not null,
	message text null,
	photo varchar(255) null,
	createdAt datetime not null default now(),
	updatedAt datetime null,
	primary key (id),
	constraint foreign key fk_comment_post (postId) references post(id)
		on delete cascade
		on update cascade,
	constraint foreign key fk_comment_user (userId) references users(id)
		on delete cascade
		on update cascade
);


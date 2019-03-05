create table if not exists ft_table (
	id int not null primary key unique auto_increment, 
	login varchar(8) not null default 'toto',
	`group` enum('staff', 'student', 'other') not null,
	creation_date date not null);

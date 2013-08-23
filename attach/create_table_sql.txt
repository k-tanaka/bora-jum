--
-- Web Project Specification(VBA)
--     Func: getCreateTableSQL()
--     Author: K.Sakou
--

--
-- Sheet Name: 1
-- Table Name: users
-- Column Count: 7
--
create table users(
    id mediumint primary key auto_increment not null,
    loginid varchar(32) not null,
    name varchar(32) not null,
    password varchar(256) not null,
    type int not null default 0,
    created_at timestamp not null,
    updated_at timestamp not null
);

--
-- Sheet Name: 2
-- Table Name: equipments
-- Column Count: 6
--
create table equipments(
    id mediumint primary key auto_increment not null,
    name varchar(32) not null,
    type int  default 0,
    quantity int  default 0,
    created_at timestamp not null,
    updated_at timestamp not null
);

--
-- Sheet Name: 3
-- Table Name: equipment_types
-- Column Count: 6
--
create table equipment_types(
    id mediumint primary key auto_increment not null,
    parent_id int not null default 0,
    level int not null default 0,
    name varchar(32) not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

--
-- Sheet Name: 4
-- Table Name: equipment_options
-- Column Count: 5
--
create table equipment_options(
    id mediumint primary key auto_increment not null,
    equipment_type_id int not null default 0,
    caption varchar(32) not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

--
-- Sheet Name: 5
-- Table Name: equipment_option_datas
-- Column Count: 6
--
create table equipment_option_datas(
    id mediumint primary key auto_increment not null,
    equipment_id int not null default 0,
    equipment_option_id int not null default 0,
    value varchar(255) not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

--
-- Sheet Name: 6
-- Table Name: usages
-- Column Count: 6
--
create table usages(
    id mediumint primary key auto_increment not null,
    equipment_id int not null default 0,
    type int not null default 0,
    quantity int  default 0,
    created_at timestamp not null,
    updated_at timestamp not null
);

--
-- Sheet Name: 7
-- Table Name: usage_types
-- Column Count: 4
--
create table usage_types(
    id mediumint primary key auto_increment not null,
    name varchar(32) not null,
    created_at timestamp not null,
    updated_at timestamp not null
);

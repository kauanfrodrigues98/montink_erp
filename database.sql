drop database if exists montink_erp;

create database montink_erp;

use montink_erp;

create table if not exists products (
                                        id int primary key auto_increment,
                                        uuid char(36) default(UUID()),
    name varchar(250),
    description varchar(250),
    buy_price decimal(20,2),
    sell_price decimal(20, 2),
    created_at datetime default(now()),
    updated_at datetime default(now()),
    deleted_at datetime
    );

create table if not exists orders (
                                      id int primary key auto_increment,
                                      uuid char(36) default(UUID()),
    product_id int,
    client_id int,
    created_at datetime default(now()),
    updated_at datetime default(now()),
    deleted_at datetime,
    foreign key (product_id) references products(id)
    );

create table if not exists coupons (
                                       id int primary key auto_increment,
                                       uuid char(36) default(UUID()),
    code varchar(250),
    discount decimal(20,2),
    min_price decimal(20,2),
    valid_at date,
    active boolean default(1),
    created_at datetime default(now()),
    updated_at datetime default(now()),
    deleted_at datetime
    );

create table if not exists stock (
                                     id int primary key auto_increment,
                                     product_id int,
                                     quantity integer,
                                     created_at datetime default(now()),
    updated_at datetime default(now()),
    deleted_at datetime,
    foreign key (product_id) references products(id)
    );
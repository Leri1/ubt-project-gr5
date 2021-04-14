CREATE TABLE users(
    `id` int AUTO_INCREMENT primary key,
    `firstname` varchar(155) not null,
    `lastname` varchar(155) not null,
    `email` varchar(155) not null,
    `password` varchar(155) not null,
    `gender` varchar(10) not null,
    `birthday` date not null
)

CREATE TABLE contacts(
    `id` int AUTO_INCREMENT primary key,
    `firstname` varchar(155) not null,
    `lastname` varchar(155) not null,
    `email` varchar(155) not null,
    `message` text not null,
    `created_at` datetime default CURRENT_TIMESTAMP()
)

CREATE TABLE services(
   `id` int AUTO_INCREMENT primary key,
   `service_title` varchar(155) not null,
   `service_description` text,
   `created_at` datetime default CURRENT_TIMESTAMP()
)
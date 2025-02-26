CREATE TABLE `message` (
    `id` int(15) NOT NULL AUTO_INCREMENT, 
    `pseudo` varchar(25) NOT NULL, 
    `msg` varchar(4096) NOT NULL, 
    `date` TIMESTAMP NOT NULL,
    PRIMARY KEY(`id`)
);
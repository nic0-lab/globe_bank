-- subjects table
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE subjects (
id int(11) NOT NULL AUTO_INCREMENT,
menu_name varchar(255),
position int(3),
visible tinyint(1),
primary key (id)
);

-- pages table
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
`id` int NOT NULL AUTO_INCREMENT,
`subject_id` int NOT NULL,
`menu_name` varchar(255) DEFAULT NULL,
`position` int DEFAULT NULL,
`visible` tinyint(1) DEFAULT NULL,
`content` varchar(500) DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT fk_subject_id
FOREIGN KEY (subject_id) 
REFERENCES subjects(id)
)

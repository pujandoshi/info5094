SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event`(
    id BIGINT NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description VARCHAR(500) NOT NULL,
    date TIMESTAMP NOT NULL,
    PRIMARY KEY(id)
) ENGINE=INNODB;

DROP TABLE IF EXISTS ticketclass;
CREATE TABLE ticketclass(
    id BIGINT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    capacity INT NOT NULL,
    parentEventId BIGINT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (parentEventId) REFERENCES event(id)
) ENGINE=INNODB;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

INSERT INTO `event` (`id`, `title`, `description`, `date`) VALUES (1, 'An event with limited seating', 'This event has only two seats in each seating class! Not only is it an intimate setting, but it\'s a great way to test your logic.', '2014-01-31 09:35:48');
INSERT INTO `event` (`id`, `title`, `description`, `date`) VALUES (2, 'A Standard concert', 'This event is your usual concert. Lights, noise, etc.', '2014-01-12 09:36:24');
INSERT INTO `event` (`id`, `title`, `description`, `date`) VALUES (3, 'Foobar I', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2013-10-31 09:36:41');
INSERT INTO `event` (`id`, `title`, `description`, `date`) VALUES (4, 'Foobar II', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2013-12-31 09:37:18');

INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (1, 'Upper bowl', 49.99, 2, 1);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (2, 'Lower bowl', 99.99, 2, 1);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (3, 'Standing room', 149.99, 2, 1);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (4, 'Upper bowl', 29.99, 150, 2);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (5, 'Lower bowl', 69.99, 100, 2);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (6, 'Standing room', 89.99, 50, 2);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (7, 'Upper bowl', 29.99, 150, 3);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (8, 'Lower bowl', 69.99, 100, 3);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (9, 'Standing room', 89.99, 50, 3);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (10, 'Upper bowl', 29.99, 150, 4);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (11, 'Lower bowl', 69.99, 100, 4);
INSERT INTO `ticketclass` (`id`, `name`, `price`, `capacity`, `parentEventId`) VALUES (12, 'Standing room', 89.99, 50, 4);
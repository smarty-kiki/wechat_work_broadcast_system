# up
CREATE TABLE IF NOT EXISTS `robot` (
    `id` bigint(20) UNSIGNED NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `name` varchar(15) DEFAULT NULL,
    `description` varchar(200) DEFAULT NULL,
    `webhook_url` varchar(1000) DEFAULT NULL,
    `application_id` bigint(20) UNSIGNED NOT NULL,
    KEY `fk_application_idx` (`application_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `robot`;

# up
CREATE TABLE IF NOT EXISTS `application` (
    `id` bigint(20) UNSIGNED NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `name` varchar(15) DEFAULT NULL,
    `agent_id` int(11) NOT NULL DEFAULT 0,
    `secret` varchar(50) DEFAULT NULL,
    `token` varchar(50) DEFAULT NULL,
    `encoding_aes_key` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `application`;

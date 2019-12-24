# up
CREATE TABLE IF NOT EXISTS `keyword_category` (
    `id` bigint(20) UNSIGNED NOT NULL,
    `version` int(11) NOT NULL,
    `create_time` datetime DEFAULT NULL,
    `update_time` datetime DEFAULT NULL,
    `delete_time` datetime DEFAULT NULL,
    `name` varchar(15) DEFAULT NULL,
    `parent_keyword_category_id` bigint(20) UNSIGNED NOT NULL,
    KEY `fk_parent_keyword_category_keyword_category_idx` (`parent_keyword_category_id`, `delete_time`),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# down
drop table `keyword_category`;

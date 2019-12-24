<?php

spl_autoload_register(function ($class_name) {

    $class_maps = [
        'application_dao' => 'dao/application.php',
        'keyword_dao' => 'dao/keyword.php',
        'keyword_category_dao' => 'dao/keyword_category.php',
        'subject_keyword_link_dao' => 'dao/subject_keyword_link.php',
        'robot_dao' => 'dao/robot.php',
        'subject_category_dao' => 'dao/subject_category.php',
        'subject_dao' => 'dao/subject.php',
        'application' => 'entity/application.php',
        'keyword' => 'entity/keyword.php',
        'keyword_category' => 'entity/keyword_category.php',
        'subject_keyword_link' => 'entity/subject_keyword_link.php',
        'robot' => 'entity/robot.php',
        'subject_category' => 'entity/subject_category.php',
        'subject' => 'entity/subject.php',
    ];

    if (isset($class_maps[$class_name])) {
        include __DIR__.'/'.$class_maps[$class_name];
    }
});

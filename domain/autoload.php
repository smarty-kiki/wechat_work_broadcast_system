<?php

spl_autoload_register(function ($class_name) {

    $class_maps = [
        'application_dao' => 'dao/application.php',
        'keyword_dao' => 'dao/keyword.php',
        'category_dao' => 'dao/category.php',
        'robot_dao' => 'dao/robot.php',
        'fruit_dao' => 'dao/fruit.php',
        'application' => 'entity/application.php',
        'keyword' => 'entity/keyword.php',
        'category' => 'entity/category.php',
        'robot' => 'entity/robot.php',
        'fruit' => 'entity/fruit.php',
    ];

    if (isset($class_maps[$class_name])) {
        include __DIR__.'/'.$class_maps[$class_name];
    }
});

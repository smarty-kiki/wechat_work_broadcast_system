<?php

if_get('/', function ()
{
    return render('index/index', [
        'tree_infos' => [
            [
                'name' => '表单式管理',
                'key'  => 'module',
                'icon_class' => 'layui-icon-component',
                'children' => [
                    //[ 'name' => '群机器人管理', 'key' => 'robot', 'href' => '/robots', ],
                    [ 'name' => '关键词管理', 'key' => 'keyword', 'href' => '/keywords', ],
                    [ 'name' => '水果名管理', 'key' => 'fruit', 'href' => '/fruits', ],
                    [ 'name' => '语义分类管理', 'key' => 'category', 'href' => '/categories', ],
                    //[ 'name' => '应用管理', 'key' => 'application', 'href' => '/applications', ],
                ],
            ]
        ],
    ]);
});

if_get('/dashboard', function ()
{
    return render('index/dashboard');
});

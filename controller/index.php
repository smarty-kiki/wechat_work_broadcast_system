<?php

if_get('/', function ()
{
    return render('index/index', [
        'tree_infos' => [
            [
                'name' => '模块',
                'key'  => 'module',
                'icon_class' => 'layui-icon-component',
                'children' => [
                    [
                        'name' => '页面',
                        'key'  => 'page',
                        'href'  => '/pages',
                    ],
                ],
            ]
        ],
    ]);
});

if_get('/dashboard', function ()
{
    return 'dashboard';
});

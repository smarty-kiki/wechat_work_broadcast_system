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
                ],
            ]
        ],
    ]);
});

if_get('/dashboard', function ()
{
    return 'dashboard';
});

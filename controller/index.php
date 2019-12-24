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
                    [ 'name' => '主体与关键词关联管理', 'key' => 'subject_keyword_link', 'href' => '/subject_keyword_links', ],
                    [ 'name' => '主体分类管理', 'key' => 'subject_category', 'href' => '/subject_categories', ],
                    [ 'name' => '主体名管理', 'key' => 'subject', 'href' => '/subjects', ],
                    [ 'name' => '群机器人管理', 'key' => 'robot', 'href' => '/robots', ],
                    [ 'name' => '关键词分类管理', 'key' => 'keyword_category', 'href' => '/keyword_categories', ],
                    [ 'name' => '关键词管理', 'key' => 'keyword', 'href' => '/keywords', ],
                    [ 'name' => '应用管理', 'key' => 'application', 'href' => '/applications', ],
                ],
            ]
        ],
    ]);
});

if_get('/dashboard', function ()
{
    return render('index/dashboard');
});

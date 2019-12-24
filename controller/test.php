<?php

if_post('/ajax_test', function ()
{
    $content = input('content');

    $fruits = dao('fruit')->find_all();

    $matched_fruit_names = [];

    foreach ($fruits as $fruit) {

        if (false !== mb_stristr($content, $fruit->name)) {

            $matched_fruit_names[] = $fruit->name;
        }
    }

    $matched_keywords = [];

    if ($matched_fruit_names) {

        $keywords = dao('keyword')->find_all();

        foreach ($keywords as $keyword) {

            if (false !== mb_stristr($content, $keyword->name)) {

                $matched_keywords[] = $keyword;
            }
        }
    }

    $res_infos = [];
    foreach ($matched_fruit_names as $fruit_name) {
        foreach ($matched_keywords as $keyword) {
            $res_infos[] = [
                'fruit' => $fruit_name,
                'keyword' => $keyword->name,
                'category' => $keyword->category->display_for_keywords_category(),
            ];
        }
    }

    return [
        'code' => 0,
        'msg' => '',
        'data' => $res_infos,
    ];
});

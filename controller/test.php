<?php

if_post('/ajax_test', function ()
{
    $content = input('content');

    $subjects = dao('subject')->find_all();

    $matched_subject_names = [];

    foreach ($subjects as $subject) {

        if (false !== mb_stristr($content, $subject->name)) {

            $matched_subject_names[] = $subject->name;
        }
    }

    $matched_keywords = [];

    if ($matched_subject_names) {

        $keywords = dao('keyword')->find_all();

        foreach ($keywords as $keyword) {

            if (false !== mb_stristr($content, $keyword->name)) {

                $matched_keywords[] = $keyword;
            }
        }
    }

    $res_infos = [];
    foreach ($matched_subject_names as $subject_name) {
        foreach ($matched_keywords as $keyword) {
            $res_infos[] = [
                'subject' => $subject_name,
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

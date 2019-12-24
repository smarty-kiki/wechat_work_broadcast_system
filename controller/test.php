<?php

if_post('/ajax_test', function ()
{
    $content = input('content');

    $res_infos = [];

    $subjects = dao('subject')->find_all();

    foreach ($subjects as $subject) {

        if (false !== mb_stristr($content, $subject->name)) {

            $subject_keyword_links = $subject->subject_category->get_subject_keyword_links_of_self_and_parents();

            $keyword_categories = relationship_batch_load($subject_keyword_links, 'keyword_category');

            $keywords = [];

            foreach ($keyword_categories as $keyword_category) {

                $keywords += $keyword_category->get_keywords_of_self_and_childrens();
            }

            foreach ($keywords as $keyword) {

                if (false !== mb_stristr($content, $keyword->name)) {

                    $res_infos[] = [
                        'subject_category' => $subject->subject_category->display_for_subjects_subject_category(),
                        'subject' => $subject->name,
                        'keyword' => $keyword->name,
                        'category' => $keyword->keyword_category->display_for_keywords_keyword_category(),
                    ];
                }
            }
        }
    }

    $subject_categories = dao('subject_category')->find_all();

    foreach ($subject_categories as $subject_category) {

        if (false !== mb_stristr($content, $subject_category->name)) {

            $subject_keyword_links = $subject_category->get_subject_keyword_links_of_self_and_parents();

            $keyword_categories = relationship_batch_load($subject_keyword_links, 'keyword_category');

            $keywords = [];

            foreach ($keyword_categories as $keyword_category) {

                $keywords += $keyword_category->get_keywords_of_self_and_childrens();
            }

            foreach ($keywords as $keyword) {

                if (false !== mb_stristr($content, $keyword->name)) {

                    $res_infos[] = [
                        'subject_category' => $subject_category->display_for_subjects_subject_category(),
                        'subject' => '',
                        'keyword' => $keyword->name,
                        'category' => $keyword->keyword_category->display_for_keywords_keyword_category(),
                    ];
                }
            }
        }
    }

    return [
        'code' => 0,
        'msg' => '',
        'data' => $res_infos,
    ];
});

<?php

if_get('/subject_keyword_links', function ()
{/*{{{*/
    return render('subject_keyword_link/list');
});/*}}}*/

if_get('/subject_keyword_links/ajax', function ()
{/*{{{*/
    list(
        $inputs['subject_category_id'], $inputs['keyword_category_id']
    ) = input_list(
        'subject_category_id', 'keyword_category_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $subject_keyword_links = dao('subject_keyword_link')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($subject_keyword_links),
        'data' => array_build($subject_keyword_links, function ($id, $subject_keyword_link) {
            return [
                null,
                [
                    'id' => $subject_keyword_link->id,
                    'subject_category_display' => $subject_keyword_link->subject_category->display_for_subject_keyword_links_subject_category(),
                    'keyword_category_display' => $subject_keyword_link->keyword_category->display_for_subject_keyword_links_keyword_category(),
                    'create_time' => $subject_keyword_link->create_time,
                    'update_time' => $subject_keyword_link->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/subject_keyword_links/add', function ()
{/*{{{*/
    return render('subject_keyword_link/add', [
        'subject_categories' => dao('subject_category')->find_all(),
        'keyword_categories' => dao('keyword_category')->find_all(),
    ]);
});/*}}}*/

if_post('/subject_keyword_links/add', function ()
{/*{{{*/
    $subject_keyword_link = subject_keyword_link::create(
        input_entity('subject_category', null, 'subject_category_id'),
        input_entity('keyword_category', null, 'keyword_category_id')
    );

    return redirect('/subject_keyword_links');
});/*}}}*/

//todo::detail

if_get('/subject_keyword_links/update/*', function ($subject_keyword_link_id)
{/*{{{*/
    $subject_keyword_link = dao('subject_keyword_link')->find($subject_keyword_link_id);
    otherwise($subject_keyword_link->is_not_null(), 'subject_keyword_link not found');

    return render('subject_keyword_link/update', [
        'subject_keyword_link' => $subject_keyword_link,
        'subject_categories' => dao('subject_category')->find_all(),
        'keyword_categories' => dao('keyword_category')->find_all(),
    ]);
});/*}}}*/

if_post('/subject_keyword_links/update/*', function ($subject_keyword_link_id)
{/*{{{*/
    $subject_keyword_link = dao('subject_keyword_link')->find($subject_keyword_link_id);
    otherwise($subject_keyword_link->is_not_null(), 'subject_keyword_link not found');

    $subject_keyword_link->subject_category = input_entity('subject_category', null, 'subject_category_id');
    $subject_keyword_link->keyword_category = input_entity('keyword_category', null, 'keyword_category_id');

    return redirect('/subject_keyword_links');
});/*}}}*/

if_post('/subject_keyword_links/delete/*', function ($subject_keyword_link_id)
{/*{{{*/
    $subject_keyword_link = dao('subject_keyword_link')->find($subject_keyword_link_id);
    otherwise($subject_keyword_link->is_not_null(), 'subject_keyword_link not found');

    $subject_keyword_link->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

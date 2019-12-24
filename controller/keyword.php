<?php

if_get('/keywords', function ()
{/*{{{*/
    return render('keyword/list');
});/*}}}*/

if_get('/keywords/ajax', function ()
{/*{{{*/
    list(
        $inputs['name'], $inputs['category_id']
    ) = input_list(
        'name', 'category_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $keywords = dao('keyword')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($keywords),
        'data' => array_build($keywords, function ($id, $keyword) {
            return [
                null,
                [
                    'id' => $keyword->id,
                    'name' => $keyword->name,
                    'category_display' => $keyword->category->display_for_keywords_category(),
                    'create_time' => $keyword->create_time,
                    'update_time' => $keyword->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/keywords/add', function ()
{/*{{{*/
    return render('keyword/add', [
        'categories' => dao('category')->find_all(),
    ]);
});/*}}}*/

if_post('/keywords/add', function ()
{/*{{{*/
    $keyword = keyword::create(
        input_entity('category', null, 'category_id'),
        input('name')
    );

    return redirect('/keywords');
});/*}}}*/

//todo::detail

if_get('/keywords/update/*', function ($keyword_id)
{/*{{{*/
    $keyword = dao('keyword')->find($keyword_id);
    otherwise($keyword->is_not_null(), 'keyword not found');

    return render('keyword/update', [
        'keyword' => $keyword,
        'categories' => dao('category')->find_all(),
    ]);
});/*}}}*/

if_post('/keywords/update/*', function ($keyword_id)
{/*{{{*/
    $keyword = dao('keyword')->find($keyword_id);
    otherwise($keyword->is_not_null(), 'keyword not found');

    $keyword->category = input_entity('category', null, 'category_id');
    $keyword->name = input('name');

    return redirect('/keywords');
});/*}}}*/

if_post('/keywords/delete/*', function ($keyword_id)
{/*{{{*/
    $keyword = dao('keyword')->find($keyword_id);
    otherwise($keyword->is_not_null(), 'keyword not found');

    $keyword->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

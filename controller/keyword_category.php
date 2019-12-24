<?php

if_get('/keyword_categories', function ()
{/*{{{*/
    return render('keyword_category/list');
});/*}}}*/

if_get('/keyword_categories/ajax', function ()
{/*{{{*/
    list(
        $inputs['name'], $inputs['parent_keyword_category_id']
    ) = input_list(
        'name', 'parent_keyword_category_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $keyword_categories = dao('keyword_category')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($keyword_categories),
        'data' => array_build($keyword_categories, function ($id, $keyword_category) {
            return [
                null,
                [
                    'id' => $keyword_category->id,
                    'name' => $keyword_category->name,
                    'parent_keyword_category_display' => $keyword_category->parent_keyword_category->display_for_keyword_categories_parent_keyword_category(),
                    'create_time' => $keyword_category->create_time,
                    'update_time' => $keyword_category->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/keyword_categories/add', function ()
{/*{{{*/
    return render('keyword_category/add', [
        'parent_keyword_categories' => dao('keyword_category')->find_all(),
    ]);
});/*}}}*/

if_post('/keyword_categories/add', function ()
{/*{{{*/
    $keyword_category = keyword_category::create(
        input('name')
    );

    $keyword_category->parent_keyword_category = dao('keyword_category')->find(input('parent_keyword_category_id'));

    return redirect('/keyword_categories');
});/*}}}*/

//todo::detail

if_get('/keyword_categories/update/*', function ($keyword_category_id)
{/*{{{*/
    $keyword_category = dao('keyword_category')->find($keyword_category_id);
    otherwise($keyword_category->is_not_null(), 'keyword_category not found');

    return render('keyword_category/update', [
        'keyword_category' => $keyword_category,
        'parent_keyword_categories' => dao('keyword_category')->find_all(),
    ]);
});/*}}}*/

if_post('/keyword_categories/update/*', function ($keyword_category_id)
{/*{{{*/
    $keyword_category = dao('keyword_category')->find($keyword_category_id);
    otherwise($keyword_category->is_not_null(), 'keyword_category not found');

    $keyword_category->parent_keyword_category = dao('keyword_category')->find(input('parent_keyword_category_id'));
    $keyword_category->name = input('name');

    return redirect('/keyword_categories');
});/*}}}*/

if_post('/keyword_categories/delete/*', function ($keyword_category_id)
{/*{{{*/
    $keyword_category = dao('keyword_category')->find($keyword_category_id);
    otherwise($keyword_category->is_not_null(), 'keyword_category not found');

    $keyword_category->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

<?php

if_get('/categories', function ()
{/*{{{*/
    return render('category/list');
});/*}}}*/

if_get('/categories/ajax', function ()
{/*{{{*/
    list(
        $inputs['name'], $inputs['parent_category_id']
    ) = input_list(
        'name', 'parent_category_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $categories = dao('category')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($categories),
        'data' => array_build($categories, function ($id, $category) {
            return [
                null,
                [
                    'id' => $category->id,
                    'parent_category_display' => $category->parent_category->display_for_categories_parent_category(),
                    'name' => $category->name,
                    'create_time' => $category->create_time,
                    'update_time' => $category->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/categories/add', function ()
{/*{{{*/
    return render('category/add', [
        'parent_categories' => dao('category')->find_all(),
    ]);
});/*}}}*/

if_post('/categories/add', function ()
{/*{{{*/
    $category = category::create(
        input('name')
    );

    $category->parent_category = dao('category')->find(input('parent_category_id'));

    return redirect('/categories');
});/*}}}*/

//todo::detail

if_get('/categories/update/*', function ($category_id)
{/*{{{*/
    $category = dao('category')->find($category_id);
    otherwise($category->is_not_null(), 'category not found');

    return render('category/update', [
        'category' => $category,
        'parent_categories' => dao('category')->find_all(),
    ]);
});/*}}}*/

if_post('/categories/update/*', function ($category_id)
{/*{{{*/
    $category = dao('category')->find($category_id);
    otherwise($category->is_not_null(), 'category not found');

    $category->parent_category = dao('category')->find(input('parent_category_id'));
    $category->name = input('name');

    return redirect('/categories');
});/*}}}*/

if_post('/categories/delete/*', function ($category_id)
{/*{{{*/
    $category = dao('category')->find($category_id);
    otherwise($category->is_not_null(), 'category not found');

    $category->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

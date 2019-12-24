<?php

if_get('/subject_categories', function ()
{/*{{{*/
    return render('subject_category/list');
});/*}}}*/

if_get('/subject_categories/ajax', function ()
{/*{{{*/
    list(
        $inputs['name'], $inputs['parent_subject_category_id']
    ) = input_list(
        'name', 'parent_subject_category_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $subject_categories = dao('subject_category')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($subject_categories),
        'data' => array_build($subject_categories, function ($id, $subject_category) {
            return [
                null,
                [
                    'id' => $subject_category->id,
                    'name' => $subject_category->name,
                    'parent_subject_category_display' => $subject_category->parent_subject_category->display_for_subject_categories_parent_subject_category(),
                    'create_time' => $subject_category->create_time,
                    'update_time' => $subject_category->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/subject_categories/add', function ()
{/*{{{*/
    return render('subject_category/add', [
        'parent_subject_categories' => dao('subject_category')->find_all(),
    ]);
});/*}}}*/

if_post('/subject_categories/add', function ()
{/*{{{*/
    $subject_category = subject_category::create(
        input('name')
    );

    $subject_category->parent_subject_category = dao('subject_category')->find(input('parent_subject_category_id'));

    return redirect('/subject_categories');
});/*}}}*/

//todo::detail

if_get('/subject_categories/update/*', function ($subject_category_id)
{/*{{{*/
    $subject_category = dao('subject_category')->find($subject_category_id);
    otherwise($subject_category->is_not_null(), 'subject_category not found');

    return render('subject_category/update', [
        'subject_category' => $subject_category,
        'parent_subject_categories' => dao('subject_category')->find_all(),
    ]);
});/*}}}*/

if_post('/subject_categories/update/*', function ($subject_category_id)
{/*{{{*/
    $subject_category = dao('subject_category')->find($subject_category_id);
    otherwise($subject_category->is_not_null(), 'subject_category not found');

    $subject_category->parent_subject_category = dao('subject_category')->find(input('parent_subject_category_id'));
    $subject_category->name = input('name');

    return redirect('/subject_categories');
});/*}}}*/

if_post('/subject_categories/delete/*', function ($subject_category_id)
{/*{{{*/
    $subject_category = dao('subject_category')->find($subject_category_id);
    otherwise($subject_category->is_not_null(), 'subject_category not found');

    $subject_category->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

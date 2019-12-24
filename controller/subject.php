<?php

if_get('/subjects', function ()
{/*{{{*/
    return render('subject/list');
});/*}}}*/

if_get('/subjects/ajax', function ()
{/*{{{*/
    list(
        $inputs['name']
    ) = input_list(
        'name'
    );
    $inputs = array_filter($inputs, 'not_null');

    $subjects = dao('subject')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($subjects),
        'data' => array_build($subjects, function ($id, $subject) {
            return [
                null,
                [
                    'id' => $subject->id,
                    'name' => $subject->name,
                    'create_time' => $subject->create_time,
                    'update_time' => $subject->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/subjects/add', function ()
{/*{{{*/
    return render('subject/add', [
    ]);
});/*}}}*/

if_post('/subjects/add', function ()
{/*{{{*/
    $subject = subject::create(
        input('name')
    );

    return redirect('/subjects');
});/*}}}*/

//todo::detail

if_get('/subjects/update/*', function ($subject_id)
{/*{{{*/
    $subject = dao('subject')->find($subject_id);
    otherwise($subject->is_not_null(), 'subject not found');

    return render('subject/update', [
        'subject' => $subject,
    ]);
});/*}}}*/

if_post('/subjects/update/*', function ($subject_id)
{/*{{{*/
    $subject = dao('subject')->find($subject_id);
    otherwise($subject->is_not_null(), 'subject not found');

    $subject->name = input('name');

    return redirect('/subjects');
});/*}}}*/

if_post('/subjects/delete/*', function ($subject_id)
{/*{{{*/
    $subject = dao('subject')->find($subject_id);
    otherwise($subject->is_not_null(), 'subject not found');

    $subject->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

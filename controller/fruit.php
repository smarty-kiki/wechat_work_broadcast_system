<?php

if_get('/fruits', function ()
{/*{{{*/
    return render('fruit/list');
});/*}}}*/

if_get('/fruits/ajax', function ()
{/*{{{*/
    list(
        $inputs['name']
    ) = input_list(
        'name'
    );
    $inputs = array_filter($inputs, 'not_null');

    $fruits = dao('fruit')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($fruits),
        'data' => array_build($fruits, function ($id, $fruit) {
            return [
                null,
                [
                    'id' => $fruit->id,
                    'name' => $fruit->name,
                    'create_time' => $fruit->create_time,
                    'update_time' => $fruit->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/fruits/add', function ()
{/*{{{*/
    return render('fruit/add', [
    ]);
});/*}}}*/

if_post('/fruits/add', function ()
{/*{{{*/
    $fruit = fruit::create(
        input('name')
    );

    return redirect('/fruits');
});/*}}}*/

//todo::detail

if_get('/fruits/update/*', function ($fruit_id)
{/*{{{*/
    $fruit = dao('fruit')->find($fruit_id);
    otherwise($fruit->is_not_null(), 'fruit not found');

    return render('fruit/update', [
        'fruit' => $fruit,
    ]);
});/*}}}*/

if_post('/fruits/update/*', function ($fruit_id)
{/*{{{*/
    $fruit = dao('fruit')->find($fruit_id);
    otherwise($fruit->is_not_null(), 'fruit not found');

    $fruit->name = input('name');

    return redirect('/fruits');
});/*}}}*/

if_post('/fruits/delete/*', function ($fruit_id)
{/*{{{*/
    $fruit = dao('fruit')->find($fruit_id);
    otherwise($fruit->is_not_null(), 'fruit not found');

    $fruit->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

<?php

if_get('/robots', function ()
{/*{{{*/
    return render('robot/list');
});/*}}}*/

if_get('/robots/ajax', function ()
{/*{{{*/
    list(
        $inputs['name'], $inputs['description'], $inputs['webhook_url'], $inputs['application_id']
    ) = input_list(
        'name', 'description', 'webhook_url', 'application_id'
    );
    $inputs = array_filter($inputs, 'not_null');

    $robots = dao('robot')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($robots),
        'data' => array_build($robots, function ($id, $robot) {
            return [
                null,
                [
                    'id' => $robot->id,
                    'name' => $robot->name,
                    'description' => $robot->description,
                    'webhook_url' => $robot->webhook_url,
                    'application_display' => $robot->application->display_for_robots_application(),
                    'create_time' => $robot->create_time,
                    'update_time' => $robot->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/robots/add', function ()
{/*{{{*/
    return render('robot/add', [
        'applications' => dao('application')->find_all(),
    ]);
});/*}}}*/

if_post('/robots/add', function ()
{/*{{{*/
    $robot = robot::create(
        input('name'),
        input('description'),
        input('webhook_url')
    );

    $robot->application = dao('application')->find(input('application_id'));

    return redirect('/robots');
});/*}}}*/

//todo::detail

if_get('/robots/update/*', function ($robot_id)
{/*{{{*/
    $robot = dao('robot')->find($robot_id);
    otherwise($robot->is_not_null(), 'robot not found');

    return render('robot/update', [
        'robot' => $robot,
        'applications' => dao('application')->find_all(),
    ]);
});/*}}}*/

if_post('/robots/update/*', function ($robot_id)
{/*{{{*/
    $robot = dao('robot')->find($robot_id);
    otherwise($robot->is_not_null(), 'robot not found');

    $robot->application = dao('application')->find(input('application_id'));
    $robot->name = input('name');
    $robot->description = input('description');
    $robot->webhook_url = input('webhook_url');

    return redirect('/robots');
});/*}}}*/

if_post('/robots/delete/*', function ($robot_id)
{/*{{{*/
    $robot = dao('robot')->find($robot_id);
    otherwise($robot->is_not_null(), 'robot not found');

    $robot->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

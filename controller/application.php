<?php

if_get('/applications', function ()
{/*{{{*/
    return render('application/list');
});/*}}}*/

if_get('/applications/ajax', function ()
{/*{{{*/
    list(
        $inputs['name'], $inputs['agent_id'], $inputs['secret'], $inputs['token'], $inputs['encoding_aes_key']
    ) = input_list(
        'name', 'agent_id', 'secret', 'token', 'encoding_aes_key'
    );
    $inputs = array_filter($inputs, 'not_null');

    $applications = dao('application')->find_all_by_column($inputs);

    return [
        'code' => 0,
        'msg'  => '',
        'count' => count($applications),
        'data' => array_build($applications, function ($id, $application) {
            return [
                null,
                [
                    'id' => $application->id,
                    'name' => $application->name,
                    'agent_id' => $application->agent_id,
                    'secret' => $application->secret,
                    'token' => $application->token,
                    'encoding_aes_key' => $application->encoding_aes_key,
                    'create_time' => $application->create_time,
                    'update_time' => $application->update_time,
                ]
            ];
        }),
    ];
});/*}}}*/

if_get('/applications/add', function ()
{/*{{{*/
    return render('application/add', [
    ]);
});/*}}}*/

if_post('/applications/add', function ()
{/*{{{*/
    $application = application::create(
        input('name'),
        input('agent_id'),
        input('secret'),
        input('token'),
        input('encoding_aes_key')
    );

    return redirect('/applications');
});/*}}}*/

//todo::detail

if_get('/applications/update/*', function ($application_id)
{/*{{{*/
    $application = dao('application')->find($application_id);
    otherwise($application->is_not_null(), 'application not found');

    return render('application/update', [
        'application' => $application,
    ]);
});/*}}}*/

if_post('/applications/update/*', function ($application_id)
{/*{{{*/
    $application = dao('application')->find($application_id);
    otherwise($application->is_not_null(), 'application not found');

    $application->name = input('name');
    $application->agent_id = input('agent_id');
    $application->secret = input('secret');
    $application->token = input('token');
    $application->encoding_aes_key = input('encoding_aes_key');

    return redirect('/applications');
});/*}}}*/

if_post('/applications/delete/*', function ($application_id)
{/*{{{*/
    $application = dao('application')->find($application_id);
    otherwise($application->is_not_null(), 'application not found');

    $application->delete();

    return [
        'code' => 0,
        'msg' => '',
    ];
});/*}}}*/

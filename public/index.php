<?php

// init
include __DIR__.'/../bootstrap.php';
include FRAME_DIR.'/http/php_fpm/application.php';
include FRAME_DIR.'/view_compiler/blade.php';

view_path(VIEW_DIR.'/');
view_compiler(blade_view_compiler_generate());

set_error_handler('http_err_action', E_ALL);
set_exception_handler('http_ex_action');
register_shutdown_function('http_fatel_err_action');

if_has_exception(function ($ex) {

    log_exception($ex);

    if (is_ajax()) {

        return json([
            'code' => $ex->getCode() ?: 500,
            'msg'  => $ex->getMessage(),
            'data' => [],
        ]);
    } else {
        return $ex->getMessage();
    }
});

if_verify(function ($action, $args) {

    return unit_of_work(function () use ($action, $args){

        $data = call_user_func_array($action, $args);

        if (is_array($data)) {

            header('Content-type: application/json');

            return json($data);

        } else {

            header('Content-type: text/html');

            return $data;
        }
    });
});

// init interceptor

// init 404 handler
if_not_found(function () {
    return 404;
});

// init controller
include CONTROLLER_DIR.'/robot.php';
include CONTROLLER_DIR.'/keyword.php';
include CONTROLLER_DIR.'/fruit.php';
include CONTROLLER_DIR.'/category.php';
include CONTROLLER_DIR.'/application.php';
include CONTROLLER_DIR.'/test.php';
include CONTROLLER_DIR.'/index.php';

// fix
not_found();

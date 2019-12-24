<?php

class robot extends entity
{
    /* generated code start */
    public $structs = [
        'application_id' => 0,
        'name' => '',
        'description' => '',
        'webhook_url' => '',
    ];

    public static $entity_display_name = '群机器人';
    public static $entity_description = '群机器人';

    public static $struct_data_types = [
        'application_id' => 'number',
        'name' => 'string',
        'description' => 'string',
        'webhook_url' => 'string',
    ];

    public static $struct_display_names = [
        'application_id' => '应用ID',
        'name' => '名称',
        'description' => '描述',
        'webhook_url' => 'Webhook地址',
    ];

    public static $struct_descriptions = [
        'application_id' => '应用ID',
        'name' => '名称',
        'description' => '描述',
        'webhook_url' => 'URL',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('application');
    }/*}}}*/

    public static function create($name, $description, $webhook_url)
    {/*{{{*/
        $robot = parent::init();

        $robot->name = $name;
        $robot->description = $description;
        $robot->webhook_url = $webhook_url;

        return $robot;
    }/*}}}*/

    public static function struct_formaters($property)
    {/*{{{*/
        $formaters = [
            'name' => [
                [
                    'function' => function ($value) {
                        return mb_strlen($value) <= 15;
                    },
                    'failed_message' => '名称不能超过 15 个字',
                ],
            ],
            'description' => [
                [
                    'function' => function ($value) {
                        return mb_strlen($value) <= 200;
                    },
                    'failed_message' => '名称不能超过 200 个字',
                ],
            ],
            'webhook_url' => [
                [
                    'function' => function ($value) {
                        return mb_strlen($value) <= 1000;
                    },
                    'failed_message' => '不能超过 1000 个字符',
                ],
            ],
        ];

        return $formaters[$property] ?? false;
    }/*}}}*/

    public function belongs_to_application(application $application)
    {/*{{{*/
        return $this->application_id == $application->id;
    }/*}}}*/

    public function display_for_application_robots()
    {/*{{{*/
        return $this->name;
    }/*}}}*/
    /* generated code end */
}

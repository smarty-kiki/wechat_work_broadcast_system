<?php

class application extends entity
{
    /* generated code start */
    public $structs = [
        'name' => '',
        'agent_id' => 0,
        'secret' => '',
        'token' => '',
        'encoding_aes_key' => '',
    ];

    public static $entity_display_name = '应用';
    public static $entity_description = '应用';

    public static $struct_data_types = [
        'name' => 'string',
        'agent_id' => 'number',
        'secret' => 'string',
        'token' => 'string',
        'encoding_aes_key' => 'string',
    ];

    public static $struct_display_names = [
        'name' => '名称',
        'agent_id' => 'AgentId',
        'secret' => 'Secret',
        'token' => 'Token',
        'encoding_aes_key' => 'EncodingAESKey',
    ];

    public static $struct_descriptions = [
        'name' => '名称',
        'agent_id' => 'ID',
        'secret' => '密钥',
        'token' => '密钥',
        'encoding_aes_key' => '密钥',
    ];

    public function __construct()
    {/*{{{*/
        $this->has_many('robots', 'robot');
    }/*}}}*/

    public static function create($name, $agent_id, $secret, $token, $encoding_aes_key)
    {/*{{{*/
        $application = parent::init();

        $application->name = $name;
        $application->agent_id = $agent_id;
        $application->secret = $secret;
        $application->token = $token;
        $application->encoding_aes_key = $encoding_aes_key;

        return $application;
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
            'agent_id' => [
                [
                    'function' => function ($value) {
                        return mb_strlen($value) <= 11;
                    },
                    'failed_message' => 'ID 不能超过 15 个字',
                ],
                [
                    'function' => function ($value) {
                        return is_numeric($value);
                    },
                    'failed_message' => 'ID 必须为整数',
                ],
            ],
            'secret' => [
                [
                    'function' => function ($value) {
                        return mb_strlen($value) <= 50;
                    },
                    'failed_message' => '名称不能超过 50 个字',
                ],
            ],
            'token' => [
                [
                    'function' => function ($value) {
                        return mb_strlen($value) <= 50;
                    },
                    'failed_message' => '名称不能超过 50 个字',
                ],
            ],
            'encoding_aes_key' => [
                [
                    'function' => function ($value) {
                        return mb_strlen($value) <= 50;
                    },
                    'failed_message' => '名称不能超过 50 个字',
                ],
            ],
        ];

        return $formaters[$property] ?? false;
    }/*}}}*/

    public function delete()
    {/*{{{*/
        foreach ($this->robots as $robot) {
            $robot->application_id = 0;
        }

        parent::delete();
    }/*}}}*/

    public function display_for_robots_application()
    {/*{{{*/
        return $this->name;
    }/*}}}*/
    /* generated code end */
}

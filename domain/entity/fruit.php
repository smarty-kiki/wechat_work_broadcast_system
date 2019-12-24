<?php

class fruit extends entity
{
    /* generated code start */
    public $structs = [
        'name' => '',
    ];

    public static $entity_display_name = '水果名';
    public static $entity_description = '水果名';

    public static $struct_data_types = [
        'name' => 'string',
    ];

    public static $struct_display_names = [
        'name' => '名称',
    ];

    public static $struct_descriptions = [
        'name' => '名称',
    ];

    public function __construct()
    {/*{{{*/
    }/*}}}*/

    public static function create($name)
    {/*{{{*/
        $fruit = parent::init();

        $fruit->name = $name;

        return $fruit;
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
        ];

        return $formaters[$property] ?? false;
    }/*}}}*/
    /* generated code end */
}

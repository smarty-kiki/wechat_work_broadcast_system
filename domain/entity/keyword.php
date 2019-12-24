<?php

class keyword extends entity
{
    /* generated code start */
    public $structs = [
        'category_id' => '',
        'name' => '',
    ];

    public static $entity_display_name = '关键词';
    public static $entity_description = '关键词';

    public static $struct_data_types = [
        'category_id' => 'number',
        'name' => 'string',
    ];

    public static $struct_display_names = [
        'category_id' => '语义分类ID',
        'name' => '名称',
    ];

    public static $struct_descriptions = [
        'category_id' => '语义分类ID',
        'name' => '名称',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('category');
    }/*}}}*/

    public static function create(category $category, $name)
    {/*{{{*/
        $keyword = parent::init();

        $keyword->category = $category;
        $keyword->name = $name;

        return $keyword;
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

    public function belongs_to_category(category $category)
    {/*{{{*/
        return $this->category_id == $category->id;
    }/*}}}*/

    public function display_for_category_keywords()
    {/*{{{*/
        return $this->id;
    }/*}}}*/
    /* generated code end */
}

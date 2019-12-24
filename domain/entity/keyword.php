<?php

class keyword extends entity
{
    /* generated code start */
    public $structs = [
        'keyword_category_id' => 0,
        'name' => '',
    ];

    public static $entity_display_name = '关键词';
    public static $entity_description = '关键词';

    public static $struct_data_types = [
        'keyword_category_id' => 'number',
        'name' => 'string',
    ];

    public static $struct_display_names = [
        'keyword_category_id' => '关键词分类ID',
        'name' => '名称',
    ];

    public static $struct_descriptions = [
        'keyword_category_id' => '关键词分类ID',
        'name' => '名称',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('keyword_category');
    }/*}}}*/

    public static function create(keyword_category $keyword_category, $name)
    {/*{{{*/
        $keyword = parent::init();

        $keyword->keyword_category = $keyword_category;
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

    public function belongs_to_keyword_category(keyword_category $keyword_category)
    {/*{{{*/
        return $this->keyword_category_id == $keyword_category->id;
    }/*}}}*/

    public function display_for_keyword_category_keywords()
    {/*{{{*/
        return $this->id;
    }/*}}}*/
    /* generated code end */
}

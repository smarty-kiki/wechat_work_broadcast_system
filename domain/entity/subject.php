<?php

class subject extends entity
{
    /* generated code start */
    public $structs = [
        'subject_category_id' => 0,
        'name' => '',
    ];

    public static $entity_display_name = '主体名';
    public static $entity_description = '主体名';

    public static $struct_data_types = [
        'subject_category_id' => 'number',
        'name' => 'string',
    ];

    public static $struct_display_names = [
        'subject_category_id' => '主体分类ID',
        'name' => '名称',
    ];

    public static $struct_descriptions = [
        'subject_category_id' => '主体分类ID',
        'name' => '名称',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('subject_category');
    }/*}}}*/

    public static function create(subject_category $subject_category, $name)
    {/*{{{*/
        $subject = parent::init();

        $subject->subject_category = $subject_category;
        $subject->name = $name;

        return $subject;
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

    public function belongs_to_subject_category(subject_category $subject_category)
    {/*{{{*/
        return $this->subject_category_id == $subject_category->id;
    }/*}}}*/

    public function display_for_subject_category_subjects()
    {/*{{{*/
        return $this->name;
    }/*}}}*/
    /* generated code end */
}

<?php

class subject_keyword_link extends entity
{
    /* generated code start */
    public $structs = [
        'subject_category_id' => 0,
        'keyword_category_id' => 0,
    ];

    public static $entity_display_name = '主体与关键词关联';
    public static $entity_description = '主体与关键词关联';

    public static $struct_data_types = [
        'subject_category_id' => 'number',
        'keyword_category_id' => 'number',
    ];

    public static $struct_display_names = [
        'subject_category_id' => '主体分类ID',
        'keyword_category_id' => '关键词分类ID',
    ];

    public static $struct_descriptions = [
        'subject_category_id' => '主体分类ID',
        'keyword_category_id' => '关键词分类ID',
    ];

    public function __construct()
    {/*{{{*/
        $this->belongs_to('subject_category');
        $this->belongs_to('keyword_category');
    }/*}}}*/

    public static function create(subject_category $subject_category, keyword_category $keyword_category)
    {/*{{{*/
        $subject_keyword_link = parent::init();

        $subject_keyword_link->subject_category = $subject_category;
        $subject_keyword_link->keyword_category = $keyword_category;

        return $subject_keyword_link;
    }/*}}}*/

    public static function struct_formaters($property)
    {/*{{{*/
        $formaters = [
        ];

        return $formaters[$property] ?? false;
    }/*}}}*/

    public function belongs_to_subject_category(subject_category $subject_category)
    {/*{{{*/
        return $this->subject_category_id == $subject_category->id;
    }/*}}}*/

    public function belongs_to_keyword_category(keyword_category $keyword_category)
    {/*{{{*/
        return $this->keyword_category_id == $keyword_category->id;
    }/*}}}*/

    public function display_for_subject_category_subject_keyword_links()
    {/*{{{*/
        return $this->id;
    }/*}}}*/

    public function display_for_keyword_category_subject_keyword_links()
    {/*{{{*/
        return $this->id;
    }/*}}}*/
    /* generated code end */
}

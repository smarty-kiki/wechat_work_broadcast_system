<?php

class keyword_category extends entity
{
    /* generated code start */
    public $structs = [
        'parent_keyword_category_id' => 0,
        'name' => '',
    ];

    public static $entity_display_name = '关键词分类';
    public static $entity_description = '关键词分类';

    public static $struct_data_types = [
        'parent_keyword_category_id' => 'number',
        'name' => 'string',
    ];

    public static $struct_display_names = [
        'parent_keyword_category_id' => '关键词分类ID',
        'name' => '名称',
    ];

    public static $struct_descriptions = [
        'parent_keyword_category_id' => '关键词分类ID',
        'name' => '名称',
    ];

    public function __construct()
    {/*{{{*/
        $this->has_many('keyword_categories', 'keyword_category', 'parent_keyword_category_id');
        $this->belongs_to('parent_keyword_category', 'keyword_category', 'parent_keyword_category_id');
        $this->has_many('keywords', 'keyword');
        $this->has_many('subject_keyword_links', 'subject_keyword_link');
    }/*}}}*/

    public static function create($name)
    {/*{{{*/
        $keyword_category = parent::init();

        $keyword_category->name = $name;

        return $keyword_category;
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

    public function belongs_to_parent_keyword_category(keyword_category $parent_keyword_category)
    {/*{{{*/
        return $this->parent_keyword_category_id == $parent_keyword_category->id;
    }/*}}}*/

    public function delete()
    {/*{{{*/
        foreach ($this->keyword_categories as $keyword_category) {
            $keyword_category->parent_keyword_category_id = 0;
        }
        foreach ($this->keywords as $keyword) {
            $keyword->delete();
        }
        foreach ($this->subject_keyword_links as $subject_keyword_link) {
            $subject_keyword_link->delete();
        }

        parent::delete();
    }/*}}}*/

    public function display_for_keyword_categories_parent_keyword_category()
    {/*{{{*/
        return ($this->parent_keyword_category_id ? $this->parent_keyword_category->display_for_keyword_categories_parent_keyword_category().'-':'').$this->name;
    }/*}}}*/

    public function display_for_parent_keyword_category_keyword_categories()
    {/*{{{*/
        return $this->name;
    }/*}}}*/

    public function display_for_keywords_keyword_category()
    {/*{{{*/
        return ($this->parent_keyword_category_id ? $this->parent_keyword_category->display_for_keywords_keyword_category().'-':'').$this->name;
    }/*}}}*/

    public function display_for_subject_keyword_links_keyword_category()
    {/*{{{*/
        return ($this->parent_keyword_category_id ? $this->parent_keyword_category->display_for_subject_keyword_links_keyword_category().'-':'').$this->name;
    }/*}}}*/
    /* generated code end */

    public function get_keywords_of_self_and_childrens()
    {/*{{{*/
        $keywords = $this->keywords;

        foreach ($this->keyword_categories as $keyword_category) {

            $keywords += $keyword_category->get_keywords_of_self_and_childrens();
        }

        return $keywords;
    }/*}}}*/
}

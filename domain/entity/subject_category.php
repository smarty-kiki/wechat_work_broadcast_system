<?php

class subject_category extends entity
{
    /* generated code start */
    public $structs = [
        'parent_subject_category_id' => 0,
        'name' => '',
    ];

    public static $entity_display_name = '主体分类';
    public static $entity_description = '主体分类';

    public static $struct_data_types = [
        'parent_subject_category_id' => 'number',
        'name' => 'string',
    ];

    public static $struct_display_names = [
        'parent_subject_category_id' => '主体分类ID',
        'name' => '名称',
    ];

    public static $struct_descriptions = [
        'parent_subject_category_id' => '主体分类ID',
        'name' => '名称',
    ];

    public function __construct()
    {/*{{{*/
        $this->has_many('subject_categories', 'subject_category', 'parent_subject_category_id');
        $this->belongs_to('parent_subject_category', 'subject_category', 'parent_subject_category_id');
        $this->has_many('subjects', 'subject');
        $this->has_many('subject_keyword_links', 'subject_keyword_link');
    }/*}}}*/

    public static function create($name)
    {/*{{{*/
        $subject_category = parent::init();

        $subject_category->name = $name;

        return $subject_category;
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

    public function belongs_to_parent_subject_category(subject_category $parent_subject_category)
    {/*{{{*/
        return $this->parent_subject_category_id == $parent_subject_category->id;
    }/*}}}*/

    public function delete()
    {/*{{{*/
        foreach ($this->subject_categories as $subject_category) {
            $subject_category->parent_subject_category_id = 0;
        }
        foreach ($this->subjects as $subject) {
            $subject->delete();
        }
        foreach ($this->subject_keyword_links as $subject_keyword_link) {
            $subject_keyword_link->delete();
        }

        parent::delete();
    }/*}}}*/

    public function display_for_subject_categories_parent_subject_category()
    {/*{{{*/
        return ($this->parent_subject_category_id ? $this->parent_subject_category->display_for_subject_categories_parent_subject_category().'-':'').$this->name;
    }/*}}}*/

    public function display_for_parent_subject_category_subject_categories()
    {/*{{{*/
        return $this->name;
    }/*}}}*/

    public function display_for_subjects_subject_category()
    {/*{{{*/
        return ($this->parent_subject_category_id ? $this->parent_subject_category->display_for_subjects_subject_category().'-':'').$this->name;
    }/*}}}*/

    public function display_for_subject_keyword_links_subject_category()
    {/*{{{*/
        return ($this->parent_subject_category_id ? $this->parent_subject_category->display_for_subject_keyword_links_subject_category().'-':'').$this->name;
    }/*}}}*/
    /* generated code end */

    public function get_subject_keyword_links_of_self_and_parents()
    {/*{{{*/
        if ($this->parent_subject_category_id) {
            return $this->subject_keyword_links
                + $this->parent_subject_category->get_subject_keyword_links_of_self_and_parents();
        } else {
            return $this->subject_keyword_links;
        }
    }/*}}}*/
}

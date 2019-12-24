<?php

class category extends entity
{
    /* generated code start */
    public $structs = [
        'parent_category_id' => 0,
        'name' => '',
    ];

    public static $entity_display_name = '语义分类';
    public static $entity_description = '语义分类';

    public static $struct_data_types = [
        'parent_category_id' => 'number',
        'name' => 'string',
    ];

    public static $struct_display_names = [
        'parent_category_id' => '语义分类ID',
        'name' => '名称',
    ];

    public static $struct_descriptions = [
        'parent_category_id' => '语义分类ID',
        'name' => '名称',
    ];

    public function __construct()
    {/*{{{*/
        $this->has_many('categories', 'category', 'parent_category_id');
        $this->belongs_to('parent_category', 'category', 'parent_category_id');
        $this->has_many('keywords', 'keyword');
    }/*}}}*/

    public static function create($name)
    {/*{{{*/
        $category = parent::init();

        $category->name = $name;

        return $category;
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

    public function belongs_to_parent_category(category $parent_category)
    {/*{{{*/
        return $this->parent_category_id == $parent_category->id;
    }/*}}}*/

    public function delete()
    {/*{{{*/
        foreach ($this->categories as $category) {
            $category->parent_category_id = 0;
        }
        foreach ($this->keywords as $keyword) {
            $keyword->delete();
        }

        parent::delete();
    }/*}}}*/

    public function display_for_categories_parent_category()
    {/*{{{*/
        return ($this->parent_category_id ? $this->parent_category->display_for_categories_parent_category().'-':'').$this->name;
    }/*}}}*/

    public function display_for_parent_category_categories()
    {/*{{{*/
        return $this->name;
    }/*}}}*/

    public function display_for_keywords_category()
    {/*{{{*/
        return ($this->parent_category_id ? $this->parent_category->display_for_categories_parent_category().'-':'').$this->name;
    }/*}}}*/
    /* generated code end */
}

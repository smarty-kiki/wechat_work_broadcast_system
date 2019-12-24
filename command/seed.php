<?php

function recursive_create_category_and_keyword($category_infos, $parent_category = null) {

    foreach ($category_infos as $key => $value) {

        if (is_numeric($key)) {

            keyword::create($parent_category, $value);
        } else {

            $category = category::create($key);

            if ($parent_category instanceof category) {

                $category->parent_category = $parent_category;
            }

            recursive_create_category_and_keyword($value, $category);
        }
    }
};

command('seed:data-init', '数据初始化', function ()
{/*{{{*/
    unit_of_work(function () {

        $fruits = dao('fruit')->find_all();
        foreach ($fruits as $fruit) {
            $fruit->delete();
            echo '删除 fruit '.$fruit->id."\n";
        }

        $categories = dao('category')->find_all();
        foreach ($categories as $category) {
            $category->delete();
            echo '删除 category '.$category->id."\n";
        }

        $keywords = dao('keyword')->find_all();
        foreach ($keywords as $keyword) {
            $keyword->delete();
            echo '删除 keyword '.$keyword->id."\n";
        }

        $fruit_names = [/*{{{*/
            '其它',
            '柚子',
            '苹果',
            '石榴',
            '梨',
            '香蕉',
            '葡萄',
            '水果',
            '榴莲',
            '百果园',
            '桃子',
            '橘子',
            '猕猴桃',
            '橙子',
            '梨子',
            '枣子',
            '水蜜桃',
            '椰子',
            '芒果',
            '奇异果',
            '菠萝蜜',
            '火龙果',
            '冬枣',
            '瓜',
            '哈密瓜',
            '牛油果',
            '菠萝',
            '柚',
            '牛顿苹果',
            '蜜瓜',
            '龙眼',
            '沙漠蜜瓜',
            '澳柑',
            '沃柑',
            '服务',
            '柿子',
            '山竹',
            '提子',
            '外卖',
            '巨峰葡萄',
            '枣',
            '李子',
            '椰青',
            '百香果',
            '枇杷',
            '包装',
            '黄金果',
            '西梅',
            '泰国龙眼',
            '桂圆',
            '蓝莓',
            '退款',
            '哈蜜瓜',
            '巨峰',
            '蜜桔',
            '小苹果',
        ]; /*}}}*/

        foreach ($fruit_names as $fruit_name) {

            fruit::create($fruit_name);
        }

        $category_infos = [/*{{{*/
            '门店服务' => [
                '门店业务错误' => [
                ],
                '门店服务' => [
                    '门店业务操作' => [
                    ],
                    '门店其他' => [
                    ],
                    '店员态度' => [
                    ],
                    '三无退货' => [
                    ],
                ],
            ],
            '内部变质' => [
                '内部变质' => [
                    '长虫' => [
                    ],
                ],
            ],
            '运营问题' => [
                '价格' => [
                    '价格贵' => [
                    ],
                ],
            ],

            '鲜度' => [
                '果损' => [
                    '碰伤、压伤' => [
                    ],
                ],
            ],
            '果型' => [
                '果型' => [
                    '过大过小' => [
                    ],
                    '皮厚肉少' => [
                    ],
                ],
            ],
            '口感' => [
                '口感' => [
                    '口感其他' => [
                    ],
                ],
            ],
            '鲜度' => [
                '过熟' => [
                    '过熟' => [
                    ],
                ],
                '过期' => [
                    '过期' => [
                    ],
                ],
                '腐烂' => [
                    '腐烂' => [
                    ],
                ],
                '失水' => [
                    '失水' => [
                    ],
                ],
                '变色' => [
                    '变色' => [
                    ],
                ],
                '变味' => [
                    '变味' => [
                    ],
                ],
                '发霉' => [
                    '发霉' => [
                    ],
                ],
            ],
            '口感' => [
                '口感' => [
                    '发涩' => [
                    ],
                    '不甜' => [
                    ],
                    '酸' => [
                    ],
                    '苦' => [
                    ],
                ],
            ],
        ];/*}}}*/

        $recursive_create_category_and_keyword = function ($category_infos, $parent_category = null) {

            foreach ($category_infos as $key => $value) {

                if (is_numeric($key)) {

                    keyword::create($parent_category, $value);
                } else {
                    
                    $category = category::create($key);

                    if ($parent_category instanceof category) {

                        $category->parent_category = $parent_category;
                    }

                    $recursive_create_category_and_keyword($value, $category);
                }
            }
        };

        recursive_create_category_and_keyword($category_infos);

    });
});/*}}}*/

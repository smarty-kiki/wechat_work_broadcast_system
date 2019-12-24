<?php

function recursive_create_category_and_keyword($category_infos, $parent_category = null) {/*{{{*/

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
};/*}}}*/

command('seed:data-init', '数据初始化', function ()
{/*{{{*/
    unit_of_work(function () {

        $subjects = dao('subject')->find_all();
        foreach ($subjects as $subject) {
            $subject->delete();
            echo '删除 subject '.$subject->id."\n";
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

        $subject_names = [/*{{{*/
            '其它',
            '柚子',
            '苹果',
            '石榴',
            '草莓',
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

        foreach ($subject_names as $subject_name) {

            subject::create($subject_name);
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
                        '长虫',
                    ],
                ],
            ],
            '运营问题' => [
                '价格' => [
                    '价格贵' => [
                        '贵',
                    ],
                ],
            ],

            '鲜度' => [
                '果损' => [
                    '碰伤、压伤' => [
                        '破',
                        '黑',
                        '压',
                    ],
                ],
            ],
            '果型' => [
                '果型' => [
                    '过大过小' => [
                        '太小',
                        '有点小',
                    ],
                    '皮厚肉少' => [
                        '肉少',
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
                        '过熟',
                    ],
                ],
                '过期' => [
                    '过期' => [
                        '过期',
                    ],
                ],
                '腐烂' => [
                    '腐烂' => [
                        '腐烂',
                    ],
                ],
                '失水' => [
                    '失水' => [
                        '皱',
                        '干了',
                        '缩水',
                    ],
                ],
                '变色' => [
                    '变色' => [
                        '变色',
                        '颜色不对',
                    ],
                ],
                '变味' => [
                    '变味' => [
                        '臭',
                        '变味',
                    ],
                ],
                '发霉' => [
                    '发霉' => [
                        '发霉',
                        '长霉',
                        '长毛',
                        '白毛',
                    ],
                ],
            ],
            '口感' => [
                '口感' => [
                    '发涩' => [
                        '涩',
                    ],
                    '不甜' => [
                        '不甜',
                        '没味',
                    ],
                    '酸' => [
                        '酸',
                    ],
                    '苦' => [
                        '苦',
                    ],
                ],
            ],
        ];/*}}}*/

        recursive_create_category_and_keyword($category_infos);
    });
});/*}}}*/

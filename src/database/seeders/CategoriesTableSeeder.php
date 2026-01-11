<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{

    public function run()
    {
        /**
         * お問い合わせフォームで使用するカテゴリの初期データ
         * 管理画面の検索条件やセレクトボックスにも使用
         */
        $categories = [
            '商品のお届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他',
        ];

        foreach ($categories as $content) {
            Category::create(['content' => $content]);
        }
    }
}

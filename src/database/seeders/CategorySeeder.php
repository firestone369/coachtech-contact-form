<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {

        /**
         * お問い合わせフォーム・管理画面で使用
         * 「お問い合わせの種類」マスタデータ
         * categories テーブルの content カラムに初期データとして登録
         */
        $items = [
            ['content' => '商品のお届けについて'],
            ['content' => '商品の交換について'],
            ['content' => '商品トラブル'],
            ['content' => 'ショップへのお問い合わせ'],
            ['content' => 'その他'],
        ];

        // 各カテゴリを categories テーブルに登録
        foreach ($items as $item) {
            Category::create($item);
        }
    }
}

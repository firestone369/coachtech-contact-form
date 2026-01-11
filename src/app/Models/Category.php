<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /**
     * 一括代入を許可するカラム
     */
    protected $fillable = [
        'content',
    ];

    /**
     * contacts テーブルとのリレーション
     * 1つのカテゴリ（categories）は複数のお問い合わせ（contacts）を持つ
     */

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

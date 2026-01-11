<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('first_name');
            $table->string('last_name');

            // 1:男性 2:女性 3:その他
            $table->tinyInteger('gender');
            $table->string('email');
            $table->string('tel');
            $table->string('address');
            $table->string('building')->nullable();
            $table->text('detail');
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}

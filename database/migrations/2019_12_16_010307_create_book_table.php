<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键id');
            $table->string('name')->comment('书名');
            $table->integer('sort')->unsigned()->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态 1正常 2屏蔽');
            $table->char('author', 45)->comment('作者');
            $table->integer('clicks')->unsigned()->default(0)->comment('点击量');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDigestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digest', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键id');
            $table->integer('book_id')->unsigned()->default(0)->comment('所属书目ID');
            $table->text('content')->comment('书摘内容');
            $table->tinyInteger('status')->default(1)->comment('状态 1正常 2屏蔽');
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
        Schema::dropIfExists('digest');
    }
}

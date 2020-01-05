<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->string('from')->comment('来源');
            $table->string('author')->comment('作者');
            $table->integer('pid')->comment('父类ID');
            $table->integer('cid')->comment('分类ID');
            $table->integer('status')->comment('状态');
            $table->string('image')->comment('图片');
            $table->text('desc')->comment('描述');
            $table->text('content')->comment('内容');
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
        Schema::dropIfExists('articles');
    }
}

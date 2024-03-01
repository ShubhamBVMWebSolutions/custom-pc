<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_category_id')->unsigned()->nullable();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories');
            $table->text("title");
            $table->text("slug");
            $table->text('content')->nullable();
            $table->string('type');
            $table->text("product_ids")->nullable();
            $table->enum("published", ["Draft", "Publish"])->default("Draft");
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}

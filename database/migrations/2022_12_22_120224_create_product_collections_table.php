<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_collections', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('product_collections');
            $table->text("small_icon")->nullable();
            $table->text("banner")->nullable();
            $table->text("description")->nullable();
            $table->text("product_ids")->nullable();
            $table->enum("status",["Active","Inactive"])->default("Active");
            $table->enum("list_in_product_menu",["Yes","No"])->default("No");
            $table->integer("order_number")->unsigned();
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
        Schema::dropIfExists('product_collections');
    }
}

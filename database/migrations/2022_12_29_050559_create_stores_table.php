<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
             $table->string('title');
             $table->text("slug");
             $table->string('address_line_1');
             $table->string('address_line_2')->nullable();
             $table->string('city');
             $table->string('state');
             $table->string('country');
             $table->string('pincode');
             $table->string('phone');
             $table->string('tel');
             $table->text('google_map_link');
             $table->text('opening_hours');
             $table->text('product_range');
             $table->decimal('latitude', 11, 8);
             $table->decimal('longitude', 11, 8);
             $table->enum("status", ["Draft", "Publish"])->default("Draft");
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
        Schema::dropIfExists('stores');
    }
}

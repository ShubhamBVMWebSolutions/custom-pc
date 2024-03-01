<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftCardPersonalAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_card_personal_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('personal_emailid');
            $table->string('full_name');
            $table->string('personal_message');
            $table->string('status');
            $table->string('address_type');
            $table->string('start_typing_address');
            $table->string('address_line_one');
            $table->string('address_line_two');
            $table->string('city');
            $table->string('state');
            $table->integer('postcode');
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
        Schema::dropIfExists('gift_card_personal_addresses');
    }
}

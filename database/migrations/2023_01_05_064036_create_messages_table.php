<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conversation_id')->unsigned();
            $table->foreign('conversation_id')->references('id')->on('conversations');
            $table->enum('text_type',['text','image','video','file'])->default('text');
            $table->text('message');
            $table->enum('sender_type',['Admin','Client']);
            $table->string('sender_id');
            $table->string('receiver_id');
            $table->enum('is_seen',['No','Yes'])->default('No');
            $table->enum('deleted_from_sender',['No','Yes'])->default('No');
            $table->enum('deleted_from_reciever',['No','Yes'])->default('No');
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
        Schema::dropIfExists('messages');
    }
}

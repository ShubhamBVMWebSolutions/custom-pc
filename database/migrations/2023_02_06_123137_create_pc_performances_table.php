<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_performances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pc_budget_id')->unsigned();
            $table->foreign('pc_budget_id')->references('id')->on('pc_budgets')->onDelete('cascade');
            $table->bigInteger('chipset_id')->unsigned();
            $table->foreign('chipset_id')->references('id')->on('chipset')->onDelete('cascade');
            $table->integer('pixel');
            $table->integer('cod_fps');
            $table->integer('fortnite_fps');
            $table->integer('minecraft_fps');
            $table->integer('gta_fps');
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
        Schema::dropIfExists('pc_performances');
    }
}

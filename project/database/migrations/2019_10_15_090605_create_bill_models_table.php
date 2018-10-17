<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillModelsTable extends Migration
{

    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('month');
            $table->integer('year');
            $table->integer('room_id');
            $table->integer('ap_id');
            $table->integer('water_number_old');
            $table->integer('elect_number_old');
            $table->integer('water_number');
            $table->integer('elect_number');
            $table->integer('water_unit');
            $table->integer('elect_unit');
            $table->integer('water_price');
            $table->integer('elect_price');
            $table->text('note');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bill_models');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardModelsTable extends Migration
{
    public function up()
    {
        Schema::create('board_models', function (Blueprint $table) {
            $table->increments('id');
            $table->text('topic');
            $table->text('detail');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('board_models');
    }
}

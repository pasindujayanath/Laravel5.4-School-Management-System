<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cls_id', 8)->unique();
            $table->string('code', 6)->unique();
            $table->string('name', 40);
            $table->integer('year', 1);
            $table->integer('semester', 1);
            $table->integer('floor', 1);
            $table->integer('room', 2);
            $table->integer('capacity',3);
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
        Schema::dropIfExists('classrooms');
    }
}

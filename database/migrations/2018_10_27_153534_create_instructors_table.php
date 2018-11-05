<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ins_id', 8)->unique();
            $table->string('f_name', 40);
            $table->string('l_name', 40);
            $table->string('initials', 16);
            $table->string('init_in_full', 140);
            $table->date('dob');
            $table->double('experience', 4, 2);
            $table->string('qualification', 100);
            $table->string('email', 150)->unique();
            $table->string('phone', 10);
            $table->string('address', 200);
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('instructors');
    }
}

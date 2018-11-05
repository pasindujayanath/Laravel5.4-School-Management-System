<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stu_id', 8)->unique();
            $table->string('f_name', 40);
            $table->string('l_name', 40);
            $table->string('initials', 16);
            $table->string('init_in_full', 140);
            $table->date('dob');
            $table->string('email', 150)->unique();
            $table->string('phone', 10);
            $table->string('guardian_name', 140);
            $table->string('guardian_phone', 10);
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
        Schema::dropIfExists('students');
    }
}

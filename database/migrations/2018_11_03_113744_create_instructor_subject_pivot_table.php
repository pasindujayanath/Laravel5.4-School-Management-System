<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorSubjectPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_subject', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('instructor_id')->unsigned()->unique();
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');

            $table->integer('subject_id')->unsigned()->unique();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');

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
        Schema::dropIfExists('instructor_subject');
    }
}

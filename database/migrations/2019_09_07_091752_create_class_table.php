<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class', function (Blueprint $table) {
            $table->increments('class_id');
            $table->string('section', 10)->nullable();
            $table->char('day', 2);
            $table->time('time_start');
            $table->time('time_end');
            $table->string('room', 20)->nullable();
            $table->string('sog_prelims')->nullable();
            $table->string('sog_midterms')->nullable();
            $table->string('sog_finals')->nullable();
            $table->string('sog_average')->nullable();
            $table->string('acad_term_id', 6);
            $table->foreign('acad_term_id')->references('acad_term_id')->on('acad_term')->onDelete('cascade');
            $table->string('course_code', 20);
            $table->foreign('course_code')->references('course_code')->on('course')->onDelete('cascade');
            $table->string('instructor_id', 5);
            $table->foreign('instructor_id')->references('employee_no')->on('employee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class');
    }
}

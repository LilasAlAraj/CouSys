<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInstituteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_institute', function (Blueprint $table) {
            $table->id('s_iId');
            $table->foreignId('instituteId')->references('instituteId')->on('institute');
            $table->foreignId('studentId')->references('studentId')->on('student');

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
        Schema::dropIfExists('student_institute');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnrollmentCourseRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollmentCourseRequest', function (Blueprint $table) {
            $table->id('requestId');
            $table->foreignId('courseId')->references('courseId')->on('course');
            $table->foreignId('studentId')->references('studentId')->on('student');
            $table->string('time');
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
        //
        Schema::dropIfExists('enrollmentCourseRequest');

    }
}

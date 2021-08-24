<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id('courseId');

            $table->foreignId('instituteId')->references('instituteId')->on('institute');
            $table->string('name');
            $table->string('type');
            $table->text('details');
            $table->date('startDate');
            $table->date('endDate');
            $table->boolean('starred');
            $table->text('times');
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
        Schema::dropIfExists('course');

    }
}

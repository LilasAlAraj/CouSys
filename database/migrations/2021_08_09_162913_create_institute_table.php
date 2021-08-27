<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('institute', function (Blueprint $table) {
            $table->id('instituteId');
            $table->string('name');
            $table->string('phone');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('city');
            $table->string('street');
            $table->text('details');
            $table->string('openTime');
            $table->string('closeTime');
            $table->integer('votings');
            $table->integer('numOfVotings');
            $table->boolean('isAccepted');
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
        Schema::dropIfExists('institute');

    }
}

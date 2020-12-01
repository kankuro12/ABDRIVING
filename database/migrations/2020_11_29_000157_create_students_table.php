<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('paddress')->nullable();
            $table->string('caddress')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('Program')->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('citino')->nullable();
            $table->string('gender')->nullable();
            $table->string('mstatus')->nullable();
            $table->string('ftype')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->integer('fmember')->nullable();
            $table->integer('dealamount')->nullable();
            $table->integer('balance')->nullable();
            $table->string('time')->nullable();
            $table->string('startfrom')->nullable();
            $table->text('image')->nullable();
            $table->integer('complete')->default(0);
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

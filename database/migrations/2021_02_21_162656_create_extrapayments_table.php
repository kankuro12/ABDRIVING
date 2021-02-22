<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrapaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extrapayments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('amount',12,2);
            $table->string('date');
            $table->string('payment_by')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger ('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('extrapayments');
    }
}

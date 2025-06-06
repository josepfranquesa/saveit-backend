<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graphics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->string('periodo');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->json('labels');
            $table->json('data');
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint if accounts table exists
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graphics');
    }
};

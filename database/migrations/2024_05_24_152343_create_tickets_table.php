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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->string('image_id');
            $table->integer('number');
            $table->integer('amount');
            $table->integer('direction')->comment('1 = Normal, 2 = In, 3 = Out, 4 = Out ');
            $table->integer('mix')->nullable()->default(0)->comment('5 = Mix or check, 0 = Nothing happen');
            $table->integer('status')->default(1)->comment('0 = inactive, 1 = active');
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
        Schema::dropIfExists('ticket');
    }
};

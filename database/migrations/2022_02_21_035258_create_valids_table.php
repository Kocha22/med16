<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dateofentry')->nullable();
            $table->unsignedBigInteger('qualification_id')->nullable();
            $table->unsignedBigInteger('application_id')->nullable();
            $table->string('careertarget')->nullable();
            $table->string('careergrowth')->nullable();
            $table->unsignedBigInteger('typeofdocument_id')->nullable();
            $table->string('nameofdocument')->nullable();            
            $table->string('file')->nullable();            
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
        Schema::dropIfExists('valids');
    }
}

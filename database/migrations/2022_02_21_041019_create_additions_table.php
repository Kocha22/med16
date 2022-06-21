<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('application_id')->nullable();
            $table->string('degree')->nullable(); 
            $table->string('state_award')->nullable(); 
            $table->string('other_award')->nullable(); 
            $table->string('excellent')->nullable(); 
            $table->string('text')->nullable();            
            $table->string('typeofextra')->nullable();
            $table->string('file')->nullable();
            $table->date('dateofdocument')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('additions');
    }
}

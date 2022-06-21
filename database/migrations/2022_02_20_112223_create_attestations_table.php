<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attestations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dateofentry');
            $table->unsignedBigInteger('qualification_id');
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
            $table->string('careertarget');
            $table->string('careergrowth');
            $table->unsignedBigInteger('typeofdocument_id');
            $table->foreign('typeofdocument_id')->references('id')->on('typeofdocuments')->onDelete('cascade');
            $table->string('nameofdocument');            
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
        Schema::dropIfExists('attestations');
    }
}

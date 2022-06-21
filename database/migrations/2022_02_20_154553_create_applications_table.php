<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surname');
            $table->string('name');
            $table->string('middle')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('actual_address')->nullable();
            $table->string('homephone')->nullable();
            $table->string('jobphone')->nullable();
            $table->string('mobilephone')->nullable();
            $table->string('email')->unique();
            $table->string('order')->nullable();
            $table->date('dateoforder')->nullable();
            $table->date('jobdate')->nullable();
            $table->date('termination')->nullable();            
            $table->unsignedBigInteger('oblast_id')->nullable();  
            $table->unsignedBigInteger('city_id')->nullable(); 
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
        Schema::dropIfExists('applications');
    }
}

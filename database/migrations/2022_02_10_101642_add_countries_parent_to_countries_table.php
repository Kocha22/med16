<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountriesParentToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->BigInteger('code');
            $table->string('name_ru');
            $table->string('name_kg');
            $table->string('name_en');
            $table->unsignedBigInteger('parent');
            $table->foreign('parent')->references('id')->on('areas')->onDelete('cascade');
            $table->unsignedBigInteger('ate_parent');
            $table->foreign('ate_parent')->references('id')->on('areas')->onDelete('cascade');          
            $table->string('can_select')->nullable();
            $table->string('hierarchy_tree');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->BigInteger('code');
            $table->string('name_ru');
            $table->string('name_kg');
            $table->string('name_en');
            $table->unsignedBigInteger('parent');
            $table->foreign('parent')->references('id')->on('areas')->onDelete('cascade');
            $table->unsignedBigInteger('ate_parent');
            $table->foreign('ate_parent')->references('id')->on('areas')->onDelete('cascade');          
            $table->string('can_select')->nullable();
            $table->string('hierarchy_tree');
        });
    }
}

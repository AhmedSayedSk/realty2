<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealtyController extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realties', function (Blueprint $table) {
            $table->increments('id');

            //address to be searched
            $table->string('country');
            $table->string('city');
            $table->string('region');
            $table->string('street');
            $table->integer('house_no');
            $table->integer('apartment_no');

            $table->integer('telephone');
            $table->string('type');
            $table->integer('area');    
            $table->integer('price');
            $table->text('description');
            $table->integer('user_id');
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
        Schema::drop('realties');
    }
}

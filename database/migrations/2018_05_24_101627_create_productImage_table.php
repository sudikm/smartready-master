<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('productImage',function(Blueprint $table){
            $table->increments('id');
            $table->string('imageName', 50);
            $table->integer('product_id')->unsigned(); 
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
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
        //
        Schema::drop('productImage');
    }
}

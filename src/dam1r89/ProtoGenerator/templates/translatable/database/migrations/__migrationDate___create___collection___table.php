<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create__controller__Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__table__', function($table){
            $table->increments('id');
            $table->timestamps();
            __nonTranslatables__
            $table->string('__nonTranslatable__');__stop__
        });

        Schema::create('__singleItem___translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('__singleItem___id')->unsigned();


            // Translatable fields
            __translatables__
            $table->string('__translatable__');__stop__


            $table->string('locale')->index();

            $table->unique(['__singleItem___id','locale']);
            $table->foreign('__singleItem___id')->references('id')->on('__table__')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('__table__');
        Schema::drop('__singleItem___translations');

    }

}

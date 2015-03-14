<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create__$controller__Table extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__$collection__', function($table){
            $table->increments('id');
            __!foreach($fields as $field):__
            $table->string('__$field__');__!endforeach;__
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

        Schema::dropIfExists('__$collection__');

    }

}

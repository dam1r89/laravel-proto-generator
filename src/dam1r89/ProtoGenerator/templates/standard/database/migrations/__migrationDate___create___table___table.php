<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create__$controller__Table extends Migration {


    public function up()
    {
        Schema::create('__$table__', function(Blueprint $table){
            $table->increments('id');
            __!foreach($fields as $field):__

                 __!if (is_relation($field)): __
                    $table->integer('__$field__')->unsigned();
                    $table->foreign('__$field__')->references('id')->on('__ relation_table($field) __');
                 __!else:__
                    $table->string('__$field__');
                 __!endif;__

            __!endforeach;__
            $table->timestamps();
        });

    }

    public function down()
    {

        Schema::dropIfExists('__$table__');



    }

}

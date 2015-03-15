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
        Schema::create('__$table__', function($table){
            $table->increments('id');
            __!foreach($fields as $field):__
                 __!if($field->get("relation")["type"] != 'belongsToMany') : __ 
                    $table->string('__$field__');
                 __!endif;__
                
            __!endforeach;__
            $table->timestamps();
        });

         __!foreach($fields as $field):__
            __!if($field->has('relation')) : __ 
                __!if($field->get("relation")["type"] == 'belongsToMany'):__
                        
                        Schema::create('__$item."_".$field__', function($table){
                            $table->increments('id');
                            $table->integer('__$item."_id"__')->unsigned();
                            $table->integer('__str_singular($field->get("relation")["name"])."_id"__')->unsigned();

                            $table->timestamps();
                        });

                __!endif;__
            __!endif;__
        __!endforeach;__
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('__$table__');

        __!foreach($fields as $field):__
            __!if($field->has('relation')) : __ 
                __!if($field->get("relation")["type"] == 'belongsToMany'):__
                        
                         Schema::dropIfExists('__$item."_".$field__');

                __!endif;__
            __!endif;__
        __!endforeach;__
       

    }

}

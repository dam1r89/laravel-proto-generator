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
                    __!if(!$field->has('translation')) : __
                    $table->string('__$field__');
                    __!endif;__
                 __!endif;__
                
            __!endforeach;__
            $table->timestamps();
        });


        Schema::create('__$item___translations', function($table){
            $table->increments('id');
            $table->integer('__$item___id')->unsigned();

            __!foreach($fields as $field):__
                 __!if($field->get("relation")["type"] != 'belongsToMany'):__
                    __!if($field->has('translation')):__
                        $table->string('__$field__');
                    __!endif;__
                 __!endif;__

            __!endforeach;__

            $table->string('locale')->index();

            $table->unique(['__$item___id','locale']);
            $table->foreign('__$item___id')->references('id')->on('__$table__')->onDelete('cascade');

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
                 __!if($field->get("relation")["type"] != 'belongsToMany'):__
                    __!if($field->has('translation')):__
                        __! $counter_translation = 1;__
                    __!endif;__
                 __!endif;__

        __!endforeach;__

        __!if(isset($counter_translation )):__
            Schema::dropIfExists('__$item___translations');
        __!endif;__

        __!foreach($fields as $field):__
            __!if($field->has('relation')) : __ 
                __!if($field->get("relation")["type"] == 'belongsToMany'):__
                        
                         Schema::dropIfExists('__$item."_".$field__');

                __!endif;__
            __!endif;__
        __!endforeach;__
       

    }

}

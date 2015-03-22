<?php namespace __$namespace__\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use __$namespace__\Http\Requests\__$model__FormRequest;
use __$namespace__\Models\__$model__;
use Illuminate\Http\Request;
use Redirect;
use Session;

class __$controller__Controller extends Controller {

    public $__$item__;

    /**
     * @param __$model.' ' __ $__$item__ ;
     */
    public function __'_'.'_'__construct( __$model.' ' __ $__$item__ )
    {
        $this->__$item__ = $__$item__;
    }

    /**
     * @return \Illuminate\View\View ;
     */
    public function index()
    {
        $__$collection.' '__ = $this->__$item__->all();
        return view('__$collection__.index',compact('__$collection__'));
    }

    /**
     * @return \Illuminate\View\View ;
     */
    public function create()
    {
        $__$item.' '__ = $this->__$item__;
        return view('__$collection__.create',compact('__$item__'));
    }

    /**
     * @param __$model__FormRequest $request ; 
     * @return \Illuminate\Http\RedirectResponse ;
     */
    public function store(__$model__FormRequest $request )
    {
        $__$item.' '__ = $this->__$item__->create($request->all());
        __!foreach($fields as $field):__
                __!if($field->has('relation')) : __ 
                    __!if($field->get("relation")["type"] == 'belongsToMany'):__
                            $__$item__->__$field__()->sync($request->all()['__$field__']);
                    __!endif;__
                __!endif;__
        __!endforeach;__

        Session::flash('success','You successfully added  __$model__');
        return Redirect::route('__$collection__.index');
    }

    /**
     * @param $__$item__ ;
     * @return \Illuminate\View\View ;
     */
    public function show($__$item__)
    {
        return view('__$collection__.show',compact('__$item__'));
    }

    /**
     * @param $__$item__ ;
     * @return \Illuminate\View\View ;
     */
    public function edit($__$item__)
    {
        return view('__$collection__.edit',compact('__$item__'));
    }

    /**
     * @param __$model__FormRequest $request ;
     * @param  $__$item__ ;
     * @return \Illuminate\Http\RedirectResponse ;
     */
    public function update(__$model__FormRequest $request, $__$item__)
    {
        $__$item__->update($request->all());
        __!foreach($fields as $field):__
            __!if($field->has('relation')) : __ 
                __!if($field->get("relation")["type"] == 'belongsToMany'):__
                        $__$item__->__$field__()->sync($request->all()['__$field__']);
                __!endif;__
            __!endif;__
        __!endforeach;__
        Session::flash('success','You successfully edit __$model__');
        return Redirect::route('__$collection__.index');
    }

    /**
     * @param $__$item__ ;
     * @return \Illuminate\Http\RedirectResponse ;
     */
    public function destroy($__$item__)
    {
        $__$item__->delete();
        Session::flash('success','You successfully delete __$model__');
        return Redirect::route('__$collection__.index');
    }


}

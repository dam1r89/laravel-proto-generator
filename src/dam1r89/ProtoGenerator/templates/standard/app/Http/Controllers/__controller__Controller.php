<?php namespace __$namespace__Http\Controllers;

use App\Http\Requests;

use __$namespace__Http\Requests\__$model__FormRequest;
use __$namespace__Models\__$model__;
use Illuminate\Http\Request;
use Redirect;
use Session;

class __$controller__Controller extends Controller {


    public function index(__$model__ $__$item__)
    {
        $__$collection__ = $__$item__->all();
        return view('__$collection__.index',compact('__$collection__'));
    }

    public function create(__$model__ $__$item__)
    {
        return view('__$collection__.create',compact('__$item__'));
    }

    public function store(__$model__ $__$item__, __$model__FormRequest $request )
    {
        $__$item__ = $__$item__->create($request->all());
        __!foreach($fields as $field):__
                __!if($field->has('relation')) : __
                    __!if($field->get("relation")["type"] == 'belongsToMany'):__
                            $__$item__->__$field__()->sync($request->all()['__$field__']);
                    __!endif;__
                __!endif;__
        __!endforeach;__

        return redirect()->route('__$collection__.index')->with('success','You successfully added  __$model__');
    }

    public function show(__$model__ $__$item__)
    {
        return view('__$collection__.show',compact('__$item__'));
    }

    public function edit(__$model__ $__$item__)
    {
        return view('__$collection__.edit',compact('__$item__'));
    }

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

        return redirect()->route('__$collection__.index')->with('success','You successfully edit __$model__');

    }

    public function destroy(__$model__ $__$item__)
    {
        $__$item__->delete();
        return redirect()->route('__$collection__.index')->with('success','You successfully delete __$model__');
    }


}

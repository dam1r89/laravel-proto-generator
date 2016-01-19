<?php namespace __$namespace__Http\Controllers;

use App\Http\Requests;

use __$namespace__Http\Requests\__$model__FormRequest;
use __$namespace__Models\__$model__;
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
        return view('__$collection__.__$item__',compact('__$item__'));
    }

    public function store(__$model__ $__$item__, __$model__FormRequest $request )
    {
        $__$item__ = $__$item__->create($request->input());

        return redirect()->route('__$itemLower__.index')->with('success','You have successfully added  __$model__');
    }

    public function edit(__$model__ $__$item__)
    {
        return view('__$collection__.__$item__',compact('__$item__'));
    }

    public function update(__$model__FormRequest $request, __$model__ $__$item__)
    {
        $__$item__->update($request->input());
        return redirect()->route('__$itemLower__.index')->with('success','You have successfully edited __$model__');

    }

    public function destroy(__$model__ $__$item__)
    {
        $__$item__->delete();
        return redirect()->route('__$itemLower__.index')->with('success','You have successfully deleted __$model__');
    }


}

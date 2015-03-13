<?php

class __$controller__Controller extends BaseController {
    private function validate($data){

        // TODO: Enter validation rules
        return Validator::make($data, array(
            __!foreach($fields as $field):__
            '__$field__' => '__$field->get('validation')__',__!endforeach;__
        ));
    }


    public function index()
    {

        $collection = __$model__::all();
        return View::make('__$collection__.index', compact('collection'));
    }

    public function create()
    {

        return $this->renderView(new __$model__(), true);
    }

    public function edit($__$item__)
    {

        return $this->renderView($__$item__);
    }

    private function renderView($__$item__, $new = false){

        $route = '__$collection__.'.($new ? 'store' : 'update');
        $method = $new ? 'post' : 'put';

        return View::make('__$collection__.edit', compact('route', 'method', '__$item__'));
    }

    public function store()
    {

        return $this->fillModel(new __$model__());
    }

    public function update($__$item__)
    {

        return $this->fillModel($__$item__);
    }

    private function fillModel($__$item__){

        $input = Input::all();

        $validator = $this->validate($input);
        if ($validator->fails()){

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $__$item__->fill($input);
        $__$item__->save();

        return Redirect::route('__$collection__.index');
    }

    public function show($__$item__)
    {
        return implode($__$item__->getAttributes(), ', ');
    }

    public function destroy($__$item__)
    {
        $__$item__->delete();
        return Redirect::route('__$collection__.index');

    }

}

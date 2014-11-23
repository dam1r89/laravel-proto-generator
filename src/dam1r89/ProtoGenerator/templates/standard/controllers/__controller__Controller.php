<?php

class __controller__Controller extends BaseController {

    private function validate($data){

        // TODO: Enter validation rules
        return Validator::make($data, array(
            __fields__
            '__field__' => 'required',__stop__
        ));
    }


    public function index()
    {

        $collection = __model__::all();
        return View::make('__collection__.index', compact('collection'));
    }

    public function create()
    {

        return $this->renderView(new __model__(), true);
    }

    public function edit($__item__)
    {

        return $this->renderView($__item__);
    }

    private function renderView($__item__, $new = false){

        $route = '__collection__.'.($new ? 'store' : 'update');
        $method = $new ? 'post' : 'put';

        return View::make('__collection__.edit', compact('route', 'method', '__item__'));
    }

    public function store()
    {

        return $this->fillModel(new __model__());
    }

    public function update($__item__)
    {

        return $this->fillModel($__item__);
    }

    private function fillModel($__item__){

        $input = Input::all();

        $validator = $this->validate($input);
        if ($validator->fails()){

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $__item__->fill($input);
        $__item__->save();

        return Redirect::route('__collection__.index');
    }

    public function show($__item__)
    {
        return implode($__item__->getAttributes(), ', ');
    }

    public function destroy($__item__)
    {
        $__item__->delete();
        return Redirect::route('__collection__.index');

    }

}

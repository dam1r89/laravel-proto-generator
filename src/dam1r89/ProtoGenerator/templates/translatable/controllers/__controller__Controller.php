<?php

class __controller__Controller extends BaseController {

    private function validate($data){

        // TODO: Enter validation rules
        return Validator::make($data, array(
            __fields__
            '__field__' => 'required',__stop__
        ));
    }

    private function getRoute($string = ''){

        return "__collection__.$string";
    }

    public function index()
    {

        $collection = __model__::all();
        $routeBase = $this->getRoute();

        return View::make($this->getRoute('index'), compact('collection', 'routeBase'));
    }

    public function create()
    {

        return $this->renderView(new __model__(), true);
    }

    public function edit($item)
    {

        return $this->renderView($item);
    }

    private function renderView($item, $new = false){

        $route = $this->getRoute($new ? 'store' : 'update');
        $method = $new ? 'post' : 'put';

        return View::make($this->getRoute('edit'), compact('route', 'method', 'item'));
    }

    public function store()
    {

        return $this->fillModel(new __model__());
    }

    public function update($item)
    {

        return $this->fillModel($item);
    }

    private function fillModel($item){

        $input = Input::all();

        $validator = $this->validate($input);
        if ($validator->fails()){

            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $item->fill($input);
        $item->save();

        return Redirect::route($this->getRoute('index'));
    }

    public function show($item)
    {
        return implode($item->getAttributes(), ', ');
    }

    public function destroy($item)
    {
        $item->delete();
        return Redirect::route($this->getRoute('index'));

    }

}

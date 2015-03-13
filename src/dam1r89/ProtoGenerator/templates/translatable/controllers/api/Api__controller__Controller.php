<?php

class Api__controller__Controller extends \BaseController {

    private function validate($data){

        return Validator::make($data, array(
            __fields__
            '__field__' => 'required',__stop__
        ));
    }

    public function index()
    {

        return Response::json(__model__::all());
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

            return Response::json([
                'message' => 'Request is not valid.',
                'errors' => $validator->messages()], 406);

        }

        $item->fill($input);
        $success = $item->save();

        return Response::json([], $success ? 200 : 500);

    }

    public function show($item)
    {
        return Response::json($item);
    }

    public function destroy($item)
    {
        $success = $item->delete();
        return Response::json([], $success ? 200 : 500);

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = Person::all();
        return view('fuline.index',['items' => $items]);
    }
    public function create(Request $request)
    {
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('./');
    }
}

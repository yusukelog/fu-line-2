<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;
use App\Console\Commands\Scraping;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = Person::all();
        return view('fuline.index',['items' => $items]);
    }

    public function update(Request $request)
    {
        $scraping = new Scraping;
        $scraping->handle();
        return redirect('./');
    }

    public function chk(Request $request)
    {
        $code = $request->code;
        $check = $request->check;
        Person::where('code', $code)->update(['check' => $check]);
        return ['success'=>1];
    }

//    public function remove(Request $request)
//    {
//        $id = $request->id;
//        Person::find($id)->delete();
//        return ['success'=>1];
//    }
}

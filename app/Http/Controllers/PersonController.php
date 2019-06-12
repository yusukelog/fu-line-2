<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;
use App\Console\Commands\Scraping;
use App\Console\Commands\CastScrape;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->sort) {
            $sort = 'id';
        } else {
            $sort = $request->sort;
        }
        $items = Person::orderBy($sort,'asc')->simplePaginate(20);
        return view('fuline.index',['items' => $items,'sort' => $sort]);
    }

    public function update(Request $request)
    {
        $scraping = new Scraping;
        $castscrape = new CastScrape;
        $scraping->handle();
        $castscrape->handle();
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

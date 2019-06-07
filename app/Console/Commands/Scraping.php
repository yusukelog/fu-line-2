<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade;
use GuzzleHttp\Client;
use App\Person;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        global $data,$h_url;
        $h_url= "http://www.elegaku.com";
        $goutte = GoutteFacade::request('GET', $h_url . '/cast/');
        $goutte->filter('#castBox')->each(function ($castBox) {
            $castBox->filter('#companion_box')->each(function ($box) {
                global $data,$h_url;

                //名前
                $name = trim($box->filter('.name')->text());

                //キャストURL
                $url = $box->filter('.g_image a')->attr('href');

                //キャストコード
                $code = explode("/",$url)[4];

                //サイズ
                $sizes = trim( preg_replace( '/[\n\r\t ]+/', ' ', $box->filter('.size')->text()), ' ' );

                //身長
                $tall = explode(" ",$sizes)[0];
                $tall = preg_replace('/[^0-9]/', '', $tall );

                $threeSizeArray = explode("-",explode(" ",$sizes)[1]);

                //バスト
                $bust = preg_replace('/[^0-9]/', '', $threeSizeArray[0]);

                //カップ
                $cup = preg_replace('/[^A-Z]/', '', $threeSizeArray[0]);

                //ウエスト
                $west = $threeSizeArray[1];

                //ヒップ
                $hip = $threeSizeArray[2];

                $data[] = [
                    'name' => $name,
                    'tall' => $tall,
                    'bust' => $bust,
                    'cup' => $cup,
                    'west' => $west,
                    'hip' => $hip,
                    'url' => $h_url . $url,
                    'code' => $code,
                ];
            });
        });
        foreach ($data as $val){
            $person = new Person;
            //すでに取得したキャストは新規登録しない
            if(count(Person::where('code', '=' , $val['code'])->get()) == 0)
            {
                $person->fill($val)->save();
            }
        };
    }
}

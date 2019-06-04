<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade;
use GuzzleHttp\Client;

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
        global $names,$time,$message,$week;
        $names = ['中山','水城','竹内','小野','桐谷','亀井','田中git '];

        $goutte = GoutteFacade::request('GET', 'https://www.cityheaven.net/kanagawa/A1403/A140301/elegaku/attend/');
        $goutte->filter('#contents_main')->each(function ($ul) {
            $ul->filter('#block_on_click')->each(function ($today) {
                global $week;
                $week = trim($today->filter('.wday')->text());
            });
        });

        if($week != file_get_contents("week.txt")){
            file_put_contents("week.txt", trim($week));
            $goutte->filter('#contents_main')->each(function ($ul) {
                $ul->filter('.item-0')->each(function ($it) {
                    $it->filter('.profile')->each(function ($li) {
                        global $names,$time,$message;
                        foreach($names as $name){
                            if($li->filter('.name_font_size')->text() == $name){
                                $time = $li->filter('.shukkin_detail_time')->text();
                                $message .= "\n" . $name . ":" . $time;
                            }
                        }
                    });
                });
            });
            $uri = 'https://notify-api.line.me/api/notify';
            $client = new Client();
            $client->post($uri, [
                'headers' => [
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Bearer eTKxIWnkJPriXwGcH0cNWYtAkvWQQ8NzrGM7x22DGBK',
                ],
                'form_params' => [
                    'message' => $message,
                ]
            ]);
        }
    }
}

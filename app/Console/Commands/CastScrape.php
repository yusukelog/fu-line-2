<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade;
use GuzzleHttp\Client;
use App\Person;

class CastScrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:castscrape';

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
        $casts = Person::where('check',1)->get();
        foreach ($casts as $cast){
            $url = $cast->url;
            $goutte = GoutteFacade::request('GET', $url);
            dump($url);
            $goutte->filter('#castBox')->each(function ($castBox) {

            });
        }
    }
}

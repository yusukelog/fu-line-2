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
        global $code;
        $casts = Person::all();
        foreach ($casts as $cast){
            $url = $cast->url;
            $code = $cast->code;
            $goutte = GoutteFacade::request('GET', $url);
            $goutte->filter('#p_schedule')->each(function ($schedule) {
                $schedule->filter('tr')->each(function ($tr) {
                    $tr->filter('.day')->each(function ($day) {
                        global $data;
                        $data['days'][] = trim( preg_replace( '/[\n\r\t ]+/', ' ',$day->text()), ' ');
                    });
                    $tr->filter('.time')->each(function ($time) {
                        global $data;
                        $data['time'][] = trim( preg_replace( '/[\n\r\t ]+/', ' ',$time->text()), ' ');
                    });
                });
            });
            global $data,$code;
            Person::where('code', $code)->update(['time' => serialize(array_combine($data['days'],$data['time']))]);
        }
    }
}

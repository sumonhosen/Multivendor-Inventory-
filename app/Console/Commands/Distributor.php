<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RoleUser;

class Distributor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'distributor:monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Distributor Data';

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

        // $client   = new \GuzzleHttp\Client();
        // $request  = $client->get('http://localhost/ceyon/ceyon/api/distributors');
        // $response = $request->getBody()->getContents();
        // echo $response;
    }
}

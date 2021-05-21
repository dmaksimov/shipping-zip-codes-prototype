<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ZipCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zipcodes';

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
     * @return int
     */
    public function handle()
    {
        $zipCodes = DB::table('uszips')->where('state_id', 'AK')->get(['zip', 'state_id', 'county_name']);

        file_put_contents(storage_path('alaska.json'), $zipCodes->toJson());

        dd($zipCodes->first());

        return 0;
    }
}

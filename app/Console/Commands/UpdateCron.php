<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cron';

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
        \Log::info("Cron is working fine!");
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
        DB::table('sohr')->where('status_user', '4')->update(['status_user' => '5']);
      
        $this->info('Demo:Cron Cummand Run successfully!');
        
    }
}

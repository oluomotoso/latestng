<?php

namespace newsbook\Console\Commands;

use Illuminate\Console\Command;
use newsbook\latestng\LatestngFacebook;

class PostMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:metrics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Post Metrics';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $facebook;
    public function __construct()
    {
        parent::__construct();
        $this->facebook=new LatestngFacebook();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $info=$this->facebook->UpdateCheckPostMetrics();
        $this->info($info);
    }
}

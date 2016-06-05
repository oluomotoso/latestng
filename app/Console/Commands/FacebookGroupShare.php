<?php

namespace newsbook\Console\Commands;

use Illuminate\Console\Command;
use newsbook\latestng\LatestngFacebook;

class FacebookGroupShare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:facebookgroup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This post shares some articles to Facebook automatically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $fetch;

    public function __construct()
    {
        parent::__construct();
        $this->fetch = new LatestngFacebook();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $info=$this->fetch->PostToFacebookGroups();
        //
        $this->info($info);
    }
}

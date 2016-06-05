<?php

namespace newsbook\Console\Commands;

use Illuminate\Console\Command;
use newsbook\latestng\LatestngFacebook;

class FacebookPageShare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebookshare:page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Share all posts to Facebook Pages';

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
        $this->fetch->PostToFacebookPages();
        //
    }
}

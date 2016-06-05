<?php

namespace newsbook\Console\Commands;

use Illuminate\Console\Command;
use newsbook\latestng\fetch;

class FetchPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch New Post';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $fetch;

    public function __construct(fetch $fetch)
    {
        parent::__construct();
        $this->fetch = $fetch;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $info = $this->fetch->FetchPosts();
        $this->info($info);
        //
    }
}

<?php

namespace newsbook\Console\Commands;

use Illuminate\Console\Command;
use newsbook\latestng\fetch;

class UpdateTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update all tags';

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
        //
        $info = $this->fetch->UpdateOldTag();
        $this->info($info);
    }
}

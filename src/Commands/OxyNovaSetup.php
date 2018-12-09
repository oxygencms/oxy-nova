<?php

namespace Oxygencms\OxyNova\Commands;

use Illuminate\Console\Command;
use Oxygencms\OxyNova\ServiceProvider as OxyNovaServiceProvider;

class OxyNovaSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oxy-nova:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Oxygen CMS for use with Laravel Nova';

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
     * @return void
     */
    public function handle()
    {
        $this->info('Publishing stuff..');

        $this->publishFiles();

        $this->info('Setup complete. Enjoy!');
    }

    /**
     * Publish all the stuff..
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->call('vendor:publish', [
            '--provider' => OxyNovaServiceProvider::class,
            '--tag' => ['config', 'translations', 'views', 'database'],
        ]);
    }
}

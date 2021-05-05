<?php

namespace Webmagic\Dashboard\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateAssetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:assets-update --path=';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update assets from vendor/webmagic/dashboard/public';

    /**
     * Execute the console command.
     *
     *
     * @return mixed
     */
    public function handle()
    {
        $destinationPath = $this->hasArgument('path') ? $this->argument('path') : public_path('webmagic/dashboard');
        $sourcePath = __DIR__ . '/../../../public';

        //Delete destination directory content
        if (File::deleteDirectory($destinationPath, true)) {
            $this->info('Destination directory cleared');
        }

        //Copying directories
        if (File::copyDirectory($sourcePath, $destinationPath)) {
            $this->info('Assets copied');
        }

        $this->info('Done!');
    }
}

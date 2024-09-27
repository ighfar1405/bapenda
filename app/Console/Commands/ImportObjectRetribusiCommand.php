<?php

namespace App\Console\Commands;

use App\Imports\ObjectRetribusiImport;
use DirectoryIterator;
use Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportObjectRetribusiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:object-retribusi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import object retribusi';

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
        if (!$this->confirm('Apakah anda ingin melakukan import objek retribusi?')) {
            return $this->info('Import dibatalkan.');
        }

        $dirs = storage_path('app/object_retribusi');
        $iterator = new DirectoryIterator($dirs);
        
        foreach($iterator as $fileInfo)
        {
            $currentDir = $fileInfo->getFilename();
            if($fileInfo->isDir() && !$fileInfo->isDot()) {
                $dir = sprintf('%s/%s', $dirs, $currentDir);
                $files = array_diff(scandir($dir), array('.', '..'));
                foreach($files as $file)
                {
                    $filePath = sprintf('%s/%s', $dir, $file);
                    $fileName = File::name($file);
                    $this->info("[{$currentDir}] Import file {$file}");
                    Excel::import(new ObjectRetribusiImport($fileName), $filePath);
                }
            }
        }

        // For experiment.
        // Excel::import(new ObjectRetribusiImport('Sukun'), $dirs. '/2019/Sukun.xls');
        
        $this->info('Import selesai');
    }
}

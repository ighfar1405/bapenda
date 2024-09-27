<?php

namespace App\Console\Commands;

use App\Imports\LahanPertanianImport;
use Illuminate\Console\Command;
use Excel;

class ImportLahanPertanianCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:lahan-pertanian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Lahan Pertanian';

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
        $filePath = storage_path('app/lahan_pertanian/rekapitulasi_pertanian.xls');
        Excel::import(new LahanPertanianImport(), $filePath);
        $this->info('Import selesai');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdjustTbpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tbp:adjust';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adjust tbp date and time.';

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
        $tbpDetail = \App\Entity\Transaction\TbpDetail::with('tbp')->get();
        $totalRows = $tbpDetail->count();

        $this->info("Updating tbp {$totalRows} row(s)");
        $this->output->progressStart($totalRows);

        foreach($tbpDetail as $row) {
            $datetime = sprintf('%s 00:00:00', $row->tbp->tanggal);
            $row->created_at = $datetime;
            $row->updated_at = $datetime;
            $row->save();
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        $this->info("Adjusted on {$totalRows} row(s)");
    }
}

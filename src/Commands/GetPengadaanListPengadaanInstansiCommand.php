<?php

namespace Kanekescom\Siasn\Api\Simpeg\Commands;

use Illuminate\Console\Command;
use Kanekescom\Siasn\Api\Simpeg\Facades\Simpeg;

class GetPengadaanListPengadaanInstansiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siasn-simpeg:get-pengadaan-list-pengadaan-instansi
                            {tahun : Tahun}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send GET request to /pengadaan/list-pengadaan-instansi endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = now();
        $tahun = $this->argument('tahun');
        $query = [
            'tahun' => $tahun,
        ];

        $this->info(json_encode(
            Simpeg::getPengadaanListPengadaanInstansi([], $query)->object(),
            JSON_PRETTY_PRINT
        ));

        $this->newLine();
        $this->comment("Processed in {$start->shortAbsoluteDiffForHumans(now(), 1)}");

        return self::SUCCESS;
    }
}
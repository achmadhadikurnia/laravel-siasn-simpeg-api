<?php

namespace Kanekescom\Siasn\Simpeg\Api\Commands;

use Illuminate\Console\Command;
use Kanekescom\Siasn\Simpeg\Api\Riwayat;

class GetPnsRwPenghargaanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siasn-simpeg:get-pns-rw-penghargaan
                            {nipBaru : nipBaru}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send GET request to /pns/rw-penghargaan/{nipBaru} endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = now();
        $nipBaru = $this->argument('nipBaru');
        $paths = [
            'nipBaru' => $nipBaru,
        ];

        $this->info(json_encode(
            Riwayat::getPenghargaan($paths)->object(),
            JSON_PRETTY_PRINT
        ));

        $this->newLine();
        $this->comment("Processed in {$start->shortAbsoluteDiffForHumans(now(), 1)}");

        return self::SUCCESS;
    }
}

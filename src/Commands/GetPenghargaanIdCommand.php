<?php

namespace Kanekescom\Siasn\Simpeg\Api\Commands;

use Illuminate\Console\Command;
use Kanekescom\Siasn\Simpeg\Api\Penghargaan;

class GetPenghargaanIdCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siasn-simpeg:get-penghargaan-id
                            {id : idRiwayatPenghargaan}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send GET request to /penghargaan/id/{idRiwayatPenghargaan} endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = now();
        $id = $this->argument('id');
        $paths = [
            'idRiwayatPenghargaan' => $id,
        ];

        $this->info(json_encode(
            Penghargaan::get($paths)->object(),
            JSON_PRETTY_PRINT
        ));

        $this->newLine();
        $this->comment("Processed in {$start->shortAbsoluteDiffForHumans(now(), 1)}");

        return self::SUCCESS;
    }
}

<?php

namespace Kanekescom\Siasn\Api\Simpeg\Commands;

use Illuminate\Console\Command;
use Kanekescom\Siasn\Api\Simpeg\Exceptions\InvalidJsonException;
use Kanekescom\Siasn\Api\Simpeg\Facades\Simpeg;

class PostDiklatSaveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siasn-simpeg:post-diklat-save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send POST request to /diklat/save endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = now();
        $this->line('<bg=yellow> BE CAREFUL! </> This action can change the data on SIASN BKN.');
        $this->newLine();
        $this->comment('{"bobot":0,"id":"string","institusiPenyelenggara":"string","jenisKompetensi":"string","jumlahJam":0,"latihanStrukturalId":"string","nomor":"string","path":[{"dok_id":"string","dok_nama":"string","dok_uri":"string","object":"string","slug":"string"}],"pnsOrangId":"string","tahun":0,"tanggal":"string","tanggalSelesai":"string"}');

        $query = json_decode($this->ask('Copy the json above, fill it and paste it here'), true);

        if (! is_array($query)) {
            throw new InvalidJsonException;

            return self::FAILURE;
        }

        $this->info(json_encode(
            Simpeg::postDiklatSave([], $query)->object(),
            JSON_PRETTY_PRINT
        ));

        $this->newLine();
        $this->comment("Processed in {$start->shortAbsoluteDiffForHumans(now(), 1)}");

        return self::SUCCESS;
    }
}
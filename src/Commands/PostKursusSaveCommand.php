<?php

namespace Kanekescom\Siasn\Simpeg\Api\Commands;

use Illuminate\Console\Command;
use Kanekescom\Siasn\Simpeg\Api\Exceptions\InvalidJsonException;
use Kanekescom\Siasn\Simpeg\Api\Kursus;

class PostKursusSaveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siasn-simpeg:post-kursus-save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send POST request to /kursus/save endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->components->warn('This action can change the data on SIASN BKN.');
        $this->comment('{"id":"string","instansiId":"string","institusiPenyelenggara":"string","jenisDiklatId":"string","jenisKursus":"string","jenisKursusSertipikat":"string","jumlahJam":0,"lokasiId":"string","namaKursus":"string","nomorSertipikat":"string","path":[{"dok_id":"string","dok_nama":"string","dok_uri":"string","object":"string","slug":"string"}],"pnsOrangId":"string","tahunKursus":0,"tanggalKursus":"string","tanggalSelesaiKursus":"string"}');

        $query = json_decode($this->ask('Copy the json above, fill it and paste it here'), true);

        if (! is_array($query)) {
            throw new InvalidJsonException;

            return self::FAILURE;
        }

        $start = now();

        $this->info(json_encode(
            Kursus::save([], $query)->object(),
            JSON_PRETTY_PRINT
        ));

        $this->newLine();
        $this->comment("Processed in {$start->shortAbsoluteDiffForHumans(now(), 1)}");

        return self::SUCCESS;
    }
}

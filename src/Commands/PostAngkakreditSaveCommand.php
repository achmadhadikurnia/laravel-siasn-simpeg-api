<?php

namespace Kanekescom\Siasn\Simpeg\Api\Commands;

use Illuminate\Console\Command;
use Kanekescom\Siasn\Simpeg\Api\AngkaKredit;
use Kanekescom\Siasn\Simpeg\Api\Exceptions\InvalidJsonException;

class PostAngkakreditSaveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siasn-simpeg:post-angkakredit-save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send POST request to /angkakredit/save endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->components->warn('This action can change the data on SIASN BKN.');
        $this->comment('{"bulanMulaiPenailan":"string","bulanSelesaiPenailan":"string","id":"string","isAngkaKreditPertama":"string","isIntegrasi":"string","isKonversi":"string","kreditBaruTotal":"string","kreditPenunjangBaru":"string","kreditUtamaBaru":"string","nomorSk":"string","path":[{"dok_id":"string","dok_nama":"string","dok_uri":"string","object":"string","slug":"string"}],"pnsId":"string","rwJabatanId":"string","tahunMulaiPenailan":"string","tahunSelesaiPenailan":"string","tanggalSk":"string"}');

        $query = json_decode($this->ask('Copy the json above, fill it and paste it here'), true);

        if (! is_array($query)) {
            throw new InvalidJsonException;

            return self::FAILURE;
        }

        $start = now();

        $this->info(json_encode(
            AngkaKredit::save([], $query)->object(),
            JSON_PRETTY_PRINT
        ));

        $this->newLine();
        $this->comment("Processed in {$start->shortAbsoluteDiffForHumans(now(), 1)}");

        return self::SUCCESS;
    }
}

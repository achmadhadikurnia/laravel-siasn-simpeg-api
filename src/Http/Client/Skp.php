<?php

namespace Kanekescom\Siasn\Simpeg\Api\Http\Client;

use Illuminate\Http\Client\Response;
use Kanekescom\Siasn\Simpeg\Api\Helpers\UrlParser;
use Kanekescom\Siasn\Simpeg\Api\Simpeg;

class Skp
{
    public static function save2021(array $paths = [], array $query = []): Response
    {
        $urlFormat = '/skp/2021/save';
        $urlParsed = (new UrlParser($urlFormat))->parse($paths);

        return (new Simpeg)->get($urlParsed, $query);
    }

    public static function get(array|string $paths = [], array $query = []): Response
    {
        if (is_string($paths)) {
            $paths = [
                'idRiwayatSkp' => $paths,
            ];
        }

        $urlFormat = '/skp/id/{idRiwayatSkp}';
        $urlParsed = (new UrlParser($urlFormat))->parse($paths);

        return (new Simpeg)->get($urlParsed, $query);
    }

    public static function save(array $paths = [], array $query = []): Response
    {
        $urlFormat = '/skp/save';
        $urlParsed = (new UrlParser($urlFormat))->parse($paths);

        return (new Simpeg)->post($urlParsed, $query);
    }
}

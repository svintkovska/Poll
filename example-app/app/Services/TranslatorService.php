<?php

namespace App\Services;

use App\Models\Question;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Support\Facades\Cache;

/**
 * Class TranslatorService 
 */
class TranslatorService
{
    private string $keyFilePath;
    private TranslateClient $client;
    public function __construct(string $keyFilePath)
    {
        $this->keyFilePath = $keyFilePath;
        $this->client = new TranslateClient([
            'keyFilePath' => $this->keyFilePath
        ]);
    }

    public function translate(string $text, string $to): string
    {

        $cacheKey = sha1(json_encode([$to, $text]));

        return Cache::rememberForever($cacheKey, function () use ($text, $to) {
            $result = $this->client->translate($text, [
                //'source' => 'en',
                'target' => $to,
            ]);

            return $result['text'];
        });
    }

    public function makeSearch(Question $question): string
    {

        $title = $question->title;
        $result = $title;
        $langs = ['uk', 'en'];
        foreach ($langs as $lang) {
            $result .= ' ' . $this->translate($title, $lang);
        }
        return $result;

    }
}

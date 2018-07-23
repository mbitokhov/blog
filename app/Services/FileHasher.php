<?php

namespace App\Services;

use Cache;

class FileHasher
{
    public static function make($file, $hash = 'sha512')
    {
        return Cache::fileBasedRemember($file, $hash, function ($file, $hash) {
            return base64_encode(hash_file($hash, $file, true));
        });
    }
}

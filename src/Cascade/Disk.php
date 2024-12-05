<?php

namespace KanekiYuto\Handy\Cascade;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class Disk
{

    public static function migrationDisk(): Filesystem
    {
        $database = database_path() . DIRECTORY_SEPARATOR;

        return static::useDisk($database . 'migrations');
    }

    public static function useDisk(string $root): Filesystem
    {
        return Storage::build([
            'driver' => 'local',
            'root' => $root,
        ]);
    }

    public static function appDisk(): Filesystem
    {
        $base = base_path() . DIRECTORY_SEPARATOR;

        return static::useDisk($base . 'app');
    }

    public static function stubDisk(): Filesystem
    {
        $base = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR;

        return static::useDisk($base . 'stubs');
    }

}
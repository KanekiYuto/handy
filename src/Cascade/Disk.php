<?php

namespace KanekiYuto\Handy\Cascade;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class Disk
{

    public static function migrationDisk(): Filesystem
    {
        return static::useDisk(self::getMigrationPath());
    }

    public static function useDisk(string $root): Filesystem
    {
        return Storage::build([
            'driver' => 'local',
            'root' => $root,
        ]);
    }

    public static function getMigrationPath(): string
    {
        return database_path() . DIRECTORY_SEPARATOR . 'migrations';
    }

    public static function appDisk(): Filesystem
    {
        return static::useDisk(self::getAppPath());
    }

    public static function getAppPath(): string
    {
        return base_path() . DIRECTORY_SEPARATOR . 'app';
    }

    public static function stubDisk(): Filesystem
    {
        return static::useDisk(self::getStubPath());
    }

    public static function getStubPath(): string
    {
        return dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'stubs';
    }

}
<?php

declare(strict_types=1);

namespace Lee1387\BedWars\utils;

use Lee1387\BedWars\BedWars;

class ConfigGetter {

    public static function get(string $key, mixed $default = false): mixed {
        return BedWars::getInstance()->getConfig()->get($key, $default);
    }

    public static function getVersion(): int|float {
        return self::get("version", 1.0);
    }

    public static function getIP(): string {
        return self::get("ip", "play.example.net");
    }

}
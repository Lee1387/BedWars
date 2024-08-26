<?php

declare(strict_types=1);

namespace Lee1387\BedWars;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class BedWars extends PluginBase {

    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }
    
}
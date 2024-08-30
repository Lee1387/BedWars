<?php

declare(strict_types=1);

namespace Lee1387\BedWars\item;

use Lee1387\BedWars\item\game\LeaveGameItem;
use pocketmine\utils\CloningRegistryTrait;

/**
 * @method static LeaveGameItem LEAVE_GAME()
 */

class BedWarsItems {

    use CloningRegistryTrait;

    protected static function setup(): void {
        self::register("leave_game", new LeaveGameItem());
    }

    /**
     * @return BedWarsItem[]
     */
    public static function getAll(): array {
        return self::_registryGetAll();
    }

    /**
     * @return Item
     */
    public static function get(string $name): object {
        return self::_registryFromString($name);
    }

    private static function register(string $name, BedWarsItem $item): void {
        self::_registryRegister($name, $item);
    }
    
}
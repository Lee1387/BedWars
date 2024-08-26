<?php

declare(strict_types=1);

namespace Lee1387\BedWars\utils;

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\item\ItemTypeIds;

class GameUtils {

    public static function getMode(int $playersPerTeam): string {
        return match($playersPerTeam) {
            1 => "Solo",
            2 => "Duos",
            4 => "Squads",
            default => "Unknown"
        };
    }

    public static function getGeneratorColor(string $name): string {
        return match(strtolower($name)) {
            "emerald" => "{DARK_GREEN}",
            "diamond" => "{AQUA}",
            "gold" => "{GOLD}",
            "iron" => "{WHITE}",
            default => ""
        };
    }

    public static function getEffectDuration(EffectInstance $effect): int {
        return match($effect->getType()) {
            VanillaEffects::SPEED(), VanillaEffects::JUMP_BOOST() => 45,
            VanillaEffects::INVISIBILITY() => 30,
            default => 0
        } * 20;
    }

    public static function getEffectAmplifier(EffectInstance $effect): int {
        return match($effect->getType()) {
            VanillaEffects::SPEED() => 1,
            VanillaEffects::JUMP_BOOST() => 4,
            default => 0
        };
    }

    public static function getCountById(int $id): int {
        return match($id) {
            ItemTypeIds::IRON_INGOT => 48,
            ItemTypeIds::GOLD_INGOT => 16,
            ItemTypeIds::DIAMOND => 4,
            ItemTypeIds::EMERALD => 2,
            default => 64
        };
    }

    public static function getColoredTitleNumber(int $number): string {
        return match(true) {
            $number <= 3 => "{RED}",
            $number <= 5 => "{YELLOW}",
            default => "{GREEN}"
        } . $number;
    }

    public static function getColoredMessageNumber(int $number): string {
        return match(true) {
            $number <= 5 => "{RED}",
            $number <= 10 => "{GOLD}",
            $number <= 20 => "{AQUA}",
            default => "{GREEN}"
        } . $number;
    }
    
}
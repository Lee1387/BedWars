<?php

declare(strict_types=1);

namespace Lee1387\BedWars\utils;

use pocketmine\math\Vector2;
use pocketmine\world\Position;

use function atan2;

class MathUtils {

    public static function calculateYaw(Position $playerPosition, Position $entityPosition): float {
        return self::toDegrees(atan2(
            $playerPosition->getZ() - $entityPosition->getZ(),
            $playerPosition->getX() - $entityPosition->getX()
        ));
    }

    public static function calculatePitch(Position $playerPosition, Position $entityPosition): float {
        $playerVector = new Vector2($playerPosition->getX(), $playerPosition->getZ());
        $entityVector = new Vector2($entityPosition->getX(), $entityPosition->getZ());

        return self::toDegrees(atan2(
            $playerVector->distance($entityVector),
            $playerPosition->getY() - $entityPosition->getY()
        ));
    }

    private static function toDegrees(float $radians): float {
        return $radians * 180 / M_PI - 90;
    }

}
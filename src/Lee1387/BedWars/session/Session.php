<?php

declare(strict_types=1);

namespace Lee1387\BedWars\session;

use Lee1387\BedWars\utils\ColorUtils;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\player\Player;

class Session {

    public const RESPAWN_DURATION = 5;

    private Player $player;

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getUsername(): string {
        return $this->player->getName();
    }

    public function isOnline(): bool {
        return $this->player->isOnline();
    }

    public function sendDataPacket(ClientboundPacket $packet): void {
        $this->player->getNetworkSession()->sendDataPacket($packet);
    }

    public function message(string $message): void {
        $this->player->sendMessage(ColorUtils::translate($message));
    }

}
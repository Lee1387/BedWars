<?php

declare(strict_types=1);

namespace Lee1387\BedWars\item\game;

use Lee1387\BedWars\item\BedWarsItem;
use Lee1387\BedWars\session\Session;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;

class LeaveGameItem extends BedWarsItem {

    public function __construct() {
        parent::__construct("{RED}Leave Game");
    }

    public function onInteract(Session $session): void {
        $session->getGame()->removePlayer($session);
    }

    protected function realItem(): Item {
        return VanillaBlocks::BED()->asItem();
    }

}
<?php

declare(strict_types=1);

namespace Lee1387\BedWars\item;

use Lee1387\BedWars\session\Session;
use Lee1387\BedWars\utils\ColorUtils;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;

abstract class BedWarsItem {

    private string $name;
    private bool $disableTransactions;

    public function __construct(string $name, bool $disableTransactions = true) {
        $this->name = ColorUtils::translate($name);
        $this->disableTransactions = $disableTransactions;
    }

    public function asItem(): Item {
        $item = $this->realItem();
        $item->setCustomName($this->name);

        $nbt = $item->getNamedTag();
        $nbt->setString("bedwars_name", str_replace(" ", "_", TextFormat::clean($this->name)));

        if ($this->disableTransactions) {
            $nbt->setByte("bedwars_item", 1);
        }

        return $item;
    }

    public abstract function onInteract(Session $session): void;

    protected abstract function realItem(): Item;
}
<?php

declare(strict_types=1);

namespace Lee1387\BedWars\game\shop\item;

use Closure;
use Lee1387\BedWars\game\shop\Product;
use Lee1387\BedWars\session\Session;
use pocketmine\block\Block;
use pocketmine\item\Item;

class ItemProduct extends Product {

    private int $amount;

    private Item $item;
    private ?Closure $onPurchase;

    public function __construct(string $name, int $price, int $amount, Block|Item $item, Item $ore, ?Closure $onPurchase = null) {
        $this->amount = $amount;
        $this->item = ($item instanceof Block ? $item->asItem() : $item)->setCount($amount);
        $this->onPurchase = $onPurchase;
        parent::__construct($name, $name, $price, $ore);
    }

    public function getAmount(): int {
        return $this->amount;
    }

    public function getItem(): Item {
        return clone $this->item;
    }

    public function onPurchase(Session $session): bool {
        $inventory = $session->getPlayer()->getInventory();
        if (!$inventory->canAddItem($this->item)) {
            $session->message("{RED}Your inventory is full!");
            return false;
        }
        
        if ($this->executePurchaseListener($session)) {
            $inventory->addItem($this->item);
            return true;
        }
        return false;
    }

    private function executePurchaseListener(Session $session): bool {
        return $this->onPurchase !== null ? ($this->onPurchase)($session) : true;
    }

}
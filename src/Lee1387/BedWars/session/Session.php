<?php

declare(strict_types=1);

namespace Lee1387\BedWars\session;

use Lee1387\BedWars\game\Game;
use Lee1387\BedWars\item\BedWarsItems;
use Lee1387\BedWars\session\scoreboard\Scoreboard;
use Lee1387\BedWars\utils\ColorUtils;
use pocketmine\network\mcpe\protocol\BossEventPacket;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\types\BossBarColor;
use pocketmine\player\Player;
use Team;

class Session {

    public const RESPAWN_DURATION = 5;

    private Player $player;
    private Scoreboard $scoreboard;

    private ?Game $game = null;
    private ?Team $team = null;

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getUsername(): string {
        return $this->player->getName();
    }

    public function getGame(): ?Game {
        return $this->team;
    }

    public function setScoreboard(Scoreboard $scoreboard): void {
        $this->scoreboard = $scoreboard;
        $this->updateScoreboard();
    }

    public function setGame(?Game $game): void {
        $this->game = $game;
    }

    public function updateScoreboard(): void {
        $this->scoreboard->show($this);
    }

    public function isOnline(): bool {
        return $this->player->isOnline();
    }

    public function showBossBar(string $title): void {
        $this->hideBossBar();
        $this->sendDataPacket(
            BossEventPacket::show($this->player->getId(), ColorUtils::translate($title), 10, false, 0, BossBarColor::BLUE)
        );
    }

    public function hideBossBar(): void {
        $this->sendDataPacket(BossEventPacket::hide($this->player->getId()));
    }

    public function sendDataPacket(ClientboundPacket $packet): void {
        $this->player->getNetworkSession()->sendDataPacket($packet);
    }

    public function clearInventories(): void {
        $this->player->getCursorInventory()->clearAll();
        $this->player->getOffHandInventory()->clearAll();
        $this->player->getEnderInventory()->clearAll();
        $this->player->getArmorInventory()->clearAll();
        $this->player->getInventory()->clearAll();
    }

    public function giveWaitingItems(): void {
        $this->clearInventories();
        $this->player->getInventory()->setItem(8, BedWarsItems::LEAVE_GAME()->asItem());
    }

    public function teleportToWaitingWorld(): void {
        // Logic here
    }

    public function message(string $message): void {
        $this->player->sendMessage(ColorUtils::translate($message));
    }

}
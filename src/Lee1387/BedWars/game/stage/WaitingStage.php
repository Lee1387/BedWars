<?php

declare(strict_types=1);

namespace Lee1387\BedWars\game\stage;

use Lee1387\BedWars\game\Game;
use Lee1387\BedWars\session\scoreboard\WaitingScoreboard;
use Lee1387\BedWars\session\Session;
use Lee1387\BedWars\utils\ConfigGetter;

class WaitingStage extends Stage {

    public function start(Game $game): void {
        $this->game = $game;
    }

    public function onJoin(Session $session): void {
        $session->showBossBar("{YELLOW}Playing {WHITE}BED WARS {YELLOW}on {GREEN}" . strtoupper(ConfigGetter::getIP()));
        $session->getPlayer()->getEffects()->clear();
        $session->giveWaitingItems();
        $session->setGame($this->game);
        $session->setScoreboard(new WaitingScoreboard());
        $session->teleportToWaitingWorld();
        
        $this->game->broadcastMessage(
            "{GRAY}" . $session->getUsername() . " {YELLOW}has joined ({AQUA}" . 
            $this->game->getPlayersCount() . "{YELLOW}/{AQUA}" . $this->game->getMap()->getMaxCapacity() . "{YELLOW})!"
        );

        if ($this->game->getPlayersCount() >= ($this->game->getMap()->getMaxCapacity() / 2)) {
            $this->game->setStage(new StartingStage());
        }
    }

    public function tick(): void {}
    
}
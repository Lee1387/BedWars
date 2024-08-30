<?php

declare(strict_types=1);

namespace Lee1387\BedWars\game\stage;

use Lee1387\BedWars\session\Session;
use Lee1387\BedWars\utils\GameUtils;

class StartingStage extends Stage {

    private int $time = 10;

    public function getTime(): int {
        return $this->time;
    }

    public function onQuit(Session $session): void {
        if (!$this->game->isFull()) {
            $this->game->setStage(new WaitingStage());
        }
    }

    public function tick(): void {
        if ($this->time <= 0) {

        } elseif ($this->time <= 5) {

        }
        if ($this->time > 0) {

        }
        if ($this->time === 5) {

        } elseif ($this->time === 10) {
            
        }
        $this->game->updateScoreboards();

        $this->time--;
    }

    private function getStartingMessage(): string {
        $message = "{YELLOW}The game is starting in {time} {YELLOW}seconds!";
        if ($this->time <= 10) {
            $message = "{YELLOW}The game starts in {time} {YELLOW}" . ($this->time === 1 ? "second" : "seconds") . "!";
        }
        $message = str_replace("{time}", GameUtils::getColoredMessageNumber($this->time), $message);

        return $message;
    }

    private function broadcastCountdownTitle(): void {
        
    }

}
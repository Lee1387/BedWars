<?php

declare(strict_types=1);

namespace Lee1387\BedWars\session\scoreboard;

use Lee1387\BedWars\session\Session;
use Lee1387\BedWars\utils\ConfigGetter;
use Lee1387\BedWars\utils\GameUtils;
use Lee1387\BedWars\game\stage\StartingStage;

class WaitingScoreboard extends Scoreboard {

    protected function getLines(Session $session): array {
        $game = $session->getGame();
        $arena = $game->getMap();
        $stage = $game->getStage();
        return [
            10 => " ",
            9 => "{WHITE}Map: {GREEN}" . $arena->getName(),
            8 => "{WHITE}Players: {GREEN}" . $game->getPlayersCount() . "/" . $arena->getMaxCapacity(),
            7 => "  ",
            6 => !$stage instanceof StartingStage ? "{WHITE}Waiting..." : "{WHITE}Staring in {GREEN}" . $stage->getTime() . "s",
            5 => "  ",
            4 => "{WHITE}Mode: {GREEN}" . GameUtils::getMode($arena->getPlayersPerTeam()),
            3 => "{WHITE}Version: {GRAY}v" . ConfigGetter::getVersion()
        ];
    }

}
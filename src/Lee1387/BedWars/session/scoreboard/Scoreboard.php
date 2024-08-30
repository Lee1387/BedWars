<?php

declare(strict_types=1);

namespace Lee1387\BedWars\session\scoreboard;

use Lee1387\BedWars\session\Session;
use Lee1387\BedWars\utils\ColorUtils;
use Lee1387\BedWars\utils\ConfigGetter;
use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;

abstract class Scoreboard {

    private const TITLE = "{YELLOW}BEDWARS";

    public function show(Session $session): void {
        if ($session->isOnline()) {
            $this->hide($session);

            $packet = new SetDisplayObjectivePacket();
            $packet->displaySlot = SetDisplayObjectivePacket::DISPLAY_SLOT_SIDEBAR;
            $packet->objectiveName = $session->getUsername();
            $packet->displayName = ColorUtils::translate(self::TITLE);
            $packet->criteriaName = "dummy";
            $packet->sortOrder = SetDisplayObjectivePacket::SORT_ORDER_DESCENDING;
            $session->sendDataPacket($packet);

            foreach($this->getLines($session) as $score => $line) {
                $this->addLine($score, " " . $line, $session);
            }
            $this->addLine(2, "      ", $session);
            $this->addLine(1, "{YELLOW}" . ConfigGetter::getIP(), $session);
        }
    }

    private function addLine(int $score, string $text, Session $session): void {
        $entry = new ScorePacketEntry();
        $entry->objectiveName = $session->getUsername();
        $entry->type = ScorePacketEntry::TYPE_FAKE_PLAYER;
        $entry->customName = ColorUtils::translate($text);
        $entry->score = $score;
        $entry->scoreboardId = $score;
        $packet = new SetScorePacket();
        $packet->type = SetScorePacket::TYPE_CHANGE;
        $packet->etnries[] = $entry;
        $session->sendDataPacket($packet);
    }

    private function hide(Session $session): void {
        if ($session->isOnline()) {
            $packet = new RemoveObjectivePacket();
            $packet->objectiveName = $session->getUsername();
            $session->sendDataPacket($packet);
        }
    }

    /**
     * @return string[]
     */
    protected abstract function getLines(Session $session): array;

}
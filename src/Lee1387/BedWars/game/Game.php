<?php

declare(strict_types=1);

namespace Lee1387\BedWars\game;

use Lee1387\BedWars\game\map\Map;
use Lee1387\BedWars\game\stage\Stage;
use Lee1387\BedWars\game\stage\WaitingStage;
use pocketmine\world\World;

class Game {

    private int $id;

    private Map $map;
    private Stage $stage;
    private ?World $world = null;

    /** @var Team[] */
    private array $teams;

    /** @var Position[] */
    private array $blocks = [];

    /** @var Session[] */
    private array $players = [];

    /** @var Session[] */
    private array $spectators;

    public function __construct(Map $map, int $id) {
        $this->id = $id;
        $this->map = $map;
        $this->teams = $map->getTeams();

        $this->setStage(new WaitingStage());
    }

    public function getStage(): Stage {
        return $this->stage;
    }

    public function getMap(): Map {
        return $this->map;
    }

    /**
     * @return Session[]
     */
    public function getPlayers(): array {
        return $this->players;
    }

    /**
     * @return Session[]
     */
    public function getPlayersAndSpectators(): array {
        return array_merge($this->players, $this->spectators);
    }

    public function getPlayersCount(): int {
        return count($this->players);
    }

    public function isFull(): bool {
        return $this->getPlayersCount() >= $this->map->getMaxCapacity();
    }

    public function setStage(Stage $stage): void {
        $this->stage = $stage;
        $this->stage->start($this);
    }

    public function removePlayer(): void {

    }

    public function updateScoreboards(): void {
        foreach ($this->getPlayersAndSpectators() as $session) {
            $session->updateScoreboard();
        }
    }

    public function broadcastMessage(string $message): void {
        foreach ($this->getPlayersAndSpectators() as $session) {
            $session->message($message);
        }
    }

}
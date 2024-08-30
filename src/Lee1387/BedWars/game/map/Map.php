<?php

declare(strict_types=1);

namespace Lee1387\BedWars\game\map;

use pocketmine\math\Vector3;
use pocketmine\world\World;

class Map {

    private string $id;
    private string $name;

    private Vector3 $spectatorSpawnPosition;

    private int $playersPerTeam;
    private int $maxCapacity;

    private World $waitingWorld;

    /** @var Vector3[] */
    private array $shopPositions;

    /** @var Vector3[] */
    private array $upgradesPositions;

    /** @var Generator[] */
    private array $generators;

    /** @var Team[] */
    private array $teams;

    /**
     * @param Generator[] $generators
     * @param Team[] $teams
     */
    public function __construct(string $name, Vector3 $spectatorSpawnPosition, int $playerTeamCapacity, int $maxCapacity, World $waitingWorld, array $generators, array $teams, array $shopLocations, array $upgradesLocations) {
        $this->id = uniqid("map-");
        $this->name = $name;
        $this->spectatorSpawnPosition = $spectatorSpawnPosition;
        $this->playersPerTeam = $playerTeamCapacity;
        $this->maxCapacity = $maxCapacity;
        $this->waitingWorld = $waitingWorld;
        $this->generators = $generators;
        $this->teams = $teams;
        $this->shopPositions = $shopLocations;
        $this->upgradesPositions = $upgradesLocations;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSpectatorSpawnPosition(): Vector3 {
        return $this->spectatorSpawnPosition;
    }

    public function getPlayersPerTeam(): int {
        return $this->playersPerTeam;
    }

    public function getMaxCapacity(): int {
        return $this->maxCapacity;
    }

    public function getWaitingWorld(): World {
        return $this->waitingWorld;
    }

    /**
     * @return Generator[]
     */
    public function getGenerators(): array {
        return $this->generators;
    }

    /**
     * @return Team[]
     */
    public function getTeams(): array {
        return $this->teams;
    }

    /**
     * @return Vector3[]
     */
    public function getShopPositions(): array {
        return $this->shopPositions;
    }

    /**
     * @return Vector3[]
     */
    public function getUpgradesPositions(): array {
        return $this->upgradesPositions;
    }
    
}
<?php

namespace ParticleManager;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\level\particle\AngryVillagerParticle;
use pocketmine\level\particle\BlockForceFieldParticle;
use pocketmine\level\particle\BubbleParticle;
use pocketmine\level\particle\CriticalParticle;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\level\particle\DustParticle;
use pocketmine\level\particle\EnchantmentTableParticle;
use pocketmine\level\particle\EnchantParticle;
use pocketmine\level\particle\EntityFlameParticle;
use pocketmine\level\particle\ExplodeParticle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\particle\GenericParticle;
use pocketmine\level\particle\HappyVillagerParticle;
use pocketmine\level\particle\HeartParticle;
use pocketmine\level\particle\HugeExplodeParticle;
use pocketmine\level\particle\HugeExplodeSeedParticle;
use pocketmine\level\particle\InkParticle;
use pocketmine\level\particle\InstantEnchantParticle;
use pocketmine\level\particle\ItemBreakParticle;
use pocketmine\level\particle\LavaDripParticle;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\particle\MobSpawnParticle;
use pocketmine\level\particle\Particle;
use pocketmine\level\particle\PortalParticle;
use pocketmine\level\particle\RainSplashParticle;
use pocketmine\level\particle\RedstoneParticle;
use pocketmine\level\particle\SmokeParticle;
use pocketmine\level\particle\SnowballPoofParticle;
use pocketmine\level\particle\SplashParticle;
use pocketmine\level\particle\SporeParticle;
use pocketmine\level\particle\TerrainParticle;
use pocketmine\level\particle\WaterDripParticle;
use pocketmine\level\particle\WaterParticle;
use pocketmine\Player;
use pocketmine\Server;

class EventListener implements Listener {

    public function __construct(ParticleManager $plugin) {
        $this->plugin = $plugin;
    }

    public function onJoin(PlayerJoinEvent $ev) {
        $player = $ev->getPlayer();
        if (!$this->plugin->isRegistered($player->getName()))
            $this->plugin->register($player->getName());
    }

    public function onMove(PlayerMoveEvent $ev) {
        $player = $ev->getPlayer();
        if (!$this->plugin->isRegistered($player->getName()))
            $this->plugin->register($player->getName());
        if (($particleId = $this->plugin->getSelectParticle($player->getName())) >= 0) {
            if ($this->plugin->getPrice($particleId) !== null) {
                $this->plugin->Normal($player, $particleId);
            }
        }
    }

    public function onJump(PlayerJumpEvent $ev) {
        $player = $ev->getPlayer();
        if (!$this->plugin->isRegistered($player->getName()))
            $this->plugin->register($player->getName());
        if ($this->plugin->hasParticle($player->getName(), 14))
            $this->plugin->Jump($player);
    }

}

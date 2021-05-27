<?php

namespace Particles\task;

use Particles\Loader;
use pocketmine\level\particle\AngryVillagerParticle;
use pocketmine\level\particle\BubbleParticle;
use pocketmine\level\particle\DustParticle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\particle\GenericParticle;
use pocketmine\level\particle\HeartParticle;
use pocketmine\math\Vector3;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class ParticleTask extends Task {

    public function onRun(int $currentTick){
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $name = strtolower($player->getName());
            if (isset(Loader::getInstance()->player[$name])) {
                $x = mt_rand(-15, 15) / 17;
                $y = mt_rand(5, 15) / 9;
                $z = mt_rand(-15, 15) / 17;
                $vector3 = new Vector3($player->getX() + $x, $player->getY() + $y, $player->getZ() - $z);
                switch (Loader::getInstance()->player[$name]) {
                    case "Heart":
                        for ($i = 0; $i <= 2; $i++) {
                            $player->getLevel()->addParticle(new HeartParticle($vector3, 1));
                        }
                        break;
                    case "AngryVillager":
                        for ($i = 0; $i <= 2; $i++) {
                            $player->getLevel()->addParticle(new AngryVillagerParticle($vector3));
                        }
                        break;
                    case "Note":
                        for ($i = 0; $i <= 2; $i++) {
                            $player->getLevel()->addParticle(new GenericParticle($vector3, GenericParticle::TYPE_NOTE, 24));
                        }
                        break;
                    case "Hide Particle":
                        unset(Loader::getInstance()->player[$name]);
                        break;
                    case "Flame":
                        for ($i = 0; $i <= 2; $i++) {
                            $player->getLevel()->addParticle(new FlameParticle($vector3));
                        }
                        break;
                    case "Rainbow":
                        for ($i = 0; $i <= 2; $i++) {
                            $data = mt_rand(0, 255);
                            $player->getLevel()->addParticle(new DustParticle($vector3, $data, $data, $data));
                        }
                        break;
                }
            }
        }
    }
}
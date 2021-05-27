<?php

namespace Particles;

use Particles\command\ParticlesCommand;
use Particles\Event\EventListener;
use Particles\task\ParticleTask;
use pocketmine\block\NoteBlock;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;

class Loader extends PluginBase {

    static $instance = null;
    public $particles = ['Heart', 'AngryVillager', 'Note', 'Flame', 'Rainbow', 'Hide Particle'], $player = [];

    public function onLoad(){
        self::$instance = $this;
    }

    public static function getInstance() : Loader {
        return self::$instance;
    }

    public function onEnable(){
        $this->getScheduler()->scheduleRepeatingTask(new ParticleTask(), 10);
        Server::getInstance()->getCommandMap()->register("particles", new ParticlesCommand("particles", "particles", "/particles"));
      //  Server::getInstance()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}
<?php

namespace Particles\command;

use jojoe77777\FormAPI\CustomForm;
use Particles\Loader;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class ParticlesCommand extends Command {

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            $form = new CustomForm(function (Player $player, $data){
                if($data === null)
                    return true;
                $index = $data[0];
                $selected = Loader::getInstance()->particles[$index];
                Loader::getInstance()->player[strtolower($player->getName())] = $selected;
            });
            $form->setTitle("Particles");
            $form->addDropdown("Select a Particle", Loader::getInstance()->particles);
            $form->sendToPlayer($sender);
        } else {
            $sender->sendMessage("Use this command in the game");
        }
    }
}
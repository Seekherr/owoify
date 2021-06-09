<?php

declare(strict_types=1);

namespace seeker;

use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;

class owoifyCommand extends PluginCommand
{

    /** @var owoify */
    private $owoify;

    public function __construct(string $name, Plugin $owner)
    {
        parent::__construct($name, $owner);
        $this->owoify = $owner;
        $this->setDescription("Owoify your text!");
        $this->setAliases(["owo", "uwuify", "uwu"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender->isOp()) return;
        if(count($args) > 1){
            $sender->sendMessage(TextFormat::RED . "Too many arguments. Use /owoify help for a list of valid arguments.");
            return;
        }
        if(!isset($args[0])){
            $sender->sendMessage(TextFormat::RED . "Insufficient arguments. Use /owoify help for a list of valid arguments.");
            return;
        }
        switch($args[0]){
            case "help":
                $sender->sendMessage(TextFormat::BOLD . TextFormat::GREEN . "Owoify help ;ooo\n" . TextFormat::YELLOW . "- /owoify on " . TextFormat::GRAY . "- turns on owoify!" . TextFormat::YELLOW . "\n- /owoify off " . TextFormat::GRAY . "- turns off owoify!\n");
                break;
            case "enable":
            case "true":
            case "on":
                $this->owoify->getSettings()->set("status", true);
                $this->owoify->getSettings()->save();
                $sender->sendMessage(TextFormat::GREEN . "Owoify has been turned on!... uwu");
                break;
            case "disable":
            case "false":
            case "off":
                $this->owoify->getSettings()->set("status", false);
                $this->owoify->getSettings()->save();
                $sender->sendMessage(TextFormat::GREEN . "Owoify has been turned off! ddy ;c");
                break;
        }
    }
}
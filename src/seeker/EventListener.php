<?php

declare(strict_types=1);

namespace seeker;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;

class EventListener implements Listener
{

    /** @var owoify */
    private $owoify;

    public function __construct(owoify $owoify)
    {
        $this->owoify = $owoify;
    }

    public function onChat(PlayerChatEvent $event) : void
    {
        $player = $event->getPlayer();
        if($this->owoify->getSettings()->get("status") == true){
            $event->setMessage($this->owoify->owoify($event->getMessage()));
        }
    }
}
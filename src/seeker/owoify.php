<?php

declare(strict_types=1);

namespace seeker;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class owoify extends PluginBase
{

    /** @var Config */
    private $settings;

    public function onEnable(): void
    {
        $this->saveResource("config.yml");
        $this->settings = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        if($this->getSettings()->get("more-emojis") == true) $this->getSettings()->set("emojis", false);
        $this->getSettings()->save();
        $this->getServer()->getCommandMap()->register("owoify", new owoifyCommand("owoify", $this));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }

    /*
     * For use with other plugins, you can use
     * $owoify = Server::getInstance()->getPlugin('owoify');
     * $string = $owoify->owoify('string');
     * Make sure you have it downloaded though!
     */
    /**
     * @param string $message
     * @return string|null
     */
    public function owoify(string $message): ?string
    {
        $emotes = [
            '(*^ω^)',
            '(◕‿◕✿)',
            '(◕ᴥ◕)',
            'ʕ•ᴥ•ʔ',
            'ʕ￫ᴥ￩ʔ',
            '(*^.^*)',
            'owo',
            'OwO',
            '(｡♥‿♥｡)',
            'uwu',
            'UwU',
            '(*￣з￣)',
            '>w<',
            '^w^',
            '(つ✧ω✧)つ',
            '(/ =ω=)/',
            ';oooo',
            ';3',
            'hehe'
        ];
        $emojis = [
            'OwO',
            'UwU',
            ';oooo',
            ';3',
            'hehe'
        ];
        $replacements = [
            '/(?:l|r)/' => 'w',
            '/(?:L|R)/' => 'W',
            '/n([aeiou])/' => 'ny',
            '/N([aeiou])|N(AEIOU)/' => 'Ny',
            '/ove/' => 'uv',
            '/nd(?= |$)/' => 'ndo'
        ];
        foreach($replacements as $key => $value){
            $message = preg_replace($key, $value, $message);
            $emoji = mt_rand(1, 2);
            if($emoji === 2){
                if($this->getSettings()->get("emojis") == true) $message .= " " . $emojis[array_rand($emojis, 1)];
                if($this->getSettings()->get("more-emojis") == true) $message .= " " . $emotes[array_rand($emotes, 1)];
            }
        }
        return $message;
    }

    public function getSettings(): Config
    {
        return $this->settings;
    }
}
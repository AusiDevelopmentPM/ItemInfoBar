<?php
/**
 * @org AusiDevelopmentPM
 * @author EyNoah1171
 * @year 2026
 * @license Dont steal my Code.
 */

namespace ADPM\ItemInfoBar;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase
{

    use SingletonTrait;

    public function onEnable(): void
    {
        self::setInstance($this);

        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();

        Server::getInstance()->getPluginManager()->registerEvents(new EventListener(), $this);

        $this->getLogger()->info("ItemInfoBar plugin activated");
    }

    public static function config(): Config
    {
        return new Config(self::getInstance()->getDataFolder() . "config.yml", Config::YAML);
    }

}
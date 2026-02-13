<?php
/**
 * @org AusiDevelopmentPM
 * @author EyNoah1171
 * @year 2026
 * @license Dont steal my Code.
 */

namespace ADPM\ItemInfoBar\tasks;

use ADPM\ItemInfoBar\Loader;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;

class ShowBarTask extends Task
{

    private Player $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function onRun(): void
    {
        foreach (Loader::getInstance()->getServer()->getOnlinePlayers() as $player) {
            if ($player->isOnline()) {
                $message = Loader::config()->getNested("actionbar-message");
                $pos = $player->getPosition();
                $item = $player->getInventory()->getItemInHand();
                $message = str_replace("&", "§", $message);
                $message = str_replace("{x}", $pos->getX(), $message);
                $message = str_replace("{y}", $pos->getY(), $message);
                $message = str_replace("{z}", $pos->getZ(), $message);
                $message = str_replace("{item_name}", $item->getName(), $message);
                $message = str_replace("{item_id}", $item->getTypeId(), $message);
                $message = str_replace("{line}", "\n", $message);
                $player->sendActionBarMessage($message);
            }
        }
    }
}
<?php
namespace Andreykuro\KuroShops;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use Andreykuro\KuroShops\UI\MainMenu;

class Main extends PluginBase {

    public static Main $instance;

    public function onEnable(): void {
        self::$instance = $this;
        $this->getLogger()->info("KuroShops Enabled!");
    }

    public static function getInstance(): Main {
        return self::$instance;
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (strtolower($command->getName()) === "shop") {
            if (!$sender instanceof Player) {
                $sender->sendMessage("§cThis command can only be used in-game!");
                return true;
            }
            MainMenu::open($sender);
            return true;
        }
        return false;
    }
}
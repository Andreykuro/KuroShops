<?php
namespace Andreykuro\KuroShops\UI;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\item\VanillaItems;
use Andreykuro\KuroShops\Utils\Economy;

class CropsUI {
    public static function open(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if($data === null) return;
            match($data) {
                0 => self::buy($player, VanillaItems::WHEAT_SEEDS(), 20),
                1 => self::buy($player, VanillaItems::CARROT(), 30),
                2 => self::buy($player, VanillaItems::POTATO(), 30),
                default => null
            };
        });
        $form->setTitle("§l§2Crops Shop");
        $form->addButton("§fWheat Seeds\n§e$20");
        $form->addButton("§fCarrot\n§e$30");
        $form->addButton("§fPotato\n§e$30");
        $player->sendForm($form);
    }

    private static function buy(Player $player, $item, int $price): void {
        if(Economy::reduceMoney($player, $price)){
            $player->getInventory()->addItem($item->setCount(16));
            $player->sendMessage("§aYou bought 16x " . $item->getName() . " for $" . $price . "!");
        } else {
            $player->sendMessage("§cYou don't have enough money! You need $" . $price . ".");
        }
    }
}

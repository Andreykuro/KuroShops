<?php
namespace Andreykuro\KuroShops\UI;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\item\VanillaItems;
use Andreykuro\KuroShops\Utils\Economy;

class FoodUI {
    public static function open(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if($data === null) return;
            match($data) {
                0 => self::buy($player, VanillaItems::COOKED_BEEF(), 80),
                1 => self::buy($player, VanillaItems::COOKED_CHICKEN(), 60),
                2 => self::buy($player, VanillaItems::BREAD(), 40),
                default => null
            };
        });
        $form->setTitle("§l§cFood Shop");
        $form->addButton("§fSteak\n§e$80");
        $form->addButton("§fCooked Chicken\n§e$60");
        $form->addButton("§fBread\n§e$40");
        $player->sendForm($form);
    }

    private static function buy(Player $player, $item, int $price): void {
        if(Economy::reduceMoney($player, $price)){
            $player->getInventory()->addItem($item->setCount(8));
            $player->sendMessage("§aYou bought 8x " . $item->getName() . " for $" . $price . "!");
        } else {
            $player->sendMessage("§cYou don't have enough money! You need $" . $price . ".");
        }
    }
}

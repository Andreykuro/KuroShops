<?php
namespace Andreykuro\KuroShops\UI;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\item\VanillaItems;
use pocketmine\block\VanillaBlocks;
use Andreykuro\KuroShops\Utils\Economy;

class WoodsUI {
    public static function open(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if($data === null) return;
            match($data) {
                0 => self::buy($player, VanillaBlocks::OAK_LOG()->asItem(), 50),
                1 => self::buy($player, VanillaBlocks::BIRCH_LOG()->asItem(), 60),
                2 => self::buy($player, VanillaBlocks::SPRUCE_LOG()->asItem(), 70),
                default => null
            };
        });
        $form->setTitle("§l§6Woods Shop");
        $form->addButton("§fOak Wood\n§e$50");
        $form->addButton("§fBirch Wood\n§e$60");
        $form->addButton("§fSpruce Wood\n§e$70");
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

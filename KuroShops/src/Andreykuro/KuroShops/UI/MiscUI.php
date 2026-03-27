<?php
namespace Andreykuro\KuroShops\UI;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\item\VanillaItems;
use pocketmine\block\VanillaBlocks;
use Andreykuro\KuroShops\Utils\Economy;

class MiscUI {
    public static function open(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if($data === null) return;
            match($data) {
                0 => self::buy($player, VanillaItems::LAVA_BUCKET(), 1, 500),
                1 => self::buy($player, VanillaItems::WATER_BUCKET(), 1, 400),
                2 => self::buy($player, VanillaBlocks::STONE()->asItem(), 16, 300),
                3 => self::buy($player, VanillaItems::EXPERIENCE_BOTTLE(), 8, 600),
                default => null
            };
        });
        $form->setTitle("§l§5Misc Shop");
        $form->addButton("§fLava Bucket\n§e$500");
        $form->addButton("§fWater Bucket\n§e$400");
        $form->addButton("§fStone §7(16x)\n§e$300");
        $form->addButton("§fXP Bottles §7(8x)\n§e$600");
        $player->sendForm($form);
    }

    private static function buy(Player $player, $item, int $count, int $price): void {
        if(Economy::reduceMoney($player, $price)){
            $player->getInventory()->addItem($item->setCount($count));
            $player->sendMessage("§aYou bought " . $count . "x " . $item->getName() . " for $" . $price . "!");
        } else {
            $player->sendMessage("§cYou don't have enough money! You need $" . $price . ".");
        }
    }
}
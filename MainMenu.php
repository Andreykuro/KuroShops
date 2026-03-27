<?php
namespace Andreykuro\KuroShops\UI;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;

class MainMenu {
    public static function open(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if($data === null) return;
            match($data) {
                0 => WoodsUI::open($player),
                1 => CropsUI::open($player),
                2 => FoodUI::open($player),
                default => null
            };
        });
        $form->setTitle("§l§6KuroShops");
        $form->setContent("§7Select a category to browse:");
        $form->addButton("§lWoods");
        $form->addButton("§lCrops");
        $form->addButton("§lFood");
        $player->sendForm($form);
    }
}
<?php
namespace Andreykuro\KuroShops\UI;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use Andreykuro\KuroShops\Utils\Economy;
use Andreykuro\KuroOreSpawner\Utils\GeneratorItem;

class GeneratorsUI {

    public static function open(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if($data === null) return;
            match($data) {
                0 => self::openOre($player, "coal"),
                1 => self::openOre($player, "iron"),
                2 => self::openOre($player, "gold"),
                3 => self::openOre($player, "diamond"),
                default => null
            };
        });
        $form->setTitle("§l§dGenerators Shop");
        $form->setContent("§7Select an ore type:");
        $form->addButton("§fCoal Generator\n§7From §e$5,000");
        $form->addButton("§fIron Generator\n§7From §e$15,000");
        $form->addButton("§fGold Generator\n§7From §e$25,000");
        $form->addButton("§fDiamond Generator\n§7From §e$60,000");
        $player->sendForm($form);
    }

    public static function openOre(Player $player, string $ore): void {
        $prices = self::getPrices($ore);

        $form = new SimpleForm(function(Player $player, ?int $data) use ($ore, $prices): void {
            if($data === null) {
                self::open($player);
                return;
            }
            match($data) {
                0 => self::buy($player, $ore, 1, $prices[1]),
                1 => self::buy($player, $ore, 2, $prices[2]),
                2 => self::buy($player, $ore, 3, $prices[3]),
                3 => self::open($player),
                default => null
            };
        });

        $form->setTitle("§l§d" . ucfirst($ore) . " Generator");
        $form->setContent("§7Choose a level:\n\n§fLevel 1§7 - Spawns every §e15s\n§fLevel 2§7 - Spawns every §e7s\n§fLevel 3§7 - Spawns every §e3s");
        $form->addButton("§fLevel 1\n§e$" . number_format($prices[1]));
        $form->addButton("§fLevel 2\n§e$" . number_format($prices[2]));
        $form->addButton("§fLevel 3\n§e$" . number_format($prices[3]));
        $form->addButton("§c« Back");
        $player->sendForm($form);
    }

    private static function getPrices(string $ore): array {
        return match($ore) {
            "coal"    => [1 => 5000,  2 => 10000, 3 => 18000],
            "iron"    => [1 => 15000, 2 => 28000, 3 => 45000],
            "gold"    => [1 => 25000, 2 => 45000, 3 => 70000],
            "diamond" => [1 => 60000, 2 => 100000, 3 => 150000],
            default   => [1 => 5000,  2 => 10000, 3 => 18000],
        };
    }

    private static function buy(Player $player, string $ore, int $level, int $price): void {
        if(Economy::reduceMoney($player, $price)){
            $item = GeneratorItem::create($ore, $level);
            $item->setCount(1);
            $player->getInventory()->addItem($item);
            $player->sendMessage("§aYou bought a §f" . ucfirst($ore) . " Generator §7(Level " . $level . ")§a for $" . number_format($price) . "!");
        } else {
            $player->sendMessage("§cNot enough money! You need $" . number_format($price) . ".");
        }
    }
}
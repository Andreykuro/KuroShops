<?php
namespace Andreykuro\KuroShops\Utils;

use pocketmine\player\Player;

class Economy {

    private static function getEco(): ?\NhanAZ\SimpleEconomy\Main {
        return \NhanAZ\SimpleEconomy\Main::getInstance();
    }

    public static function getMoney(Player $player): ?int {
        $eco = self::getEco();
        if ($eco === null) return null;
        return $eco->getMoney(strtolower($player->getName()));
    }

    public static function reduceMoney(Player $player, int $amount): bool {
        $eco = self::getEco();
        if ($eco === null) return false;
        return $eco->reduceMoney(strtolower($player->getName()), $amount);
    }

    public static function addMoney(Player $player, int $amount): bool {
        $eco = self::getEco();
        if ($eco === null) return false;
        return $eco->addMoney(strtolower($player->getName()), $amount);
    }

    public static function setMoney(Player $player, int $amount): bool {
        $eco = self::getEco();
        if ($eco === null) return false;
        return $eco->setMoney(strtolower($player->getName()), $amount);
    }
}

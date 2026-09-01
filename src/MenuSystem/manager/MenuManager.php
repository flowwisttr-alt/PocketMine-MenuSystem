<?php

namespace MenuSystem\manager;

use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use MenuSystem\menu\CustomMenu;
use MenuSystem\form\MenuForm;

class MenuManager
{
    private array $menus = [];
    private array $playerMenus = [];
    private $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }

    public function registerMenu(string $id, array $menuData): void
    {
        $this->menus[$id] = $menuData;
        $this->plugin->getLogger()->info(TF::GREEN . "Menü kaydedildi: $id");
    }

    public function openMenu(Player $player, string $menuId): void
    {
        if (!isset($this->menus[$menuId])) {
            $player->sendMessage(TF::RED . "Menü bulunamadı: $menuId");
            return;
        }

        $menuData = $this->menus[$menuId];
        $form = new MenuForm($this, $menuData, $menuId);
        $player->sendForm($form);
        
        $this->playerMenus[$player->getName()] = $menuId;
    }

    public function getMenus(): array
    {
        return $this->menus;
    }

    public function getMenu(string $id): ?array
    {
        return $this->menus[$id] ?? null;
    }

    public function playerMenuExists(Player $player): bool
    {
        return isset($this->playerMenus[$player->getName()]);
    }

    public function getPlayerMenu(Player $player): ?string
    {
        return $this->playerMenus[$player->getName()] ?? null;
    }

    public function removePlayerMenu(Player $player): void
    {
        unset($this->playerMenus[$player->getName()]);
    }
}

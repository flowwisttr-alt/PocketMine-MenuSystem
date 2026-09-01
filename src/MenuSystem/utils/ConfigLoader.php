<?php

namespace MenuSystem\utils;

use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Utils;
use MenuSystem\MenuSystemPlugin;

class ConfigLoader
{
    private MenuSystemPlugin $plugin;
    private string $menusPath;

    public function __construct(MenuSystemPlugin $plugin)
    {
        $this->plugin = $plugin;
        $this->menusPath = $plugin->getDataFolder() . "menus/";
        
        if (!is_dir($this->menusPath)) {
            @mkdir($this->menusPath, 0777, true);
        }
    }

    public function loadMenus(): void
    {
        if (!is_dir($this->menusPath)) {
            $this->plugin->getLogger()->warning("Menü klasörü bulunamadı!");
            return;
        }

        $files = glob($this->menusPath . "*.json");
        if (empty($files)) {
            $this->plugin->getLogger()->warning("Hiç menü dosyası bulunamadı!");
            return;
        }

        foreach ($files as $file) {
            $this->loadMenuFile($file);
        }
    }

    private function loadMenuFile(string $filePath): void
    {
        if (!file_exists($filePath)) {
            return;
        }

        $json = file_get_contents($filePath);
        $data = json_decode($json, true);

        if (!is_array($data)) {
            $this->plugin->getLogger()->warning(TF::RED . "Geçersiz JSON dosyası: " . basename($filePath));
            return;
        }

        $menuId = $data['id'] ?? basename($filePath, '.json');
        $this->plugin->getMenuManager()->registerMenu($menuId, $data);
    }

    public function getMenusPath(): string
    {
        return $this->menusPath;
    }
}

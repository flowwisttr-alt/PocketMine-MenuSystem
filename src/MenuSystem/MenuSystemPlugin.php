<?php

namespace MenuSystem;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemIds;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\TextFormat as TF;
use MenuSystem\manager\MenuManager;
use MenuSystem\utils\ConfigLoader;

class MenuSystemPlugin extends PluginBase implements Listener
{
    private static MenuSystemPlugin $instance;
    private MenuManager $menuManager;
    private ConfigLoader $configLoader;

    public function onLoad(): void
    {
        self::$instance = $this;
        $this->saveDefaultConfig();
        $this->configLoader = new ConfigLoader($this);
        $this->menuManager = new MenuManager($this);
        
        $this->getLogger()->info(TF::GREEN . "MenuSystem yükleniyor...");
    }

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->configLoader->loadMenus();
        
        $this->getLogger()->info(TF::GREEN . "MenuSystem etkinleştirildi!");
        $this->getLogger()->info(TF::AQUA . "Toplam Menü Sayısı: " . count($this->menuManager->getMenus()));
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if (!$sender instanceof Player) {
            $sender->sendMessage(TF::RED . "Bu komut sadece oyuncular tarafından kullanılabilir!");
            return true;
        }

        if (strtolower($command->getName()) === "menu") {
            if (empty($args)) {
                $sender->sendMessage(TF::YELLOW . "=== MenuSystem Yardımı ===");
                $sender->sendMessage(TF::AQUA . "/menu list - Tüm menüleri listele");
                $sender->sendMessage(TF::AQUA . "/menu open <menu_id> - Menüyü aç");
                $sender->sendMessage(TF::AQUA . "/menu reload - Menüleri yeniden yükle (OP)");
                return true;
            }

            $subcommand = strtolower($args[0]);

            if ($subcommand === "list") {
                $menus = $this->menuManager->getMenus();
                if (empty($menus)) {
                    $sender->sendMessage(TF::RED . "Hiç menü bulunamadı!");
                    return true;
                }
                $sender->sendMessage(TF::GREEN . "=== Mevcut Menüler ===");
                foreach ($menus as $menuId => $menu) {
                    $sender->sendMessage(TF::AQUA . "• " . $menuId . TF::GRAY . " - " . ($menu['title'] ?? 'Başlıksız'));
                }
                return true;
            }

            if ($subcommand === "open" && isset($args[1])) {
                $menuId = $args[1];
                $this->menuManager->openMenu($sender, $menuId);
                return true;
            }

            if ($subcommand === "reload") {
                if (!$sender->hasPermission("menusystem.reload")) {
                    $sender->sendMessage(TF::RED . "Bu komutu kullanma izniniz yok!");
                    return true;
                }
                $this->configLoader->loadMenus();
                $sender->sendMessage(TF::GREEN . "Menüler yeniden yüklendi!");
                return true;
            }
        }

        return false;
    }

    public static function getInstance(): MenuSystemPlugin
    {
        return self::$instance;
    }

    public function getMenuManager(): MenuManager
    {
        return $this->menuManager;
    }
}

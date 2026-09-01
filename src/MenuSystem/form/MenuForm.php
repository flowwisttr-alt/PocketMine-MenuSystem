<?php

namespace MenuSystem\form;

use pocketmine\player\Player;
use pocketmine\form\Form;
use pocketmine\utils\TextFormat as TF;
use MenuSystem\manager\MenuManager;

class MenuForm implements Form
{
    private MenuManager $menuManager;
    private array $menuData;
    private string $menuId;

    public function __construct(MenuManager $menuManager, array $menuData, string $menuId)
    {
        $this->menuManager = $menuManager;
        $this->menuData = $menuData;
        $this->menuId = $menuId;
    }

    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            $this->menuManager->removePlayerMenu($player);
            return;
        }

        $buttons = $this->menuData['buttons'] ?? [];
        if (isset($buttons[$data])) {
            $button = $buttons[$data];
            $this->executeAction($player, $button);
        }
    }

    private function executeAction(Player $player, array $button): void
    {
        $action = $button['action'] ?? null;
        $actionData = $button['data'] ?? [];

        switch ($action) {
            case 'command':
                $command = $actionData['command'] ?? '';
                $player->getServer()->dispatchCommand($player, $command);
                break;

            case 'message':
                $message = $actionData['message'] ?? '';
                $player->sendMessage(TF::colorize($message));
                break;

            case 'menu':
                $nextMenuId = $actionData['menu_id'] ?? '';
                $this->menuManager->openMenu($player, $nextMenuId);
                break;

            case 'teleport':
                $x = $actionData['x'] ?? 0;
                $y = $actionData['y'] ?? 0;
                $z = $actionData['z'] ?? 0;
                $level = $player->getServer()->getWorldManager()->getDefaultWorld();
                $player->teleport($level->getSpawnLocation());
                $player->sendMessage(TF::GREEN . "Teleport edildiniz!");
                break;

            case 'give_item':
                $itemId = $actionData['item_id'] ?? 0;
                $amount = $actionData['amount'] ?? 1;
                $player->getInventory()->addItem(ItemFactory::getInstance()->get($itemId, 0, $amount));
                break;
        }
    }

    public function jsonSerialize(): mixed
    {
        $buttons = [];
        foreach ($this->menuData['buttons'] ?? [] as $button) {
            $buttons[] = $button['text'] ?? 'Düğme';
        }

        return [
            'type' => 'form',
            'title' => $this->menuData['title'] ?? 'Menü',
            'content' => $this->menuData['description'] ?? '',
            'buttons' => array_map(function($text) {
                return ['text' => $text];
            }, $buttons)
        ];
    }
}

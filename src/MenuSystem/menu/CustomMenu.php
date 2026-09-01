<?php

namespace MenuSystem\menu;

class CustomMenu
{
    private string $id;
    private string $title;
    private string $description;
    private array $buttons;
    private ?string $parentMenu;

    public function __construct(
        string $id,
        string $title,
        string $description,
        array $buttons,
        ?string $parentMenu = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->buttons = $buttons;
        $this->parentMenu = $parentMenu;
    }

    public function getId(): string { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getButtons(): array { return $this->buttons; }
    public function getParentMenu(): ?string { return $this->parentMenu; }
}

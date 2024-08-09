<?php

declare(strict_types=1);

namespace Xima\XimaTypo3FrontendEdit\Template\Component;

use TYPO3\CMS\Core\Imaging\Icon;
use Xima\XimaTypo3FrontendEdit\Enumerations\ButtonType;

class Button
{
    protected string $label;
    protected ButtonType $type;
    protected ?string $url;
    protected ?Icon $icon;
    protected array $children;

    public function __construct(string $label, ButtonType $type, ?string $url = null, ?Icon $icon = null)
    {
        $this->label = $label;
        $this->type = $type;
        $this->url = $url;
        $this->icon = $icon;
        $this->children = [];
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return \Xima\XimaTypo3FrontendEdit\Enumerations\ButtonType
     */
    public function getType(): ButtonType
    {
        return $this->type;
    }

    /**
     * @param \Xima\XimaTypo3FrontendEdit\Enumerations\ButtonType $type
     */
    public function setType(ButtonType $type): void
    {
        $this->type = $type;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getIcon(): ?Icon
    {
        return $this->icon;
    }

    public function setIcon(?Icon $icon): void
    {
        $this->icon = $icon;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChildren(array $children): void
    {
        $this->children = $children;
    }

    public function appendChild(Button $button, string|int $key): void
    {
        $this->children[$key] = $button;
    }

    public function appendAfterChild(Button $button, string|int $appendAfterKey, string|int $key): void
    {
        $offset = array_search($appendAfterKey, array_keys($this->children)) + 1;
        $this->children = array_slice($this->children, 0, $offset, true) +
            [$key => $button] +
            array_slice($this->children, $offset, null, true);
    }

    public function removeChild(string|int $key): void
    {
        unset($this->children[$key]);
    }

    public function render(): array
    {
        $result = [
            'label' => $GLOBALS['LANG']->sL($this->label),
            'type' => $this->type->value,
        ];

        if ($this->url) {
            $result['url'] = $this->url;
        }

        if ($this->icon) {
            $result['icon'] = $this->icon->getAlternativeMarkup('inline');
        }

        if (!empty($this->children)) {
            $result['children'] = array_map(fn (Button $button) => $button->render(), $this->children);
        }

        return $result;
    }
}

<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets\Provider;

use TYPO3\CMS\Dashboard\Widgets\Provider\ButtonProvider;

/**
 * Extended button provider including an icon
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ExtendedButtonProvider extends ButtonProvider
{
    /**
     * @var string
     */
    private $icon;

    public function __construct(string $title, string $link, string $target = '', string $icon = '')
    {
        parent::__construct($title, $link, $target);
        $this->icon = $icon;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getExtendedButtonConfiguration(): array
    {
        return ($this->getTitle() === '' || $this->getLink() === '')
            ? []
            : [
                'text' => $this->getTitle(),
                'link' => $this->getLink(),
                'target' => $this->getTarget(),
                'icon' => $this->getIcon()
            ];
    }
}

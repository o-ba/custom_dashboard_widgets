<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets\Provider;

use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\Provider\ButtonProvider;

/**
 * Provides an extended button with following additional configuration:
 * - icon                  string         Identifier of a icon registered in IconRegistry
 * - moduleExtension       string         Link to an internal module
 * - moduleLinkParameters  string         Additional link parameters for a link to an internal module
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ExtendedButtonProvider extends ButtonProvider
{
    /** @var string */
    private $icon;

    /** @var string */
    private $moduleExtension;

    /** @var bool */
    private $moduleLinkParameters;

    public function __construct(
        string $title,
        string $link,
        string $target = '',
        string $icon = '',
        string $moduleExtension = '',
        array $moduleLinkParameters = []
    ) {
        parent::__construct($title, $link, $target);
        $this->icon = $icon;
        $this->moduleExtension = $moduleExtension;
        $this->moduleLinkParameters = $moduleLinkParameters;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getExtendedLink(): string
    {
        return $this->moduleExtension !== '' && ExtensionManagementUtility::isLoaded($this->moduleExtension)
            ? (string)GeneralUtility::makeInstance(UriBuilder::class)->buildUriFromRoute($this->getLink(), $this->moduleLinkParameters)
            : $this->getLink();
    }
}

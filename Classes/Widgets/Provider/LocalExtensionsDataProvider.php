<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets\Provider;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\Interfaces\NumberWithIconDataProviderInterface;
use TYPO3\CMS\Extensionmanager\Utility\ListUtility;

/**
 * Data provider for widget `localExtensions`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class LocalExtensionsDataProvider implements NumberWithIconDataProviderInterface
{
    public function getNumber(): int
    {
        return \count(GeneralUtility::makeInstance(ListUtility::class)->getAvailableExtensions('Local'));
    }
}

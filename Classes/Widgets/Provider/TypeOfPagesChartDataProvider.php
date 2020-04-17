<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets\Provider;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\WidgetApi;
use TYPO3\CMS\Dashboard\Widgets\ChartDataProviderInterface;

/**
 * Data provider for widget `typeOfPages`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class TypeOfPagesChartDataProvider implements ChartDataProviderInterface
{
    private const DOKTYPES_TO_CHECK = [
        PageRepository::DOKTYPE_DEFAULT,
        PageRepository::DOKTYPE_LINK,
        PageRepository::DOKTYPE_SHORTCUT,
        PageRepository::DOKTYPE_BE_USER_SECTION,
        PageRepository::DOKTYPE_MOUNTPOINT,
        PageRepository::DOKTYPE_SPACER,
        PageRepository::DOKTYPE_SYSFOLDER,
        PageRepository::DOKTYPE_RECYCLER
    ];

    /**
     * @var LanguageService
     */
    private $languageService;

    /**
     * @var QueryBuilder
     */
    private $pagesQueryBuilder;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
        $this->pagesQueryBuilder = $this->getPagesQueryBuilder();
    }

    public function getChartData(): array
    {
        $labels = [];
        $data = [];

        foreach (self::DOKTYPES_TO_CHECK as $doktype) {
            $amount = $this->getAmountOfPagesByDoktype($doktype);
            if ($amount) {
                $labels[] = \htmlspecialchars($this->languageService->sL('LLL:EXT:custom_dashboard_widgets/Resources/Private/Language/locallang.xlf:widgets.typeOfPages.' . $doktype));
                $data[] = $amount;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'backgroundColor' => WidgetApi::getDefaultChartColors(),
                    'data' => $data
                ]
            ]
        ];
    }

    private function getAmountOfPagesByDoktype(int $doktype): int
    {
        return (int)$this->pagesQueryBuilder
            ->count('*')
            ->from('pages')
            ->where(
                $this->pagesQueryBuilder
                    ->expr()
                    ->eq(
                        'doktype',
                        $this->pagesQueryBuilder->createNamedParameter($doktype, Connection::PARAM_INT)
                    )
            )
            ->execute()
            ->fetchColumn(0);
    }

    private function getPagesQueryBuilder(): QueryBuilder
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder;
    }
}


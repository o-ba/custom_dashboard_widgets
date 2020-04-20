<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets\Provider;

use Bo\CustomDashboardWidgets\WidgetApi;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\ChartDataProviderInterface;

/**
 * Data provider for chart widgets which display the amount of records per type
 * based on following configuration:
 * - table           string         The table the records should be fetched from
 * - order           string         The order direction (Default: `ASC`)
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class RecordsByTypeDataProvider implements ChartDataProviderInterface
{
    /** @var LanguageService */
    private $languageService;

    /** @var string */
    private $table;

    /** @var string */
    private $order;

    /** @var string */
    private $typeField;

    /** @var array */
    private $recordTypes;

    public function __construct(
        LanguageService $languageService,
        string $table,
        string $order = 'ASC'
    ) {
        $this->languageService = $languageService;
        $this->table = $table;
        $this->order = $order;
        $this->typeField = $GLOBALS['TCA'][$this->table]['ctrl']['type'] ?? '';
        $this->recordTypes = $GLOBALS['TCA'][$this->table]['columns'][$this->typeField]['config']['items'] ?? [];
    }

    public function getChartData(): array
    {
        if ($this->typeField === '') {
            throw new \InvalidArgumentException(
                'The selected table \'' . $this->table . '\' has no type field defined in $GLOBALS[\'TCA\'][\'' . $this->table .'\'][\'ctrl\'][\'type\'].'
            );
        }

        $labels = [];
        $data = [];

        foreach ($this->getRecordsGroupedByType() as $item) {
            $labels[] = $this->getLabelForRecordType((string)$item[$this->typeField]);
            $data[] = $item['count'];
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'backgroundColor' => WidgetApi::getDefaultChartDataColors(),
                    'data' => $data
                ]
            ]
        ];
    }

    private function getRecordsGroupedByType(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder
            ->select($this->typeField)
            ->addSelectLiteral('COUNT(*) AS count')
            ->from($this->table)
            ->groupBy($this->typeField)
            ->orderBy('count', $this->order)
            ->execute()
            ->fetchAll();
    }

    private function getLabelForRecordType(string $type): string
    {
        foreach ($this->recordTypes as $recordType) {
            if ((string)($recordType[1] ?? '') === $type) {
                return $this->languageService->sL($recordType[0] ?? '');
            }
        }

        return '';
    }
}

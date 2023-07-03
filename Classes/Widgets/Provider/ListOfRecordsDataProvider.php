<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets\Provider;

use Bo\CustomDashboardWidgets\Widgets\ListOfRecordsDataProviderInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Provides records based on following configuration:
 * - table           string         The table the records should be fetched from
 * - limit           int            The maximum number of records to be fetched (Defaul: 5)
 * - orderField      string         The order field (Defaul: `uid`)
 * - order           string         The order direction (Default: `DESC`)
 *
 * Note: No permission checks for the fetched records take place!
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ListOfRecordsDataProvider implements ListOfRecordsDataProviderInterface
{
    private string $table;
    private int $limit;
    private string $orderField;
    private string $order;

    public function __construct(string $table, int $limit = 5, string $orderField = 'uid', string $order = 'DESC')
    {
        $this->table = $table;
        $this->limit = $limit;
        $this->orderField = $orderField;
        $this->order = $order;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getItems(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder
            ->select('*')
            ->from($this->table)
            ->setMaxResults($this->limit)
            ->addOrderBy($this->orderField, $this->order)
            ->executeQuery()
            ->fetchAllAssociative();
    }
}

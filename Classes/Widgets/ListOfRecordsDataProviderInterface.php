<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

/**
 * Interface for all data provider which return a list of records
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
interface ListOfRecordsDataProviderInterface
{
    /**
     * Return the table, the records are fetched from
     *
     * @return string
     */
    public function getTable(): string;

    /**
     * Return the records to be shown
     *
     * @return array
     */
    public function getItems(): array;
}

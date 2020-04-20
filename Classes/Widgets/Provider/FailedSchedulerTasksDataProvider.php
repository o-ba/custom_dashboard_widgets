<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets\Provider;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\ListDataProviderInterface;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

/**
 * Data provider for widget `failedSchedulerTasks` fetches failed tasks
 * and prepares them for the table view.
 *
 * @see ListOfFailedSchedulerTasksWidget
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class FailedSchedulerTasksDataProvider implements ListDataProviderInterface
{
    public function getItems(): array
    {
        $items = [];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_scheduler_task');
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $tasks = $queryBuilder
            ->select('*')
            ->from('tx_scheduler_task')
            ->where($queryBuilder->expr()->neq('lastexecution_failure', $queryBuilder->createNamedParameter('')))
            ->addOrderBy('lastexecution_time', 'DESC')
            ->execute()
            ->fetchAll();

        foreach ($tasks as $task) {
            $taskObject = \unserialize($task['serialized_task_object'], ['allowed_classes' => true]);
            if ($taskObject instanceof AbstractTask) {
                $items[(int)$task['uid']] = [
                    'title' => $taskObject->getTaskTitle(),
                    'type' => $taskObject->getType(),
                    'description' => $taskObject->getTaskDescription(),
                    'additionalInformation' => $taskObject->getAdditionalInformation(),
                    'executionTime' => $taskObject->getExecutionTime()
                ];
            }
        }

        return $items;
    }
}

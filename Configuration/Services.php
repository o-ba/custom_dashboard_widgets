<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets;

use Bo\CustomDashboardWidgets\Widgets\ListOfFailedSchedulerTasksWidget;
use Bo\CustomDashboardWidgets\Widgets\Provider\ExtendedButtonProvider;
use Bo\CustomDashboardWidgets\Widgets\Provider\FailedSchedulerTasksDataProvider;
use Bo\CustomDashboardWidgets\Widgets\Provider\LocalExtensionsDataProvider;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use TYPO3\CMS\Dashboard\Widgets\NumberWithIconWidget;
use TYPO3\CMS\Extensionmanager\Utility\ListUtility;
use TYPO3\CMS\Scheduler\Scheduler;

return static function (ContainerConfigurator $configurator, ContainerBuilder $containerBuilder) {
    $services = $configurator->services()->defaults()->autowire()->autoconfigure();
    $languagePath = 'LLL:EXT:custom_dashboard_widgets/Resources/Private/Language/locallang.xlf:';
    $extensionIcon = 'tx-custom_dashboard_widgets-extension-icon';

    if ($containerBuilder->hasDefinition(ListUtility::class)) {
        $services
            ->set('dashboard.widget.localExtensions')
            ->class(NumberWithIconWidget::class)
            ->arg('$dataProvider', new Reference(LocalExtensionsDataProvider::class))
            ->arg('$view', new Reference('dashboard.views.widget'))
            ->arg(
                '$options',
                [
                    'title' => $languagePath . 'widgets.localExtensions.content.title',
                    'icon' => 'tx-custom_dashboard_widgets-extensions-icon'
                ]
            )
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'localExtensions',
                    'groupNames' => 'custom',
                    'title' => $languagePath . 'widgets.localExtensions.title',
                    'description' => $languagePath . 'widgets.localExtensions.description',
                    'iconIdentifier' => $extensionIcon
                ]
            );
    }

    if ($containerBuilder->hasDefinition(Scheduler::class)) {
        $services
            ->set('dashboard.extendedButtons.failedSchedulerTasks')
            ->class(ExtendedButtonProvider::class)
            ->arg('$title', $languagePath . 'widgets.failedSchedulerTasks.button.title')
            ->arg('$link', 'system_txschedulerM1')
            ->arg('$target', '')
            ->arg('$icon', 'actions-arrow-right')
            ->arg('$moduleExtension', 'scheduler');

        $services
            ->set('dashboard.widget.failedSchedulerTasks')
            ->class(ListOfFailedSchedulerTasksWidget::class)
            ->arg('$dataProvider', new Reference(FailedSchedulerTasksDataProvider::class))
            ->arg('$view', new Reference('dashboard.views.widget'))
            ->arg('$buttonProvider', new Reference('dashboard.extendedButtons.failedSchedulerTasks'))
            ->tag(
                'dashboard.widget',
                [
                    'identifier' => 'failedSchedulerTasks',
                    'groupNames' => 'custom',
                    'title' => $languagePath . 'widgets.failedSchedulerTasks.title',
                    'description' => $languagePath . 'widgets.failedSchedulerTasks.description',
                    'iconIdentifier' => $extensionIcon,
                    'height' => 'medium',
                    'width' => 'medium'
                ]
            );
    }
};

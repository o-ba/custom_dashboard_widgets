<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\ListDataProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Configuration for widget `failedSchedulerTasks`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ListOfFailedSchedulerTasksWidget implements WidgetInterface, AdditionalCssInterface
{
    /** @var WidgetConfigurationInterface */
    private $configuration;

    /** @var \TYPO3\CMS\Dashboard\Widgets\ListDataProviderInterface */
    private $dataProvider;

    /** @var StandaloneView */
    private $view;

    /** @var ButtonProviderInterface|null */
    private $buttonProvider;

    /** @var array */
    private $options;

    public function __construct(
        WidgetConfigurationInterface $configuration,
        ListDataProviderInterface $dataProvider,
        StandaloneView $view,
        $buttonProvider = null,
        array $options = []
    ) {
        $this->configuration = $configuration;
        $this->dataProvider = $dataProvider;
        $this->view = $view;
        $this->buttonProvider = $buttonProvider;
        $this->options = $options;
    }

    public function renderWidgetContent(): string
    {
        $this->view->setTemplate('Widget/ListOfFailedSchedulerTasksWidget');
        $this->view->assignMultiple([
            'configuration' => $this->configuration,
            'tasks' => $this->dataProvider->getItems(),
            'button' => $this->buttonProvider,
            'options' => $this->options,
        ]);

        return $this->view->render();
    }

    public function getCssFiles(): array
    {
        return [
            'EXT:custom_dashboard_widgets/Resources/Public/Css/Widget/FailedSchedulerTasksWidget.css',
            'EXT:custom_dashboard_widgets/Resources/Public/Css/General/NoItemsFound.css'
        ];
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}

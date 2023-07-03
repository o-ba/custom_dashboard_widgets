<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use Bo\CustomDashboardWidgets\Widgets\Provider\FailedSchedulerTasksDataProvider;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\View\BackendViewFactory;
use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\RequestAwareWidgetInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;

/**
 * Configuration for widget `failedSchedulerTasks`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ListOfFailedSchedulerTasksWidget implements WidgetInterface, AdditionalCssInterface, RequestAwareWidgetInterface
{
    protected ServerRequestInterface $request;

    public function __construct(
        protected readonly WidgetConfigurationInterface $configuration,
        protected readonly FailedSchedulerTasksDataProvider $dataProvider,
        protected readonly BackendViewFactory $backendViewFactory,
        protected readonly ?ButtonProviderInterface $buttonProvider = null,
        protected array $options = []
    ) {
    }

    public function renderWidgetContent(): string
    {
        return $this->backendViewFactory
            ->create($this->request, ['typo3/cms-dashboard', 'o-ba/custom_dashboard_widgets'])
            ->assignMultiple([
                'configuration' => $this->configuration,
                'tasks' => $this->dataProvider->getItems(),
                'button' => $this->buttonProvider,
                'options' => $this->options,
            ])
            ->render('Widget/ListOfFailedSchedulerTasksWidget');
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

    public function setRequest(ServerRequestInterface $request): void
    {
        $this->request = $request;
    }
}

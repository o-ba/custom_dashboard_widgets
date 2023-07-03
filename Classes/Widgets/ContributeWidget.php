<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\View\BackendViewFactory;
use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;
use TYPO3\CMS\Dashboard\Widgets\RequestAwareWidgetInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;

/**
 * Configuration for widget `contribute`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ContributeWidget implements WidgetInterface, AdditionalCssInterface, RequestAwareWidgetInterface
{
    private ServerRequestInterface $request;

    public function __construct(
        protected readonly WidgetConfigurationInterface $configuration,
        protected readonly BackendViewFactory $backendViewFactory,
        protected array $options = []
    ) {
    }

    public function renderWidgetContent(): string
    {
        return $this->backendViewFactory
            ->create($this->request, ['typo3/cms-dashboard', 'o-ba/custom_dashboard_widgets'])
            ->assignMultiple([
                'configuration' => $this->configuration,
                'options' => $this->options,
            ])
            ->render('Widget/ContributeWidget');
    }

    public function getCssFiles(): array
    {
        return ['EXT:custom_dashboard_widgets/Resources/Public/Css/Widget/ContributeWidget.css'];
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

<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\View\BackendViewFactory;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\RequestAwareWidgetInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;

/**
 * Configuration for widget `extensionInformation`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ExtensionInformationWidget implements WidgetInterface, RequestAwareWidgetInterface
{
    protected ServerRequestInterface $request;

    public function __construct(
        protected readonly WidgetConfigurationInterface $configuration,
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
                'button' => $this->buttonProvider,
                'options' => $this->options
            ])
            ->render('Widget/ExtensionInformationWidget');
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

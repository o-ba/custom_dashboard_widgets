<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Configuration for widget `contribute`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ContributeWidget implements WidgetInterface, AdditionalCssInterface
{
    /** @var WidgetConfigurationInterface */
    private $configuration;

    /** @var StandaloneView */
    private $view;

    /** @var array */
    private $options;

    public function __construct(
        WidgetConfigurationInterface $configuration,
        StandaloneView $view,
        array $options = []
    ) {
        $this->configuration = $configuration;
        $this->view = $view;
        $this->options = $options;
    }

    public function renderWidgetContent(): string
    {
        $this->view->setTemplate('Widget/ContributeWidget');
        $this->view->assignMultiple([
            'configuration' => $this->configuration,
            'options' => $this->options
        ]);

        return $this->view->render();
    }

    public function getCssFiles(): array
    {
        return ['EXT:custom_dashboard_widgets/Resources/Public/Css/Widget/ContributeWidget.css'];
    }
}

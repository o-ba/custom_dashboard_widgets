<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use TYPO3\CMS\Dashboard\Widgets\Interfaces\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\Interfaces\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Configuration for widget `extensionInformation`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
final class ExtensionInformationWidget implements WidgetInterface
{
    /**
     * @var WidgetConfigurationInterface
     */
    private $configuration;

    /**
     * @var StandaloneView
     */
    private $view;

    /**
     * @var array
     */
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
        $this->view->setTemplate('Widget/ExtensionInformationWidget');
        $this->view->assignMultiple([
            'options' => $this->options,
            'configuration' => $this->configuration
        ]);

        return $this->view->render();
    }
}

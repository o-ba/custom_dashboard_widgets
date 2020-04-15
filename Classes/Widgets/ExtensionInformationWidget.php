<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use Bo\CustomDashboardWidgets\Widgets\Provider\ExtendedButtonProvider;
use TYPO3\CMS\Dashboard\Utility\ButtonUtility;
use TYPO3\CMS\Dashboard\Widgets\Interfaces\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\Interfaces\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\Interfaces\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Configuration for widget `extensionInformation`
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ExtensionInformationWidget implements WidgetInterface
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
     * @var ButtonProviderInterface|null
     */
    private $buttonProvider;

    /**
     * @var array
     */
    private $options;

    public function __construct(
        WidgetConfigurationInterface $configuration,
        StandaloneView $view,
        $buttonProvider = null,
        array $options = []
    ) {
        $this->configuration = $configuration;
        $this->view = $view;
        $this->buttonProvider = $buttonProvider;
        $this->options = $options;
    }

    public function renderWidgetContent(): string
    {
        $this->view->setTemplate('Widget/ExtensionInformationWidget');
        $this->view->assignMultiple([
            'configuration' => $this->configuration,
            'button' => $this->getButtonConfiguration(),
            'options' => $this->options
        ]);

        return $this->view->render();
    }

    private function getButtonConfiguration(): array
    {
        return $this->buttonProvider instanceof ExtendedButtonProvider
            ? $this->buttonProvider->getExtendedButtonConfiguration()
            : ButtonUtility::generateButtonConfig($this->buttonProvider);
    }
}

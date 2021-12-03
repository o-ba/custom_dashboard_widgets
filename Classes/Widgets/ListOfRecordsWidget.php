<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets\Widgets;

use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Widget configuration for widgets displaying a list of records
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class ListOfRecordsWidget implements WidgetInterface, AdditionalCssInterface
{
    /** @var WidgetConfigurationInterface */
    private $configuration;

    /** @var ListOfRecordsDataProviderInterface */
    private $dataProvider;

    /** @var StandaloneView */
    private $view;

    /** @var ButtonProviderInterface|null */
    private $buttonProvider;

    /** @var array  */
    private $options;

    public function __construct(
        WidgetConfigurationInterface $configuration,
        ListOfRecordsDataProviderInterface $dataProvider,
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
        $recordTable = $this->dataProvider->getTable();

        if (!($this->options['titleField'] ?? false)) {
            $this->options['titleField'] = $GLOBALS['TCA'][$recordTable]['ctrl']['label'] ?? '';
        }

        $this->view->setTemplate('Widget/ListOfRecordsWidget');
        $this->view->assignMultiple([
            'configuration' => $this->configuration,
            'records' => $this->dataProvider->getItems(),
            'table' => $recordTable,
            'button' => $this->buttonProvider,
            'options' => $this->options
        ]);

        return $this->view->render();
    }

    public function getCssFiles(): array
    {
        return ['EXT:custom_dashboard_widgets/Resources/Public/Css/General/NoItemsFound.css'];
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}

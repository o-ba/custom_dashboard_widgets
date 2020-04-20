<?php
declare(strict_types=1);

namespace Bo\CustomDashboardWidgets;

/**
 * Extended API for widgets.
 *
 * @author Oliver Bartsch <bo@cedev.de>
 */
class WidgetApi extends \TYPO3\CMS\Dashboard\WidgetApi
{
    public static function getDefaultChartDataColors(bool $shuffle = true): array
    {
        $colorPalette = [
            '#1abc9c', '#16a085', '#f1c40f', '#f39c12', '#2ecc71', '#27ae60', '#e67e22', '#d35400', '#3498db',
            '#2980b9', '#e74c3c', '#c0392b', '#9b59b6', '#8e44ad', '#ecf0f1', '#bdc3c7', '#34495e', '#2c3e50',
            '#95a5a6', '#7f8c8d'
        ];

        if ($shuffle) {
            \shuffle($colorPalette);
        }

        return $colorPalette;
    }
}

<?php


call_user_func(static function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        "@import 'EXT:custom_dashboard_widgets/Configuration/TSconfig/User/options.tsconfig'"
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
        "@import 'EXT:custom_dashboard_widgets/Configuration/TypoScript/setup.typoscript'"
    );
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    foreach (['extension', 'dashboard', 'extensions', 'issue', 'merge'] as $icon) {
        $iconRegistry->registerIcon(
            'tx-custom_dashboard_widgets-' . $icon . '-icon',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:custom_dashboard_widgets/Resources/Public/Icons/' . \ucfirst($icon) . '.svg']
        );
    }
});

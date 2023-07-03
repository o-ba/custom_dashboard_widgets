<?php

call_user_func(static function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
        "@import 'EXT:custom_dashboard_widgets/Configuration/TSconfig/User/options.tsconfig'"
    );
});

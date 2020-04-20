<?php
return [
    'custom' => [
        'title' => 'LLL:EXT:custom_dashboard_widgets/Resources/Private/Language/locallang.xlf:presets.custom.title',
        'description' => 'LLL:EXT:custom_dashboard_widgets/Resources/Private/Language/locallang.xlf:presets.custom.description',
        'iconIdentifier' => 'tx-custom_dashboard_widgets-dashboard-icon',
        'showInWizard' => true,
        'defaultWidgets' => [
            'extensionInformation',
            'failedSchedulerTasks',
            'recentlyCreatedPages',
            'recentlyModifiedContent',
            'localExtensions',
            'typeOfPages',
            'typeOfContent',
            't3blog',
            'contribute'
        ]
    ]
];

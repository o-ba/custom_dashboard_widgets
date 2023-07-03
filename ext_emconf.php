<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Custom dashboard widgets',
    'description' => 'Set of custom widgets for the new dashboard module. Let\'s start creating your own!',
    'category' => 'be',
    'author' => 'Oliver Bartsch',
    'author_email' => 'bo@cedev.de',
    'author_company' => '',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '1.3.0',
    'autoload' => [
        'psr-4' => [
            'Bo\\CustomDashboardWidgets\\' => 'Classes'
        ]
    ],
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
        ],
        'conflicts' => [],
        'suggests' => [
            'extensionmananger' => '',
            'scheduler' => '',
        ],
    ]
];

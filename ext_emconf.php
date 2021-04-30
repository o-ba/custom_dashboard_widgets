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
    'version' => '1.1.1',
    'autoload' => [
        'psr-4' => [
            'Bo\\CustomDashboardWidgets\\' => 'Classes'
        ]
    ],
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
            'php' => '7.2.0-7.4.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];

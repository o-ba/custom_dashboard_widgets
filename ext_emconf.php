<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 custom dashboard widgets',
    'description' => 'Set of custom widgets for the new dashboard module.',
    'category' => 'be',
    'author' => 'Oliver Bartsch',
    'author_email' => 'bo@cedev.de',
    'author_company' => '',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '0.1.0',
    'autoload' => [
        'psr-4' => [
            'Bo\\CustomDashboardWidgets\\' => 'Classes'
        ]
    ],
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.9.99',
            'php' => '7.2.0-7.4.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];

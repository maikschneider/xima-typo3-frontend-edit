<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use Xima\XimaTypo3FrontendEdit\Configuration;

defined('TYPO3') or die();

call_user_func(function () {
    $temporaryColumns = [
        'tx_ximatypo3frontendedit_disable' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang_db.xlf:be_users.tx_ximatypo3frontendedit_disable',
            'description' => 'LLL:EXT:' . Configuration::EXT_KEY . '/Resources/Private/Language/locallang_db.xlf:be_users.tx_ximatypo3frontendedit_disable.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => 'hide',
                    ],
                ],
            ],
        ],
    ];

    ExtensionManagementUtility::addTCAcolumns('be_users', $temporaryColumns);
});

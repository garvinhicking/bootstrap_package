<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types']['tab'] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types']['tab'] = [];
}

// Add content element PageTSConfig
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'bootstrap_package',
    'Configuration/TsConfig/Page/ContentElement/Element/Tab.tsconfig',
    'Bootstrap Package Content Element: Tab'
);

// Add content element to selector list
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.tab',
        'description' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.tab.description',
        'value' => 'tab',
        'icon' => 'content-bootstrappackage-tab',
        'group' => 'bootstrap_package',
    ],
    'social_links',
    'after'
);

// Assign Icon
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['tab'] = 'content-bootstrappackage-tab';

// Configure element type
$GLOBALS['TCA']['tt_content']['types']['tab'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['tab'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                tx_bootstrappackage_tab_item,
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tab.options,
                pi_flexform;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:advanced,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                categories,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                rowDescription,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
        ',
    ]
);

// Register fields
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'tx_bootstrappackage_tab_item' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tab_item',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_bootstrappackage_tab_item',
                'foreign_field' => 'tt_content',
                'appearance' => [
                    'useSortable' => true,
                    'showSynchronizationLink' => true,
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'expandSingle' => true,
                    'enabledControls' => [
                        'localize' => true,
                    ],
                ],
                'behaviour' => [
                    'mode' => 'select',
                ],
            ],
        ],
    ]
);

// Add flexForms for content element configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:bootstrap_package/Configuration/FlexForms/Tab.xml',
    'tab'
);

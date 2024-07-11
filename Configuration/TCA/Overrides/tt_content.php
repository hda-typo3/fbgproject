<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Fbgproject',
    'Project1',
    'FBG Project - Selection'
    );

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['fbgproject_project1'] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['fbgproject_project1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('fbgproject_project1', 'FILE:EXT:fbgproject/Configuration/FlexForms/flexform1.xml');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Fbgproject',
    'Project2',
    'FBG Project - Show'
    );

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['fbgproject_project2'] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['fbgproject_project2'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('fbgproject_project2', 'FILE:EXT:fbgproject/Configuration/FlexForms/flexform2.xml');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Fbgproject',
    'Project3',
    'FBG Project - Lecture'
    );

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['fbgproject_project3'] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['fbgproject_project3'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('fbgproject_project3', 'FILE:EXT:fbgproject/Configuration/FlexForms/flexform3.xml');

<?php
defined('TYPO3_MODE') or die();


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'project',
    'Configuration/TsConfig/fbgproject.typoscript',
    'EXT:project: Only project-data'
);

?>

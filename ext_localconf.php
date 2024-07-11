<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Fbgproject',
        'Project1',
        [
            \Hda\Fbgproject\Controller\ProjectController::class => 'list,show'
        ],
        // non-cacheable actions
        [
            \Hda\Fbgproject\Controller\ProjectController::class => 'show'
        ]
        );
    
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Fbgproject',
        'Project3',
        [
            \Hda\Fbgproject\Controller\ProjectController::class => 'lecturer'
        ],
        // non-cacheable actions
        [
            \Hda\Fbgproject\Controller\ProjectController::class => ''
        ]
        );
    

    /* ==  Add TSconfig ============================================ */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fbgproject/Configuration/TsConfig/Page/Mod/Wizards/NewContentElement.typoscript">');
    
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fbgproject/Configuration/TsConfig/Templates.typoscript">');
    
   
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    
    $iconRegistry->registerIcon(
        'fbgproject-plugin-1',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:fbgproject/Resources/Public/Icons/fbgproject-plugin-1.svg']
        );
    
    $iconRegistry->registerIcon(
        'fbgproject-plugin-2',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:fbgproject/Resources/Public/Icons/fbgproject-plugin-2.svg']
        );

    $iconRegistry->registerIcon(
        'fbgproject-plugin-3',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:fbgproject/Resources/Public/Icons/fbgproject-plugin-3.svg']
        );
    

})();

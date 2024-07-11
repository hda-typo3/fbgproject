<?php

namespace Hda\Fbgproject\Hooks;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use Hda\Fbgproject\Utility\TemplateLayout;
use TYPO3\CMS\Backend\Utility\BackendUtility as BackendUtilityCore;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

/**
 * Userfunc to render alternative label for media elements
 */
class ItemsProcFunc
{

    /** @var TemplateLayout $templateLayoutsUtility */
    protected $templateLayoutsUtility;

    public function __construct()
    {
        $this->templateLayoutsUtility = GeneralUtility::makeInstance(TemplateLayout::class);
    }

    /**
     * Itemsproc function to extend the selection of templateLayouts in the plugin
     *
     * @param array &$config configuration array
     */
    public function user_templateLayout(array &$config)
    {
        $pageId = 0;
        $currentColPos = null;
        if (ExtensionManagementUtility::isLoaded('compatibility6')) {
            if (StringUtility::beginsWith($config['row']['uid'], 'NEW')) {
                $getVars = GeneralUtility::_GET('edit');
                if (is_array($getVars) && isset($getVars['tt_content']) && is_array($getVars['tt_content'])) {
                    $keys = array_keys($getVars['tt_content']);
                    $firstKey = (int)$keys[0];
                    if ($firstKey > 0) {
                        $pageId = $firstKey;
                    } else {
                        $row = $this->getContentElementRow(abs($firstKey));
                        $pageId = $row['pid'];
                    }
                }
            } else {
                $row = $this->getContentElementRow($config['row']['uid']);
                $pageId = $row['pid'];
            }
            if (isset($config['row']['colPos'])) {
                $currentColPos = $config['row']['colPos'];
            }
        } else {
            $currentColPos = $config['flexParentDatabaseRow']['colPos'];
            $pageId = $this->getPageId($config['flexParentDatabaseRow']['pid']);
        }

        if ($pageId > 0) {
            $templateLayouts = $this->templateLayoutsUtility->getAvailableTemplateLayouts($pageId);

            $templateLayouts = $this->reduceTemplateLayouts($templateLayouts, $currentColPos);
            foreach ($templateLayouts as $layout) {
                $additionalLayout = [
                    htmlspecialchars($this->getLanguageService()->sL($layout[0])),
                    $layout[1]
                ];
                array_push($config['items'], $additionalLayout);
            }
        }
    }

    /**
     * Reduce the template layouts by the once which are not allowed in given colPos
     * @param array $templateLayouts
     * @param int $currentColPos
     * @return array
     */
    protected function reduceTemplateLayouts($templateLayouts, $currentColPos)
    {
        $currentColPos = (int)$currentColPos;
        $restrictions = [];
        $allLayouts = [];
        foreach ($templateLayouts as $key => $layout) {
            if (is_array($layout[0])) {
                if (isset($layout[0]['allowedColPos']) && StringUtility::endsWith($layout[1], '.')) {
                    $layoutKey = substr($layout[1], 0, -1);
                    $restrictions[$layoutKey] = GeneralUtility::intExplode(',', $layout[0]['allowedColPos'], true);
                }
            } else {
                $allLayouts[$layout[1]] = $layout;
            }
        }

        if (!empty($restrictions)) {
            foreach ($restrictions as $restrictedIdentifier => $restrictedColPosList) {
                if (!in_array($currentColPos, $restrictedColPosList, true)) {
                    unset($allLayouts[$restrictedIdentifier]);
                }
            }
        }

        return $allLayouts;
    }

   
    /**
     * Get all languages
     *
     * @return array
     */
    protected function getAllLanguages()
    {
        if (class_exists(ConnectionPool::class)) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
                ->getQueryBuilderForTable('sys_language');
            return $queryBuilder->select('*')
                ->from('sys_language')
                ->orderBy('sorting')
                ->execute()
                ->fetchAll();
        } else {
            return $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
                '*',
                'sys_language',
                '1=1 ' . BackendUtilityCore::deleteClause('sys_language')
            );
        }
    }

    /**
     * Get tt_content record
     *
     * @param int $uid
     * @return array
     */
    protected function getContentElementRow($uid)
    {
        return BackendUtilityCore::getRecord('tt_content', $uid);
    }

    /**
     * Get page id, if negative, then it is a "after record"
     *
     * @param int $pid
     * @return int
     */
    protected function getPageId($pid)
    {
        $pid = (int)$pid;

        if ($pid > 0) {
            return $pid;
        }

        $row = BackendUtilityCore::getRecord('tt_content', abs($pid), 'uid,pid');
        return $row['pid'];
    }

    /**
     * Returns LanguageService
     *
     * @return \TYPO3\CMS\Lang\LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}

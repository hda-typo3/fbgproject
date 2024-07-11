<?php

namespace Hda\Fbgproject\Service;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class FlexFormService
{

    /**
     * Function that finds all projects, who are dispayed in the flexform as an object 
     * @param $params
     * @param $pObj
     */
    
    public function projects(&$params, &$pObj){
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        $projectRepository = $this->objectManager->get(\Hda\Fbgproject\Domain\Repository\ProjectRepository::class);
		  
        $startingpoints = $this->getStartingpoints($params);
        
        if ($startingpoints != '') {
            if ($startingpoints[0] != '') {
                $starts = count($startingpoints) - 1;
                for ($x = 0; $x <= $starts; $x++) {
                    foreach ($projectRepository->findProject($startingpoints[$x]) as $project) {
                        $projects[] = array('title' => $project->getTitle(), 'uid' => $project->getUid());
                    }       
                }   
                 // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $projects[1]); 
                
                if ($projects != '') {     
                    asort($projects);
                    foreach ($projects as $project) {
                        $params['items'][] = array(
                        $project['title'], $project['uid']
                        );
                    }       
                }  
                 // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($projects);       
            }
        }
    }
    
    public function lecteurs(&$params, &$pObj)
    {
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        $userRepository = $this->objectManager->get(\Hda\Fbgproject\Domain\Repository\PersonRepository::class);

        
        if (class_exists('TYPO3\CMS\Core\Configuration\ExtensionConfiguration')) {
            $extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
                );
            $Configuration = $extensionConfiguration->get('fbgproject');
        } else {
            $Configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('fbgproject');
            if (!is_array($Configuration)) {
                $Configuration = unserialize($Configuration);
            }
        }

        $groups = explode( ',', $Configuration['userGroupLecturesUid']);
                      
       if ($groups[0] != '') {
           $starts = count($groups) - 1;
           for ($x = 0; $x <= $starts; $x++) {
               foreach ($userRepository->findLecteurs($groups[$x]) as $person) {
                 // $persons[] = $person->getUid();
                 //  $persons[] = array('uid' => $person->getUid());
                //   $persons[][] = 
                   $persons[] = array($person->getUid(), $person->getName() );
               }
           }
                      
           foreach ($persons as list($person,$uid)) {
               $params['items'][] = array(
                  $uid, $person
               );
           }
       }

    }
    
    /**
     * Function for the Startingpoints from the flexform
     * Initially sets $this->storagePoints
     * @param $params
     * @return array
     */
    public function getStartingpoints($params){
        $storagePoints = $params['row']['settings.pages'];
        if(!empty($storagePoints)) {
            foreach ($storagePoints as $storagePoint) {
                $result[] = $storagePoint['uid'];
            }    
        }
        else {
            $result = '';
        }
        return $result;
    }

}

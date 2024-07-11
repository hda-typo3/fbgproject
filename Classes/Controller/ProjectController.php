<?php

declare(strict_types=1);

namespace Hda\Fbgproject\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository as ExtbaseFrontendUserRepository;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use \GeorgRinger\NumberedPagination\NumberedPagination;

/**
 * ProjectController
 */
class ProjectController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * projectRepository
     * 
     * @var \Hda\Fbgproject\Domain\Repository\ProjectRepository
     */
    protected $projectRepository = null;

    /**
     * categoryRepository
     *
     * @var \Hda\Fbgproject\Domain\Repository\CategoryRepository
     */
    protected $categoryRepository;  

    /**
     * semesterRepository
     *
     * @var \Hda\Fbgproject\Domain\Repository\SemesterRepository
     */
    protected $semesterRepository;  

    /**
     * degreecourseRepository
     *
     * @var \Hda\Fbgproject\Domain\Repository\DegreecourseRepository
     */
    protected $degreecourseRepository;  
    
    
    /**
     * @param \Hda\Fbgproject\Domain\Repository\ProjectRepository $projectRepository
     */
    public function injectProjectRepository(\Hda\Fbgproject\Domain\Repository\ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    
    /**
     * @param \Hda\Fbgproject\Domain\Repository\CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(\Hda\Fbgproject\Domain\Repository\CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @param \Hda\Fbgproject\Domain\Repository\SemesterRepository $semesterRepository
     */
    public function injectSemesterRepository(\Hda\Fbgproject\Domain\Repository\SemesterRepository $semesterRepository)
    {
        $this->semesterRepository = $semesterRepository;
    }
    
    /**
     * @param \Hda\Fbgproject\Domain\Repository\DegreecourseRepository $degreecourseRepository
     */
    public function injectDegreeRepository(\Hda\Fbgproject\Domain\Repository\DegreecourseRepository $degreecourseRepository)
    {
        $this->degreecourseRepository = $degreecourseRepository;
    }

  
    public function initializeAction()
    {
        $querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings');
        
        $querySettings->setRespectStoragePage(FALSE);
  
       // $this->userRepository->setDefaultQuerySettings($querySettings);
        $this->projectRepository->setDefaultQuerySettings($querySettings); 
        $this->semesterRepository->setDefaultQuerySettings($querySettings);
        $this->categoryRepository->setDefaultQuerySettings($querySettings);
        $this->degreecourseRepository->setDefaultQuerySettings($querySettings);
    }

  
    /**
     * action category semester list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
     
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        
        $arguments = $this->request->getArguments();
        
        $content = $this->configurationManager->getContentObject();
        $flexFormString = $content->data['pi_flexform'];
        $flexFormRaw = GeneralUtility::xml2array($flexFormString);
        // $itemsPerPage = intval($flexFormRaw['data']['sDEF']['lDEF']['settings.itemPerPage']['vDEF']);
        $itemsPerPage = 20;
        // $maximumLinks = intval($flexFormRaw['data']['sDEF']['lDEF']['settings.maximumLinks']['vDEF']);
		$maximumLinks = 15;        

        $cat = $this->settings["category"];
		$sem = $this->settings["semester"];
		$deg = $this->settings["degreecourse"];
		$pro = $this->settings["individualprojects"];
		
		
		
		if ($pro){
		    $projects = $this->projectRepository->findSelectProject($pro);
		    // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($pro);
		} else {
		    $projects = $this->projectRepository->findList($cat,$sem,$deg);
		    // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($cat,$sem,$deg);
		}
		
		
		// $allItems = $this->projectRepository->findList($cat,$sem,$deg);
		
		$currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;
		$paginator = new \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator($projects, $currentPage, $itemsPerPage);
		$pagination = new \GeorgRinger\NumberedPagination\NumberedPagination($paginator, $maximumLinks);
		

        $this->view->assign('pagination', [
            'paginator' => $paginator,
            'pagination' => $pagination,
            
        ]);
        $this->view->assign('projects', $projects);
        
        
        return $this->htmlResponse();
    }
    

   /**
     * action lecturer list
     * @return void
     */
     
    public function lecturerAction(){
        $lecturer = $this->settings["lecturer"];

		if ($lecturer){	
			$projects = $this->projectRepository->findByLecturer($lecturer,$projects);
		}
		
		$this->view->assign('projects', $projects);

    }

    /**
     * action show
     * 
     * @param \Hda\Fbgproject\Domain\Model\Project $project
   * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Hda\Fbgproject\Domain\Model\Project $project)
    {
        $this->view->assign('project', $project);
    }
}

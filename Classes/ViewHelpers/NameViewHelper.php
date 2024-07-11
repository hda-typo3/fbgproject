<?php

namespace Hda\Fbgproject\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class NameViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    
    use CompileWithRenderStatic;
    
    public function initializeArguments()
    {
        $this->registerArgument('person', 'string', '', true);
    }
    
    /**
     * @var \Hda\Fbgproject\Domain\Repository\PageRepository
     * @inject
     */
    protected $pageRepository;
	
    /**
     * ViewHelper to show the name with title
     * 
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string|unknown
     * 
     */
    
    
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
        ) {
            if ($arguments['person'] === NULL){
                return '';
            }
            else {
		        $displayName = $arguments['person'];
		        $nameArray = explode (',', $displayName);

				return $nameArray[2] . $nameArray[1]. ' ' . $nameArray[0] ; 	
			}
    }
}

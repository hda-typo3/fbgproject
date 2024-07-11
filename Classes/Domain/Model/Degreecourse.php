<?php

declare(strict_types=1);

namespace Hda\Fbgproject\Domain\Model;


/***
 *
 * This file is part of the "FBG Project" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2023 Michael Lang <michael.lang@h-da.de>, h_da
 *
 ***/
/**
 * Degreecourse
 */
class Degreecourse extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     * 
     * @var string
     */
    protected $title = '';

    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}

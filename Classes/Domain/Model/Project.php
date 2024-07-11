<?php

declare(strict_types=1);

namespace Hda\Fbgproject\Domain\Model;


/**
 * This file is part of the "FBG Project" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Michael Lang <michael.lang@h-da.de>, h_da
 */

/**
 * Project
 */
class Project extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    
    /**
     * title
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $title = '';
    
    /**
     * @var string
     */
    protected $pathSegment = '';
    
    /**
     * teaser
     *
     * @var string
     */
    protected $teaser = '';
    
    /**
     * description
     *
     * @var string
     */
    protected $description = '';
    
    /**
     * students
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $students;
    
    /**
     * studentsfreetext
     *
     * @var string
     */
    protected $studentsfreetext = '';
    
    /**
     * lecturers
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lecturers;
    
    /**
     * lecturersfreetext
     *
     * @var string
     */
    protected $lecturersfreetext = '';
    
    
    /**
     * degreecourse
     *
     * @var \Hda\Fbgproject\Domain\Model\Degreecourse
     */
    protected $degreecourse = null;
    
    /**
     * date
     *
     * @var string
     */
    protected $date = '';
    
    /**
     * copartner
     *
     * @var string
     */
    protected $copartner = '';
    
    /**
     * copartnerlink
     *
     * @var string
     */
    protected $copartnerlink = '';
    
    
    /**
     * lightboxstyle
     *
     * @var string
     */
    protected $lightboxstyle = '';
    
    
    /**
     * thumbimage
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $thumbimage = null;
    
    /**
     * topimage
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $topimage = null;
    
    /**
     * media
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $media = null;
    
    /**
     * semester
     *
     * @var \Hda\Fbgproject\Domain\Model\Semester
     */
    protected $semester = null;
    
    /**
     * category
     *
     * @var \Hda\Fbgproject\Domain\Model\Category
     */
    protected $category = null;
    
    
    /**************** /


    /**
     * __construct
     */
    public function __construct()
    {
        
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->media = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->lecturers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->students = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
   
    
    /**
    * Returns the title
    *
    * @return string
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
    
    /**
     * Get path segment
     *
     * @return string
     */
    public function getPathSegment(): string
    {
        return $this->pathSegment;
    }
    
    
    /**
     * Set path segment
     *
     * @param string $pathSegment
     *
     * @return void
     */
    public function setPathSegment($pathSegment): void
    {
        $this->pathSegment = $pathSegment;
    }
    
    
    /**
     * Returns the teaser
     *
     * @return string
     */
    public function getTeaser()
    {
        return $this->teaser;
    }
    
    /**
     * Sets the teaser
     *
     * @param string $teaser
     * @return void
     */
    public function setTeaser(string $teaser)
    {
        $this->teaser = $teaser;
    }
    
    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    
    
    
    /**
     * Adds a student
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $students
     * @return void
     */
    public function addStudents(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $students)
    {
        $this->students->attach($students);
    }
    
    /**
     * Removes a student
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $studentsToRemove The FileReference to be removed
     * @return void
     */
    public function removeStudents(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $studentsToRemove)
    {
        $this->students->detach($studentsToRemove);
    }
    
    /**
     * Returns the students
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $students
     */
    public function getStudents()
    {
        return $this->students;
    }
    
    /**
     * Sets the students
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $students
     * @return void
     */
    public function setStudents(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $students)
    {
        $this->students = $students;
    }
    
    /**
     * Returns the studentsfreetext
     *
     * @return string $studentsfreetext
     */
    public function getStudentsfreetext()
    {
        return $this->studentsfreetext;
    }
    
    /**
     * Sets the studentsfreetext
     *
     * @param string $studentsfreetexte
     * @return void
     */
    public function setStudentsfreetext($studentsfreetext)
    {
        $this->studentsfreetext = $studentsfreetext;
    }
    
    
    /**
     * Adds a lecturer
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $lecturers
     * @return void
     */
    public function addLecturers(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $lecturers)
    {
        $this->lecturers->attach($lecturers);
    }
    
    /**
     * Removes a lecturer
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $lecturersToRemove The FileReference to be removed
     * @return void
     */
    public function removeLecturers(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $lecturersToRemove)
    {
        $this->lecturers->detach($lecturersToRemove);
    }
    
    /**
     * Returns the lecturers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser> $lecturers
     */
    public function getLecturers()
    {
        return $this->lecturers;
    }
    
    /**
     * Sets the lecturers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser> $lecturers
     * @return void
     */
    public function setLecturers(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $lecturers)
    {
        $this->lecturers = $lecturers;
    }
    
    /**
     * Returns the lecturersfreetext
     *
     * @return string $lecturersfreetext
     */
    public function getLecturersfreetext()
    {
        return $this->lecturersfreetext;
    }
    
    /**
     * Sets the lecturersfreetext
     *
     * @param string $lecturersfreetext
     * @return void
     */
    public function setLecturersfreetext($lecturersfreetext)
    {
        $this->lecturersfreetext = $lecturersfreetext;
    }
    
    /**
     * Returns the degreecourse
     *
     * @return \Hda\Fbgproject\Domain\Model\Degreecourse $degreecourse
     */
    public function getDegreecourse()
    {
        return $this->degreecourse;
    }
    
    /**
     * Sets the degreecourse
     *
     * @param \Hda\Fbgproject\Domain\Model\Degreecourse $degreecourse
     * @return void
     */
    public function setDegreecourse(\Hda\Fbgproject\Domain\Model\Degreecourse $degreecourse)
    {
        $this->degreecourse = $degreecourse;
    }
    
    
    /**
     * Returns the date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Sets the date
     *
     * @param string $date
     * @return void
     */
    public function setDate(string $date)
    {
        $this->date = $date;
    }
    
    
    /**
     * Returns the copartner
     *
     * @return string $copartner
     */
    public function getCopartner()
    {
        return $this->copartner;
    }
    
    /**
     * Sets the copartner
     *
     * @param string $copartner
     * @return void
     */
    public function setCopartner($copartner)
    {
        $this->copartner = $copartner;
    }
    
    /**
     * Returns the copartnerlink
     *
     * @return string $copartnerlink
     */
    public function getCopartnerlink()
    {
        return $this->copartnerlink;
    }
    
    /**
     * Sets the copartnerlink
     *
     * @param string $copartnerlink
     * @return void
     */
    public function setCopartnerlink($copartnerlink)
    {
        $this->copartnerlink = $copartnerlink;
    }
    
    
    /**
     * Returns the lightboxstyle
     *
     * @return string $lightboxstyle
     */
    public function getLightboxstyle()
    {
        return $this->lightboxstyle;
    }
    
    /**
     * Sets the lightboxstyle
     *
     * @param string $lightboxstyle
     * @return void
     */
    public function setLightboxstyle($lightboxstyle)
    {
        $this->lightboxstyle = $lightboxstyle;
    }
    
    
    /**
     * Returns the thumbimage
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getThumbimage()
    {
        return $this->thumbimage;
    }
    
    /**
     * Sets the thumbimage
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $thumbimage
     * @return void
     */
    public function setThumbimage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $thumbimage)
    {
        $this->thumbimage = $thumbimage;
    }
    
    
    /**
     * Returns the topimage
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getTopimage()
    {
        return $this->topimage;
    }
    
    /**
     * Sets the topimage
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $topimage
     * @return void
     */
    public function setTopimage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $topimage)
    {
        $this->topimage = $topimage;
    }
    
    
    /**
     * Returns the media
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Sets the media
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
     * @return void
     */
    public function setMedia(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $bilder)
    {
        $this->media = $media;
    }
    
    
    /**
     * Returns the semester
     *
     * @return \Hda\Fbgproject\Domain\Model\Semester
     */
    public function getSemester()
    {
        return $this->semester;
    }
    
    /**
     * Sets the semester
     *
     * @param \Hda\Fbgproject\Domain\Model\Semester $semester
     * @return void
     */
    public function setSemester(\Hda\Fbgproject\Domain\Model\Semester $semester)
    {
        $this->semester = $semester;
    }
    
    /**
     * Returns the category
     *
     * @return \Hda\Fbgproject\Domain\Model\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Sets the category
     *
     * @param \Hda\Fbgproject\Domain\Model\Category $category
     * @return void
     */
    public function setCategory(\Hda\Fbgproject\Domain\Model\Category $category)
    {
        $this->category = $category;
    }
    

}
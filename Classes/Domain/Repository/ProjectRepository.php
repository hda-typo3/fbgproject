<?php

declare(strict_types=1);

namespace Hda\Fbgproject\Domain\Repository;


/***
 *
 * This file is part of the "FBG Project" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Michael Lang <michael.lang@h-da.de>, h_da
 *
 ***/

/**
 * The repository for Projects
 */
class ProjectRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @param array $startingpoints
     * @return mixed
     */
    public function findProject($startingpoints)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query = $query->matching($query->logicalAnd($query->equals('pid', $startingpoints)));
        return $query->execute();
    }

    /**
     * @param array $projects
     * @param int $lecturer
     * @return mixed
     */
    public function findByLecturer($lecturer, $projects)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        $query->matching(
        $query->logicalAnd([$query->equals('uid', '$lecturer')])
        );
        return $query->execute();
    }

    /**
     * Returns all objects of this selected Categorie and semester
     *
     * @param $pro
     * @return QueryResultInterface|array
     */
    public function findSelectProject($pro)
    {
        $uidArray = explode(',', $pro);
        $query = $this->createQuery();
        $query->matching(
        $query->in('uid', $uidArray),
        $query->logicalAnd(
        $query->equals('hidden', 0),
        $query->equals('deleted', 0)
        )
        );
        return $query->execute();
    }

    /**
     * Returns all objects of this selected Categorie and semester
     *
     * @param $cat
     * @param $sem
     * @param $deg
     * @return QueryResultInterface|array
     */
    public function findList($cat, $sem, $deg)
    {
        $query = $this->createQuery();
        $constraints = array();
        if ($deg) {
            $constraints[] = $query->equals('degreecourse', $deg);
        }
        if ($cat) {
            $constraints[] = $query->equals('category', $cat);
        }
        if ($sem) {
            $constraints[] = $query->equals('semester', $sem);
        }
        if (count($constraints)) {
            $query->matching(
            $query->logicalAnd(
            $constraints,
            $query->equals('hidden', 0),
            $query->equals('deleted', 0)
            )
            );
        }
        return $query->execute();
    }
}

<?php
/**
 * License: Ebrahimpour.me
 *
 * @category Motorbikes
 * @package	Motorbikes
 * @subpackage
 * @copyright Copyright (c) 2018 Ebrahimpour.me (http://www.ebrahimpour.me)
 * @author	Majid Ebrahimpour
 * @version	0.1
 * @link
 * @reviewer
 *
 */
namespace Application\Model\Service;

interface MotorbikesModelServiceInterface
{
    /**
     * get list.
     *
	 * @param array $params
     */
	public function getList($params);

	/**
	 * a function to save.
	 *
	 * @param array $params
	 *
	 */
	public function save($params);

}
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
namespace Application\Service;

interface MotorbikesAppServiceInterface {

	/**
	 * get list
	 * @param array $psrams
	 * return array
	 */
	public function getList($psrams);
	
	/**
	 * save function
	 * @param array $psrams
	 * return array
	 */
	public function save($psrams);

}
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

use Application\Model\Service\MotorbikesModelService;

class MotorbikesAppService implements MotorbikesAppServiceInterface
{

    /**
     * @var \Application\Model\Service\MotorbikesModelService
     */
    protected $motorbikesModelService;

    public function __construct(
        MotorbikesModelService $motorbikesModelService
	)
    {
        $this->motorbikesModelService = $motorbikesModelService;
    }

    /**
     * @see \Application\Service\MotorbikesAppServiceInterface::getList($params)
     */
    public function getList($params)
    {
    	return $this->motorbikesModelService->getList($params);
    }
    
    /**
     * @see \Application\Service\MotorbikesAppServiceInterface::save()
     */
    public function save($params)
    {
        return $this->motorbikesModelService->save($params);
    }

}
<?php
/**
 *
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
 */

namespace Application\Controller;

use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Application\Service\MotorbikesAppService;

/**
 * RESTful API for Motorbikes module which includes the following
 * HTTP Methods, (getList, get, put, delete).
 * Currently only the getList method is available, further discussions
 * may yield to utilizing other methods.
 *
 * P.S: Need a dispatching mechanisim in order to understand
 * how to handle the REST calls.
 * @author Majid Ebrahimpour
 *
 */
class ApiController extends AbstractRestfulController
{
	const LISTLIMIT = 20;

    /**
     * @var MotorbikesAppService
     */
    protected $motorbikesAppService;

    public function __construct(
        MotorbikesAppService $motorbikesAppService
    )
    {
        header("Access-Control-Allow-Origin: *");
        $this->motorbikesAppService = $motorbikesAppService;
    }

    public function getList()
    {
        $params = [];
        $params['module'] = $this->params()->fromQuery('module', null);        
        $params['filters'] = $this->params()->fromQuery('filters', null);        
        $params['orders'] = $this->params()->fromQuery('orders', null);        
        $data = $this->motorbikesAppService->getList($params);
        return new JsonModel([
            'done' => true,
            'data' => $data
        ]);

    }

    public function get($id)
    {
        return new JsonModel([
            'get' => true,
        ]);
    }

    public function create($params)
    {
        
        $data = $this->motorbikesAppService->save($params);
        return new JsonModel([
            'done' => true,
            'data' => $data,
        ]);
    }

    public function patch($id, $data)
    {
        return new JsonModel([
            'patch' => true,
        ]);
    }

    public function deleteList($data)
    {
        return new JsonModel([
            'deleteList' => true,
        ]);
    }

    public function delete($id)
    {
        return new JsonModel([
            'delete' => true,
        ]);
    }
}
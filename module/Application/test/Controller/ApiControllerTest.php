<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ApplicationTest\Controller;

use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Application\Controller\Factory\ApiControllerFactory;

class ApiControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;
    protected $motorbikesAppService;
    
    public function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];
        $config = include __DIR__ . '/../../../../config/application.config.php';
        $this->setApplicationConfig(ArrayUtils::merge(
            $config,
            $configOverrides
        ));

        parent::setUp();

        $serviceLocator = $this->getApplication()->getServiceManager();
        $this->motorbikesAppService = $serviceLocator->get('MotorbikesAppService');
        
    }
    
    public function testGetListMotorbike()
    {
        $this->assertResponseStatusCode(200);        
        $params = [
            'module' => 'motorbike'
        ];
        $data = $this->motorbikesAppService->getList($params);
        $numItems = (count($data) > 0) ? true : false ;        
        $this->assertTrue($numItems, "NO ITEMS!!!");
        
    }
}

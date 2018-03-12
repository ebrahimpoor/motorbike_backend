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

namespace Application\Service\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Application\Service\MotorbikesAppService;

class MotorbikesAppServiceFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $motorbikesModelService = $container->get('MotorbikesModelService');
        
        return new MotorbikesAppService(
            $motorbikesModelService
        );
    }
}
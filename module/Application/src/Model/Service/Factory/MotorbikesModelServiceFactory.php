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
 *
 */

namespace Application\Model\Service\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Application\Model\Service\MotorbikesModelService;

class MotorbikesModelServiceFactory implements FactoryInterface { 

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        $service = new MotorbikesModelService(
			$entityManager
        );

        return $service;
    }
}
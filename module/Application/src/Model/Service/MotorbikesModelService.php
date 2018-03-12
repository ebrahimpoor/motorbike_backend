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

use Application\Model\Repository\MotorbikesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Application\Entity\Motorbikes;
use Application\Entity\Color;
use Application\Entity\Cc;
use Application\Entity\Model;

class MotorbikesModelService implements MotorbikesModelServiceInterface
{
    /**
	 * @var EntityManager
	 */
	protected $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
        )
    {
        $this->entityManager = $entityManager;
    }

    
    /**
     * @see \Application\Model\Service\MotorbikesModelServiceInterface::getList($params)
     */
    public function getList($params)
    {
        try {
            $module = [
                'motorbike' => 'getMotorbikeList',
                'model' => 'getModelList',
                'color' => 'getColorList',
                'cc' => 'getCcList'
            ];
            
            $functionName = $module[$params['module']];
            return $this->$functionName($params);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    private function getMotorbikeList($params) 
    {
        $result = [];
        /**
         * @var Motorbikes[] $motorbikes
         */
        $motorbikes = $this->motorbikesRepository()->geList($params);
        $i = 0;
        foreach ($motorbikes as $bikes) {
            $result[$i]['id'] = $bikes->getMotorbikesId();
            $result[$i]['model'] = (!empty($bikes->getModel())) ? $bikes->getModel()->getTitle() : '';
            $result[$i]['cc'] = (!empty($bikes->getCc())) ? $bikes->getCc()->getTitle() : '';
            $result[$i]['color'] = (!empty($bikes->getColor())) ? $bikes->getColor()->getTitle() : '';
            $result[$i]['weight'] = $bikes->getWeight();
            $result[$i]['price'] = $bikes->getPrice();
            $result[$i]['addedTime'] = (!empty($bikes->getAddedTime())) ? $bikes->getAddedTime()->format('Y-m-d') : '';
            $i++;
        }
        return $result;
    }
    
    private function getColorList($params)
    {
        $result = [];
        /**
         * @var Color[] $color
         */
        $color = $this->getEntityManager()->getRepository(Color::class)->findAll();
        foreach ($color as $item) {
            $id = $item->getColorId();
            $result[$id]['id'] = $id;
            $result[$id]['title'] = $item->getTitle();
        }
        return $result;
    }
    
    private function getCcList($params)
    {
        $result = [];
        /**
         * @var Cc[] $cc
         */
        $cc = $this->getEntityManager()->getRepository(Cc::class)->findAll();
        foreach ($cc as $item) {
            $id = $item->getCcId();
            $result[$id]['id'] = $id;
            $result[$id]['title'] = $item->getTitle();
        }
        return $result;
    }
    
    private function getModelList($params)
    {
        $result = [];
        /**
         * @var Model[] $cc
         */
        $model = $this->getEntityManager()->getRepository(Model::class)->findAll();
        foreach ($model as $item) {
            $id = $item->getModelId();
            $result[$id]['id'] = $id;
            $result[$id]['title'] = $item->getTitle();
        }
        return $result;
    }
    
    /**
     * @see \Application\Model\Service\MotorbikesModelServiceInterface::save()
     */
    public function save($params)
    {
        $cc = $params['cc'];
        
        $module = [
            'motorbike' => 'saveMotorbike',
            'model' => 'saveModel',
            'color' => 'saveColor',
            'cc' => 'saveCc'
        ];
        
        $functionName = $module[$params['module']];
        return $this->$functionName($params);
    }
    
    private function saveMotorbike($params)
    {
        $data       = $params['data'];
        $motorbike  = null;
        $id         = (isset($data['id']) && $data['id']) ? (int)$data['id'] : 0;
        $modelId    = (isset($data['model']) && $data['model']) ? (int)$data['model'] : 0;
        $colorId    = (isset($data['color']) && $data['color']) ? (int)$data['color'] : 0;
        $ccId       = (isset($data['cc']) && $data['cc']) ? (int)$data['cc'] : 0;
        $weight     = (isset($data['weight']) && $data['weight']) ? (int)$data['weight'] : 0;
        $price      = (isset($data['price']) && $data['price']) ? (int)$data['price'] : 0;
        
        if($id) {
            $motorbike = $this->motorbikesRepository()->find($id);
            if(!$motorbike instanceof Motorbikes)
                return false;
        } else {
            $motorbike = new Motorbikes();
        }
        
        $model = null;
        if($modelId) {
            $model = $this->getEntityManager()->getRepository(Model::class)->find($modelId);
            if($model instanceof Model) {
                $motorbike->setModel($model);
            }
        }
        
        $color = null;
        if($colorId) {
            $color = $this->getEntityManager()->getRepository(Color::class)->find($colorId);
            if($color instanceof Color) {
                $motorbike->setColor($color);
            }
        }
        
        $cc = null;
        if($ccId) {
            $cc = $this->getEntityManager()->getRepository(Cc::class)->find($ccId);
            if($cc instanceof Cc) {
                $motorbike->setCc($cc);
            }
        }
        
        $motorbike->setWeight($weight);
        $motorbike->setPrice($price);
        
        $addedTime = new \DateTime();
        $motorbike->setAddedTime($addedTime);
        
        $this->entityManager->persist($motorbike);
        $this->entityManager->flush();
        
        return [
            'done' => true
        ];   
    }
    
    private function saveModel($params)
    {
        $model = new Model();
        $result = $this->saveTitle($params, $model);
        return [
            'done' => $result
        ];
    }
    
    private function saveColor($params)
    {
        $color = new Color();
        $result = $this->saveTitle($params, $color);    
        return [
            'done' => $result
        ];
    }
    
    private function saveCc($params)
    {
        $cc = new Cc();
        $result = $this->saveTitle($params, $cc);    
        return [
            'done' => $result
        ];
    }
    
    private function saveTitle($params, $entity) 
    {
        $data   = $params['data'];
        $title  = (isset($data['title']) && $data['title']) ? trim($data['title']) : '';
        if($title != '') {
            $entity->setTitle($title);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            return true;
        }
        return false;
    }
    
    /**
     * @return \Application\Model\Repository\MotorbikesRepository
     */
    private function motorbikesRepository() 
    {
        return $this->getEntityManager()->getRepository(Motorbikes::class);
    }
    
    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->entityManager;
    }
    
}
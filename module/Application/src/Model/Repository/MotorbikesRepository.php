<?php
/**
 *
 * MotorbikesRepository
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
namespace Application\Model\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\Motorbikes;
use Application\Entity\Model;
use Application\Entity\Color;
use Application\Entity\Cc;

class MotorbikesRepository extends EntityRepository
{
    
    public function geList($params) 
    {
        $filters        = array_key_exists('filters', $params) ? json_decode($params['filters'], true) : [];
        $orders         = array_key_exists('orders', $params) ? json_decode($params['orders'], true) : [];
        $last           = array_key_exists('last', $filters) ? intval($filters['last']) : 0;
        $limit          = array_key_exists('limit', $filters) ? intval($filters['limit']) : 0;
        
        $qb = $this->createQueryBuilder('motorbikes')
                    ->select('motorbikes')
                    ->leftJoin(Model::class, 'model', 'WITH', 'model.modelId = motorbikes.model')
                    ->leftJoin(Color::class, 'color', 'WITH', 'color.colorId = motorbikes.color')
                    ->leftJoin(Cc::class, 'cc', 'WITH', 'cc.ccId = motorbikes.cc');
                    
        if(!empty($filters)){
            $qb = $this->addFilters($qb, $filters);
        }
        
        if(!empty($orders)){
            $qb = $this->addOrders($qb, $orders);
        } else {
            $qb->orderBy('motorbikes.motorbikesId', 'DESC');
        }
                    
        if($limit != 0)
            $qb->setFirstResult($last)
                ->setMaxResults($limit);
        
        return $qb->getQuery()->getResult();
        
    }
    
    private function addFilters($qb, $filters)
    {
        if(!empty($filters)) {
            if( isset($filters['id']) && !empty($filters['id']) ) {
                $motorbikesId = intval($filters['id']);
                $qb->where("motorbikes.motorbikesId = :id")
                ->setParameter('id', $motorbikesId);  
                return $qb;
            }
            
            if( isset($filters['model']) && !empty($filters['model']) ) {
                $model = intval($filters['model']);
                $qb->andWhere('motorbikes.model = :model')
                ->setParameter('model', $model);
            } 
            
            if( isset($filters['color']) && !empty($filters['color']) ) {
                $color = intval($filters['color']);
                $qb->andWhere('motorbikes.color = :color')
                ->setParameter('color', $color);
            }
            
            if( isset($filters['cc']) && !empty($filters['cc']) ) {
                $cc = intval($filters['cc']);
                $qb->andWhere('motorbikes.cc = :cc')
                ->setParameter('cc', $cc);
            }
            
        }
        return $qb;
    }
    
    private function addOrders($qb, $orders)
    {
        if(!empty($orders) && isset($orders['field']) && !empty($orders['field']) ) {
            
            $orderType = ($orders['type'] == true) ? 'DESC' : 'ASC';
            switch ($orders['field']) {
                case 'id':
                    $qb->orderBy('motorbikes.motorbikesId', $orderType); 
                    break;
                case 'model':
                    $qb->orderBy('model.title', $orderType); 
                    break;
                case 'color':
                    $qb->orderBy('color.title', $orderType);
                    break;
                case 'cc':
                    $qb->orderBy('cc.title', $orderType);
                    break;
                case 'weight':
                    $qb->orderBy('motorbikes.weight', $orderType);
                    break;
                case 'price':
                    $qb->orderBy('motorbikes.price', $orderType);
                    break;
                case 'addedTime':
                    $qb->orderBy('motorbikes.addedTime', $orderType);
                    break;
                default:
                    $qb->orderBy('motorbikes.motorbikesId', $orderType); 
                    break;
            }
        }
        return $qb;
    }
    
}
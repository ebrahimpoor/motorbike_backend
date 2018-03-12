<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motorbikes
 *
 * @ORM\Table(name="motorbikes")
 * @ORM\Entity(repositoryClass="\Application\Model\Repository\MotorbikesRepository")
 */
class Motorbikes
{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="motorbikes_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $motorbikesId;

    /**
     * @var \Application\Entity\Model
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Model")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="model_id", referencedColumnName="model_id")
     * })
     */
    private $model;
    
    /**
     * @var \Application\Entity\Cc
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Cc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cc_id", referencedColumnName="cc_id")
     * })
     */
    private $cc;
    
    /**
     * @var \Application\Entity\Color
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Color")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="color_id", referencedColumnName="color_id")
     * })
     */
    private $color;    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer", nullable=false)
     */
    private $weight = '0';
    
    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_time", type="datetime", nullable=true)
     */
    private $addedTime;
    
    /**
     * @var \Application\Entity\UploadedFile
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\UploadedFile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_file_id", referencedColumnName="uploaded_file_id")
     * })
     */
    private $imageFile;

    /**
     * Get motorbikesId
     *
     * @return integer
     */
    public function getMotorbikesId()
    {
        return $this->motorbikesId;
    }
    
    /**
     * Set model
     *
     * @param \Application\Entity\Model $model
     *
     * @return Motorbikes
     */
    public function setModel(\Application\Entity\Model $model = null)
    {
        $this->model = $model;
    
        return $this;
    }
    
    /**
     * Get model
     *
     * @return \Application\Entity\Model
     */
    public function getModel()
    {
        return $this->model;
    }
    
    /**
     * Set cc
     *
     * @param \Application\Entity\Cc $cc
     *
     * @return Motorbikes
     */
    public function setCc(\Application\Entity\Cc $cc = null)
    {
        $this->cc = $cc;
    
        return $this;
    }
    
    /**
     * Get cc
     *
     * @return \Application\Entity\Cc
     */
    public function getCc()
    {
        return $this->cc;
    }
    
    /**
     * Set color
     *
     * @param \Application\Entity\Color $color
     *
     * @return Motorbikes
     */
    public function setColor(\Application\Entity\Color $color = null)
    {
        $this->color = $color;
    
        return $this;
    }
    
    /**
     * Get color
     *
     * @return \Application\Entity\Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Motorbikes
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }
    
    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Motorbikes
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }
    
    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Set addedTime
     *
     * @param \DateTime $addedTime
     *
     * @return User
     */
    public function setAddedTime($addedTime)
    {
        $this->addedTime = $addedTime;
    
        return $this;
    }
    
    /**
     * Get addedTime
     *
     * @return \DateTime
     */
    public function getAddedTime()
    {
        return $this->addedTime;
    }
    
    /**
     * Set imageFile
     *
     * @param \Application\Entity\UploadedFile $imageFile
     *
     * @return Motorbikes
     */
    public function setImageFile(\Application\Entity\UploadedFile $imageFile = null)
    {
        $this->imageFile = $imageFile;
    
        return $this;
    }
    
    /**
     * Get imageFile
     *
     * @return \Application\Entity\UploadedFile
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

}

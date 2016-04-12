<?php

namespace Web\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Counter
 *
 * @ORM\Table(name="counter")
 * @ORM\Entity(repositoryClass="Web\AdminBundle\Repository\CounterRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Counter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="number_digits", type="integer")
     */
    private $numberDigits;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created
     * @ORM\PrePersist 
     * @param \DateTime $created
     * @return Counter
     */
    public function setCreated($created)
    {
   
   
        $this->created = new \DateTime();  
        $this->updated = new \DateTime(); 
    }
    
    
    
  /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     * @ORM\PreUpdate 
     * @param \DateTime $updated
     * @return Counter
     */
    public function setUpdated($updated)
    {
      
 $this->updated = new \DateTime();  

        return $this;
    }
    
    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Counter
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set numberDigits
     *
     * @param integer $numberDigits
     * @return Counter
     */
    public function setNumberDigits($numberDigits)
    {
        $this->numberDigits = $numberDigits;

        return $this;
    }

    /**
     * Get numberDigits
     *
     * @return integer 
     */
    public function getNumberDigits()
    {
        return $this->numberDigits;
    }
}

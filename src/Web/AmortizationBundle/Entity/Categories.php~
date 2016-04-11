<?php

namespace Web\AmortizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="Web\AmortizationBundle\Repository\CategoriesRepository")
 */
class Categories
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
     * @var int
     *
     * @ORM\Column(name="sab_number", type="integer")
     */
    private $sabNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=32)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="useful_time", type="datetime")
     */
    private $usefulTime;


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
     * Set sabNumber
     *
     * @param integer $sabNumber
     * @return Categories
     */
    public function setSabNumber($sabNumber)
    {
        $this->sabNumber = $sabNumber;

        return $this;
    }

    /**
     * Get sabNumber
     *
     * @return integer 
     */
    public function getSabNumber()
    {
        return $this->sabNumber;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Categories
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set usefulTime
     *
     * @param \DateTime $usefulTime
     * @return Categories
     */
    public function setUsefulTime($usefulTime)
    {
        $this->usefulTime = $usefulTime;

        return $this;
    }

    /**
     * Get usefulTime
     *
     * @return \DateTime 
     */
    public function getUsefulTime()
    {
        return $this->usefulTime;
    }
}

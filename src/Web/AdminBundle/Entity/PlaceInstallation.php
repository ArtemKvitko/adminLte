<?php

namespace Web\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlaceInstallation
 *
 * @ORM\Table(name="place_installation")
 * @ORM\Entity(repositoryClass="Web\AdminBundle\Repository\PlaceInstallationRepository")
 */
class PlaceInstallation
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
     * @ORM\ManyToOne(targetEntity="Counter")
     * @ORM\JoinColumn(name="counter_id", referencedColumnName="id")
     */
    private $counter;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


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
     * Set title
     *
     * @param string $title
     * @return PlaceInstallation
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
     * Set counter
     *
     * @param \Web\AdminBundle\Entity\Counter $counter
     * @return PlaceInstallation
     */
    public function setCounter(\Web\AdminBundle\Entity\Counter $counter = null)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Get counter
     *
     * @return \Web\AdminBundle\Entity\Counter 
     */
    public function getCounter()
    {
        return $this->counter;
    }
}

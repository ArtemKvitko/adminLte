<?php

namespace Web\AssetsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Assets
 *
 * @ORM\Table(name="assets")
 * @ORM\Entity(repositoryClass="Web\AssetsBundle\Repository\AssetsRepository")
 */
class Assets
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
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="title", type="string", length=32)
     */
    private $title;
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="inventaryNumber", type="string", length=32)
     */
    private $inventaryNumber;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(name="initialcost", type="decimal", precision=10, scale=2)
     */
    private $initialcost;

    /**
     * @var string
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(name="replacementcost", type="decimal", precision=10, scale=2)
     */
    private $replacementcost;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Web\CitiesBundle\Entity\Cities")
     * @ORM\JoinColumn(name="city", referencedColumnName="id")
     */
    private $city;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Web\AmortizationBundle\Entity\Categories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


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
     * Set name
     *
     * @param string $name
     * @return Assets
     */
    /*
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    */
    /**
     * Get name
     *
     * @return string 
     */
    /*
    public function getName()
    {
        return $this->name;
    }
    */
    /**
     * Set initialcost
     *
     * @param string $initialcost
     * @return Assets
     */
    public function setInitialcost($initialcost)
    {
        $this->initialcost = $initialcost;

        return $this;
    }

    /**
     * Get initialcost
     *
     * @return string 
     */
    public function getInitialcost()
    {
        return $this->initialcost;
    }

    /**
     * Set replacementcost
     *
     * @param string $replacementcost
     * @return Assets
     */
    public function setReplacementcost($replacementcost)
    {
        $this->replacementcost = $replacementcost;

        return $this;
    }

    /**
     * Get replacementcost
     *
     * @return string 
     */
    public function getReplacementcost()
    {
        return $this->replacementcost;
    }

    /**
     * Set location
     *
     * @param integer $location
     * @return Assets
     */
    /*
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }*/

    /**
     * Get location
     *
     * @return integer 
     */
    /*
    public function getLocation()
    {
        return $this->location;
    }*/

    /**
     * Set title
     *
     * @param string $title
     * @return Assets
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
     * Set inventaryNumber
     *
     * @param string $inventaryNumber
     * @return Assets
     */
    public function setInventaryNumber($inventaryNumber)
    {
        $this->inventaryNumber = $inventaryNumber;

        return $this;
    }

    /**
     * Get inventaryNumber
     *
     * @return string 
     */
    public function getInventaryNumber()
    {
        return $this->inventaryNumber;
    }

    /**
     * Set city
     *
     * @param \Web\CitiesBundle\Entity\Cities $city
     * @return Assets
     */
    public function setCity(\Web\CitiesBundle\Entity\Cities $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Web\CitiesBundle\Entity\Cities 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set category
     *
     * @param \Web\AmortizationBundle\Entity\Categories $category
     * @return Assets
     */
    public function setCategory(\Web\AmortizationBundle\Entity\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Web\AmortizationBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    public function __toString() {
        return $this->getTitle();
    }
}

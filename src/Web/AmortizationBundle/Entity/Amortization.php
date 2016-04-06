<?php

namespace Web\AmortizationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amortization
 *
 * @ORM\Table(name="amortization")
 * @ORM\Entity(repositoryClass="Web\AmortizationBundle\Repository\AmortizationRepository")
 */
class Amortization
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
     * @ORM\Column(name="period", type="date")
     */
    private $period;

    /**
     * @var int
     *
     * @ORM\Column(name="aset_id", type="integer")
     */
    private $asetId;

    /**
     * @var string
     *
     * @ORM\Column(name="amortization", type="decimal", precision=10, scale=2)
     */
    private $amortization;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime")
     */
    private $createTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_time", type="datetime")
     */
    private $updateTime;


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
     * Set period
     *
     * @param \DateTime $period
     * @return Amortization
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return \DateTime 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set asetId
     *
     * @param integer $asetId
     * @return Amortization
     */
    public function setAsetId($asetId)
    {
        $this->asetId = $asetId;

        return $this;
    }

    /**
     * Get asetId
     *
     * @return integer 
     */
    public function getAsetId()
    {
        return $this->asetId;
    }

    /**
     * Set amortization
     *
     * @param string $amortization
     * @return Amortization
     */
    public function setAmortization($amortization)
    {
        $this->amortization = $amortization;

        return $this;
    }

    /**
     * Get amortization
     *
     * @return string 
     */
    public function getAmortization()
    {
        return $this->amortization;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     * @return Amortization
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime 
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * Set updateTime
     *
     * @param \DateTime $updateTime
     * @return Amortization
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * Get updateTime
     *
     * @return \DateTime 
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }
}

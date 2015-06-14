<?php

namespace riki34\SimpleCacheBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CacheInvalidator
 *
 * @ORM\Table(name="sc_cache_invalidator")
 * @ORM\Entity
 */
class CacheInvalidator
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="entity", type="string", length=255)
     */
    private $entity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUpdate", type="datetime")
     */
    private $lastUpdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="lifetime", type="integer", nullable=true, options={"default" = null})
     */
    private $lifetime;

    public function __construct() {
        $this->lastUpdate = new \DateTime();
    }

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
     * Set entity
     *
     * @param string $entity
     * @return CacheInvalidator
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return string 
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return CacheInvalidator
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set lifetime
     *
     * @param integer $lifetime
     * @return CacheInvalidator
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = $lifetime;

        return $this;
    }

    /**
     * Get lifetime
     *
     * @return integer 
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }
}

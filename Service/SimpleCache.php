<?php

namespace riki34\SimpleCacheBundle\Services;

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use riki34\SimpleCacheBundle\Entity\CacheInvalidator;
use Symfony\Component\HttpFoundation\Response;

class SimpleCache {
    /** @var string $cacheDir */
    private $cacheDir;
    /** @var EntityManager $em */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->$cacheDir = __DIR__ . '/../../../../var/SimpleCache';
        $this->em = $em;
    }

    /**
     * @param string $entity
     * @param string $id
     * @param mixed $data
     */
    public function cacheData($entity, $id, $data) {
        $cacheDriver = new FilesystemCache($this->cacheDir . $entity);
        $cacheDriver->save($id, $data);
    }

    /**
     * @param string $entity
     * @param string $id
     * @return bool|mixed|string
     */
    public function getData($entity, $id) {
        $cacheDriver = new FilesystemCache($this->cacheDir . $entity);
        return $cacheDriver->fetch($id);
    }

    /**
     * @param string $entity
     * @return CacheInvalidator
     */
    public function getInvalidator($entity) {
        return $this->em->getRepository('riki34SimpleCacheBundle:CacheInvalidator')
            ->findOneBy(array('entity' => $entity));
    }

    /**
     * @param string $entity
     * @param null|integer $lifetime
     * @return null|CacheInvalidator
     */
    public function addInvalidator($entity, $lifetime = null) {
        try {
            $invalidator = new CacheInvalidator();
            $invalidator->setEntity($entity);
            $invalidator->setLifetime($lifetime);
            $this->em->persist($invalidator);
            $this->em->flush();
            return $invalidator;
        } catch (\Exception $ex){
            return null;
        }
    }

    /**
     * @param string $entity
     * @param null|integer $lifetime
     * @return null|Response
     */
    public function cachePage($entity, $lifetime = null) {
        $invalidator = $this->getInvalidator($entity);
        if (!$invalidator) {
            $invalidator = $this->addInvalidator($entity, $lifetime);
        }
        $response = new Response();
        $response->setPrivate();
        $response->setEtag(md5($invalidator->getLastUpdate()->format('Y-m-d H:i:s')));
        $response->setMaxAge(10000);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

    public function getName() {
        return 'simple_cache';
    }
}
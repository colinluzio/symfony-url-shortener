<?php
namespace AppBundle\Service;

use AppBundle\Entity\Url;
use AppBundle\Utility\Shorten;
use Doctrine\ORM\EntityManager;

class UrlService
{
    private $em;

    public function __construct(EntityManager $entity_manager)
    {
        $this->em = $entity_manager;
    }

    public function generateUrl(Url $url)
    {
        if(empty($url)) return;
        $shortUrl = $this->em->getRepository('AppBundle:Url')
                ->findOneByUrl($url->getUrl());
        //If already exists, return previosuly generated url
        if(!empty($shortUrl)){
            return $shortUrl->getShortened();
        } else {
            $totalUrls = $this->em->getRepository('AppBundle:Url')
                            ->findAll($url->getUrl());
            $shortUrl = Shorten::hash(count($totalUrls));
            $url->setShortened($shortUrl);
            $this->em->persist($url);
            $this->em->flush();

            return $shortUrl;
        }
    }

    public function getUrl($slug)
    {
        if(empty($slug)) return;
        $shortUrl = $this->em->getRepository('AppBundle:Url')
                ->findOneByShortened($slug);
        if(!empty($shortUrl)) {
            return $shortUrl->getUrl();
        }

        return;
    }
}

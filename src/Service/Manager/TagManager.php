<?php
namespace App\Service\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Redis;
use Doctrine\ORM\EntityManager;
use App\Entity\ProductTag;
use App\Entity\ProductTagItem;

class TagManager extends AbstractController
{
    private $redis;

    public function __construct(
        Redis $redis,
        EntityManager $em
    ) {
        $this->em = $em;
        $this->redis = $redis;
    }

    public function getFilters()
    {
        $method = 'get' . $this->getEntityType() . 'Filters';
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        return [];
    }

    public function getCatalogFilters()
    {
        $allTags = $this->em
            ->getRepository(ProductTag::class)
            ->findAll();

        $tags = [];
        $productTags = [];

        foreach($this->getEntity()->getProducts() as $product) {
            foreach($product->getProducttagitem() as $productTag) {
                $tagId = $productTag->getId();
                if(isset($productTags[$tagId])) {
                    $productTags[$tagId] += 1;
                } else {
                    $productTags[$tagId] = 1;
                }
            }
        }
        foreach($allTags as $allTag) {
            $tag = [
                'name' => $allTag->getName(),
                'id' => $allTag->getId()
            ];
            $tagChildrens = [];
            foreach($allTag->getProductTagItems() as $productTagItem) {
                $count = 0;
                if(isset($productTags[$productTagItem->getId()])) {
                    $count = $productTags[$productTagItem->getId()];
                }
                $tagChildrens[] = [
                    'name' => $productTagItem->getName(),
                    'id' => $productTagItem->getId(),
                    'count' => $count
                ];
            }
            $tag['childrens'] = $tagChildrens;
            $tags[] = $tag;
        }
        return $tags;
    }

    public function getProductFilters()
    {
        $productTags = [];
        foreach($this->getEntity()->getProducttagitem() as $productTag) {
            $productTags[] = $productTag->getId();
        }

        $tagsItems = $this->em->getRepository(ProductTagItem::class)
            ->findBy( ['id' => $productTags], ['id' => 'DESC'] );

        $tags = [];
        foreach($tagsItems as $tag) {
            if($tag->getName()) {
                $tags[] = [
                    'name' => $tag->getEntityId()->getName(),
                    'value' => $tag->getName()
                ];
            }
        }
        
        return $tags;
    }
}
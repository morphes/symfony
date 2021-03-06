<?php
namespace App\Service;

class AdminTagService extends TagService
{
    private $tags = [];

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    public function parseRequest($request)
    {
        $result = [];
        foreach($request as $key => $value) {
            if(strpos($key, 'tag_') !== false) {
                $tagKey = str_replace('tag_', '', $key);
                if (is_array($value) && count($value) && $value[0]) {
                    $result[$tagKey] = implode(',', $value);
                } elseif ($value) {
                    $result[$tagKey] = $value;
                }
            }
        }
        return $result;
    }

    public function update()
    {
        $method = 'update' . $this->getEntityType();
        return $this->$method();
    }

    public function updateProduct()
    {
        $manager = $this->getDoctrine()->getManager();

        foreach($this->getEntity()->getProducttagitem() as $productTagItem) {
            $this->getEntity()->removeProducttagitem($productTagItem);
        }

        foreach($this->getTags() as $tagId => $tagValue) {
            $tagValues = explode(',', $tagValue);
            foreach($tagValues as $tagValue) {
                $productTagItem = $this->em->getRepository('App:ProductTagItem')->find($tagValue);
                $this->getEntity()->addProducttagitem($productTagItem);
                $manager->persist($this->getEntity());
                $manager->flush();
            }
        }
    }

    public function updateCatalog()
    {
        $manager = $this->getDoctrine()->getManager();

        foreach($this->getEntity()->getProductTagItems() as $productTagItem) {
            $this->getEntity()->removeProductTagItem($productTagItem);
        }

        foreach($this->getTags() as $tagId => $tagValue) {
            $productTagItem = $this->em->getRepository('App:ProductTagItem')->find($tagValue);
            $this->getEntity()->addProductTagItem($productTagItem);
            $manager->persist($this->getEntity());
            $manager->flush();
        }

    }
}
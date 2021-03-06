<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $visible;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Catalog", inversedBy="products")
     */
    private $catalogs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductUrl", mappedBy="entity")
     */
    private $productUrls;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductItem", mappedBy="entity")
     */
    private $productItems;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProductTag", mappedBy="entity_id")
     */
    private $productTags;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProductTagItem", inversedBy="products")
     */
    private $producttagitem;

    private $tagsArray;
    private $allTagsArray;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sale", mappedBy="products")
     */
    private $sales;

    public function __construct()
    {
        $this->catalog = new ArrayCollection();
        $this->catalogs = new ArrayCollection();
        $this->productUrls = new ArrayCollection();
        $this->productItems = new ArrayCollection();
        $this->productTags = new ArrayCollection();
        $this->producttagitem = new ArrayCollection();
        $this->sales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(?bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Catalog[]
     */
    public function getCatalogs(): Collection
    {
        return $this->catalogs;
    }

    public function addCatalog(Catalog $catalog): self
    {
        if (!$this->catalogs->contains($catalog)) {
            $this->catalogs[] = $catalog;
        }

        return $this;
    }

    public function removeCatalog(Catalog $catalog): self
    {
        if ($this->catalogs->contains($catalog)) {
            $this->catalogs->removeElement($catalog);
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

    /**
     * @return Collection|ProductUrl[]
     */
    public function getProductUrls(): Collection
    {
        return $this->productUrls;
    }

    public function addProductUrl(ProductUrl $productUrl): self
    {
        if (!$this->productUrls->contains($productUrl)) {
            $this->productUrls[] = $productUrl;
            $productUrl->setEntity($this);
        }

        return $this;
    }

    public function removeProductUrl(ProductUrl $productUrl): self
    {
        if ($this->productUrls->contains($productUrl)) {
            $this->productUrls->removeElement($productUrl);
            // set the owning side to null (unless already changed)
            if ($productUrl->getEntity() === $this) {
                $productUrl->setEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductItem[]
     */
    public function getProductItems(): Collection
    {
        return $this->productItems;
    }

    public function addProductItem(ProductItem $productItem): self
    {
        if (!$this->productItems->contains($productItem)) {
            $this->productItems[] = $productItem;
            $productItem->setEntity($this);
        }

        return $this;
    }

    public function removeProductItem(ProductItem $productItem): self
    {
        if ($this->productItems->contains($productItem)) {
            $this->productItems->removeElement($productItem);
            // set the owning side to null (unless already changed)
            if ($productItem->getEntity() === $this) {
                $productItem->setEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductTag[]
     */
    public function getProductTags(): Collection
    {
        return $this->productTags;
    }

    public function addProductTag(ProductTag $productTag): self
    {
        if (!$this->productTags->contains($productTag)) {
            $this->productTags[] = $productTag;
            $productTag->addEntityId($this);
        }

        return $this;
    }

    public function removeProductTag(ProductTag $productTag): self
    {
        if ($this->productTags->contains($productTag)) {
            $this->productTags->removeElement($productTag);
            $productTag->removeEntityId($this);
        }

        return $this;
    }

    /**
     * @return Collection|ProductTagItem[]
     */
    public function getProducttagitem(): Collection
    {
        return $this->producttagitem;
    }

    public function addProducttagitem(ProductTagItem $producttagitem): self
    {
        if (!$this->producttagitem->contains($producttagitem)) {
            $this->producttagitem[] = $producttagitem;
        }

        return $this;
    }

    public function removeProducttagitem(ProductTagItem $producttagitem): self
    {
        if ($this->producttagitem->contains($producttagitem)) {
            $this->producttagitem->removeElement($producttagitem);
        }

        return $this;
    }

    public function setTagsArray(array $tags)
    {
        $this->tagsArray = $tags;
    }

    public function getTagsArray()
    {
        return $this->tagsArray;
    }

    public function setAllTagsArray(array $tags)
    {
        $this->allTagsArray = $tags;
    }

    public function getAllTagsArray()
    {
        return $this->allTagsArray;
    }

    /**
     * @return Collection|Sale[]
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addSale(Sale $sale): self
    {
        if (!$this->sales->contains($sale)) {
            $this->sales[] = $sale;
            $sale->addProduct($this);
        }

        return $this;
    }

    public function removeSale(Sale $sale): self
    {
        if ($this->sales->contains($sale)) {
            $this->sales->removeElement($sale);
            $sale->removeProduct($this);
        }

        return $this;
    }
}

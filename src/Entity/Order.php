<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderedDish", mappedBy="order_id")
     */
    private $orderedDishes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Feed", inversedBy="orders")
     */
    private $feed;

    public function __construct()
    {
        $this->orderedDishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|OrderedDish[]
     */
    public function getOrderedDishes(): Collection
    {
        return $this->orderedDishes;
    }

    public function addOrderedDish(OrderedDish $orderedDish): self
    {
        if (!$this->orderedDishes->contains($orderedDish)) {
            $this->orderedDishes[] = $orderedDish;
            $orderedDish->setOrderId($this);
        }

        return $this;
    }

    public function removeOrderedDish(OrderedDish $orderedDish): self
    {
        if ($this->orderedDishes->contains($orderedDish)) {
            $this->orderedDishes->removeElement($orderedDish);
            // set the owning side to null (unless already changed)
            if ($orderedDish->getOrderId() === $this) {
                $orderedDish->setOrderId(null);
            }
        }

        return $this;
    }

    public function getFeed(): ?Feed
    {
        return $this->feed;
    }

    public function setFeed(?Feed $feed): self
    {
        $this->feed = $feed;

        return $this;
    }
}

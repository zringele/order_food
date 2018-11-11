<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderedDishRepository")
 */
class OrderedDish
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="orderedDishes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $order_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dish", inversedBy="orderedDishes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $dish;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SelectedSide", mappedBy="ordered_dish")
     */
    private $selectedSides;

    public function __construct()
    {
        $this->selectedSides = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?order
    {
        return $this->order_id;
    }

    public function setOrderId(?order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getDish(): ?dish
    {
        return $this->dish;
    }

    public function setDish(?dish $dish): self
    {
        $this->dish = $dish;

        return $this;
    }

    /**
     * @return Collection|SelectedSide[]
     */
    public function getSelectedSides(): Collection
    {
        return $this->selectedSides;
    }

    public function addSelectedSide(SelectedSide $selectedSide): self
    {
        if (!$this->selectedSides->contains($selectedSide)) {
            $this->selectedSides[] = $selectedSide;
            $selectedSide->setOrderedDish($this);
        }

        return $this;
    }

    public function removeSelectedSide(SelectedSide $selectedSide): self
    {
        if ($this->selectedSides->contains($selectedSide)) {
            $this->selectedSides->removeElement($selectedSide);
            // set the owning side to null (unless already changed)
            if ($selectedSide->getOrderedDish() === $this) {
                $selectedSide->setOrderedDish(null);
            }
        }

        return $this;
    }
}

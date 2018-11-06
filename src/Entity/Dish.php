<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DishRepository")
 */
class Dish
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Meal", inversedBy="dishes")
     */
    private $meal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DishHasSide", mappedBy="relation")
     */
    private $dishHasSides;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderedDish", mappedBy="dish")
     */
    private $orderedDishes;

    public function __construct()
    {
        $this->dishHasSides = new ArrayCollection();
        $this->orderedDishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getMeal(): ?meal
    {
        return $this->meal;
    }

    public function setMeal(?meal $meal): self
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * @return Collection|DishHasSide[]
     */
    public function getDishHasSides(): Collection
    {
        return $this->dishHasSides;
    }

    public function addDishHasSide(DishHasSide $dishHasSide): self
    {
        if (!$this->dishHasSides->contains($dishHasSide)) {
            $this->dishHasSides[] = $dishHasSide;
            $dishHasSide->setRelation($this);
        }

        return $this;
    }

    public function removeDishHasSide(DishHasSide $dishHasSide): self
    {
        if ($this->dishHasSides->contains($dishHasSide)) {
            $this->dishHasSides->removeElement($dishHasSide);
            // set the owning side to null (unless already changed)
            if ($dishHasSide->getRelation() === $this) {
                $dishHasSide->setRelation(null);
            }
        }

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
            $orderedDish->setDish($this);
        }

        return $this;
    }

    public function removeOrderedDish(OrderedDish $orderedDish): self
    {
        if ($this->orderedDishes->contains($orderedDish)) {
            $this->orderedDishes->removeElement($orderedDish);
            // set the owning side to null (unless already changed)
            if ($orderedDish->getDish() === $this) {
                $orderedDish->setDish(null);
            }
        }

        return $this;
    }
}

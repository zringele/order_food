<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MealRepository")
 */
class Meal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="meals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dish", mappedBy="meal")
     */
    private $dishes;

    public function __construct()
    {
        $this->dishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMenu(): ?menu
    {
        return $this->menu;
    }

    public function setMenu(?menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * @return Collection|Dish[]
     */
    public function getDishes(): Collection
    {
        return $this->dishes;
    }

    public function addDish(Dish $dish): self
    {
        if (!$this->dishes->contains($dish)) {
            $this->dishes[] = $dish;
            $dish->setMeal($this);
        }

        return $this;
    }

    public function removeDish(Dish $dish): self
    {
        if ($this->dishes->contains($dish)) {
            $this->dishes->removeElement($dish);
            // set the owning side to null (unless already changed)
            if ($dish->getMeal() === $this) {
                $dish->setMeal(null);
            }
        }

        return $this;
    }
}

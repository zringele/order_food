<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
    private $day;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Feed", inversedBy="menus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $feed;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Meal", mappedBy="menu")
     */
    private $meals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SideDish", mappedBy="menu")
     */
    private $sideDishes;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
        $this->sideDishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFeed(): ?feed
    {
        return $this->feed;
    }

    public function setFeed(?feed $feed): self
    {
        $this->feed = $feed;

        return $this;
    }

    /**
     * @return Collection|Meal[]
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meal $meal): self
    {
        if (!$this->meals->contains($meal)) {
            $this->meals[] = $meal;
            $meal->setMenu($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meals->contains($meal)) {
            $this->meals->removeElement($meal);
            // set the owning side to null (unless already changed)
            if ($meal->getMenu() === $this) {
                $meal->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SideDish[]
     */
    public function getSideDishes(): Collection
    {
        return $this->sideDishes;
    }

    public function addSideDish(SideDish $sideDish): self
    {
        if (!$this->sideDishes->contains($sideDish)) {
            $this->sideDishes[] = $sideDish;
            $sideDish->setMenu($this);
        }

        return $this;
    }

    public function removeSideDish(SideDish $sideDish): self
    {
        if ($this->sideDishes->contains($sideDish)) {
            $this->sideDishes->removeElement($sideDish);
            // set the owning side to null (unless already changed)
            if ($sideDish->getMenu() === $this) {
                $sideDish->setMenu(null);
            }
        }

        return $this;
    }
}

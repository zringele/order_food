<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SelectedSideRepository")
 */
class SelectedSide
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SideDish", inversedBy="selectedSides")
     * @ORM\JoinColumn(nullable=false)
     */
    private $side_dish;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrderedDish", inversedBy="selectedSides")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordered_dish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSideDish(): ?SideDish
    {
        return $this->side_dish;
    }

    public function setSideDish(?SideDish $side_dish): self
    {
        $this->side_dish = $side_dish;

        return $this;
    }

    public function getOrderedDish(): ?OrderedDish
    {
        return $this->ordered_dish;
    }

    public function setOrderedDish(?OrderedDish $ordered_dish): self
    {
        $this->ordered_dish = $ordered_dish;

        return $this;
    }
}

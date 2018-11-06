<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SideDishRepository")
 */
class SideDish
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
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu", inversedBy="sideDishes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SelectedSide", mappedBy="side_dish")
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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
            $selectedSide->setSideDish($this);
        }

        return $this;
    }

    public function removeSelectedSide(SelectedSide $selectedSide): self
    {
        if ($this->selectedSides->contains($selectedSide)) {
            $this->selectedSides->removeElement($selectedSide);
            // set the owning side to null (unless already changed)
            if ($selectedSide->getSideDish() === $this) {
                $selectedSide->setSideDish(null);
            }
        }

        return $this;
    }
}

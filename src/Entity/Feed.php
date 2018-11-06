<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedRepository")
 */
class Feed
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_from;

    /**
     * @ORM\Column(type="date")
     */
    private $date_to;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Menu", mappedBy="feed")
     */
    private $menus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="feed")
     */
    private $orders;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->date_from;
    }

    public function setDateFrom(\DateTimeInterface $date_from): self
    {
        $this->date_from = $date_from;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->date_to;
    }

    public function setDateTo(\DateTimeInterface $date_to): self
    {
        $this->date_to = $date_to;

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setFeed($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getFeed() === $this) {
                $menu->setFeed(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setFeed($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getFeed() === $this) {
                $order->setFeed(null);
            }
        }

        return $this;
    }
}

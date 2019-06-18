<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
class PropertySearch
{

    /**
     * @var int|null
     * @Assert\Range(min=50, max=400)
     */
    private $minSurface;

    /**
     * @var int|null
     */
    private $maxPrice;


    /**
     * @var ArrayCollection
     */
    private $options;

    /**
     * PropertySearch constructor.
     * @param $options
     */

    /**
     * @var float|null
     */
    private $lat;

    /**
     * @var float|null
     */
    private $lng;


    /**
     * @var integer|null
     */
    private $distance;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int|null $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface): PropertySearch
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options): void
    {
        $this->options = $options;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     * @return PropertySearch
     */
    public function setLat(?float $lat): PropertySearch
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float|null $lng
     * @return PropertySearch
     */
    public function setLng(?float $lng): PropertySearch
    {
        $this->lng = $lng;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     * @return PropertySearch
     */
    public function setDistance(?int $distance): PropertySearch
    {
        $this->distance = $distance;
        return $this;
    }







}
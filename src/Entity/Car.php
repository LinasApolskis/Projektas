<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $licencenumber;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $model;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $fuel;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $engine;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $power;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $gearbox;

    /**
     * @ORM\Column(type="integer", length=25)
     */
    private $mileage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visit", mappedBy="car_id", orphanRemoval=true)
     */
    private $visits;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private $serviced;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Service", inversedBy="cars")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="cars")
     */
    private $user;

    public function __construct()
    {
        $this->visits = new ArrayCollection();
        $this->services = new ArrayCollection();
    }
    public function getID()
    {
        return $this->id;
    }
    public function getLicence()
    {
        return $this->licencenumber;
    }
    public function setLicence($licencenumber)
    {
        $this->licencenumber = $licencenumber;
    }
    public function getBrand()
    {
        return $this->brand;
    }
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function setModel($model)
    {
        $this->model = $model;
    }
    public function getYear()
    {
        return $this->year;
    }
    public function setYear($year)
    {
        $this->year = $year;
    }
    public function getBody()
    {
        return $this->body;
    }
    public function setBody($body)
    {
        $this->body = $body;
    }
    public function getFuel()
    {
        return $this->fuel;
    }
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;
    }
    public function getEngine()
    {
        return $this->engine;
    }
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }
    public function getMileage()
    {
        return $this->mileage;
    }
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
    }
    public function getPower()
    {
        return $this->power;
    }
    public function setPower($power)
    {
        $this->power = $power;
    }
    public function getGearbox()
    {
        return $this->gearbox;
    }
    public function setGearbox($gearbox)
    {
        $this->gearbox = $gearbox;
    }

    /**
     * @return Collection|Visit[]
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(Visit $visit): self
    {
        if (!$this->visits->contains($visit)) {
            $this->visits[] = $visit;
            $visit->setCarId($this);
        }

        return $this;
    }

    public function removeVisit(Visit $visit): self
    {
        if ($this->visits->contains($visit)) {
            $this->visits->removeElement($visit);
            // set the owning side to null (unless already changed)
            if ($visit->getCarId() === $this) {
                $visit->setCarId(null);
            }
        }

        return $this;
    }

    public function getServiced(): ?bool
    {
        return $this->serviced;
    }

    public function setServiced(): self
    {
        $this->serviced = true;

        return $this;
    }
    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    // add your own fields
}

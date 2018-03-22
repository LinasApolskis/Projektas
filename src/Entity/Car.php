<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=25)
     */
    private $username;

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

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
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
    // add your own fields
}

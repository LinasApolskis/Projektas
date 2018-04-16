<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileRepository")
 */
class UserProfile
{
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @ORM\Id
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=25)
     */

    private $city;
    /**
     * @ORM\Column(type="string", length=25)
     */

    private $address;
    /**
     * @ORM\Column(type="string", length=25)
     */

    private $phone;
    /**
     * @ORM\Column(type="string", length=25)
     */

    private $name;
    /**
     * @ORM\Column(type="string", length=25)
     */

    private $surname;
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function setCity($city)
    {
        $this->city = $city;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    // add your own fields
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileRepository")
 */
class UserProfile
{
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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="Profile", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @ORM\Id
     */
    private $user_id;
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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
    // add your own fields
}

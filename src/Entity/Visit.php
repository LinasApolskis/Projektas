<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisitRepository")
 */
class Visit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Car", inversedBy="visits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="visits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->username = $date;
    }

    public function getCarId(): ?Car
    {
        return $this->car_id;
    }

    public function setCarId(?Car $car_id): self
    {
        $this->car_id = $car_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

}

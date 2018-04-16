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
     * @ORM\Column(type="string", length=25)
     */
    private $username;
    /**
     * @ORM\Column(type="string", length=25)
     */
    private $licencenumber;
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

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
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->username = $date;
    }
    // add your own fields
}

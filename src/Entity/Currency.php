<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
 */
class Currency
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $alphaCode;

    /**
     * @ORM\Column(type="integer")
     */
    private $numericCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $inverseRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAlphaCode(): ?string
    {
        return $this->alphaCode;
    }

    public function setAlphaCode(string $alphaCode): self
    {
        $this->alphaCode = $alphaCode;

        return $this;
    }

    public function getNumericCode(): ?int
    {
        return $this->numericCode;
    }

    public function setNumericCode(int $numericCode): self
    {
        $this->numericCode = $numericCode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getInverseRate(): ?float
    {
        return $this->inverseRate;
    }

    public function setInverseRate(float $inverseRate): self
    {
        $this->inverseRate = $inverseRate;

        return $this;
    }
}

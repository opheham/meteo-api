<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Donnée météo enregistrée depuis un capteur.
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\WeatherDataRepository")
 * @ORM\HasLifecycleCallbacks
 */
class WeatherData
{
    /**
     * L'ID de la donnée météo
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(
     *      type="integer",
     *      options={
     *          "comment": "L'ID de la donnée météo"
     *      }
     * )
     */
    private $id;

    /**
     * La valeur de la donnée météo
     * @ORM\Column(
     *      type="float",
     *      options={
     *          "comment": "La valeur de la donnée météo"
     *      }
     * )
     */
    private $value;

    /**
     * La date d'obtention de la donnée météo
     * @ORM\Column(type="datetime",
     *      options={
     *          "comment": "La date d'obtention de la donnée météo"
     *      }
     * )
     */
    private $createdAt;

    /**
     * Le capteur ayant permis l'obtention de la donnée météo
     * @ORM\ManyToOne(targetEntity="App\Entity\Sensor", inversedBy="weatherData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sensor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \Datetime();

        return $this;
    }

    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    public function setSensor(?Sensor $sensor): self
    {
        $this->sensor = $sensor;

        return $this;
    }
}

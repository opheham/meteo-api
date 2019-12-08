<?php // src/Entity/WeatherData.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * WeatherData entity
 * Weather data obtained from a sensor
 * 
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\WeatherDataRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @author Olivier FILLOL <fillol.olivier@gmail.com>
 * @version 1.0.0
 */
class WeatherData
{
    /**
     * Weather data ID
     * 
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
     * Weather data value
     * 
     * @ORM\Column(
     *      type="float",
     *      options={
     *          "comment": "La valeur de la donnée météo"
     *      }
     * )
     */
    private $value;

    /**
     * Weather data creation date
     * 
     * @ORM\Column(type="datetime",
     *      options={
     *          "comment": "La date d'obtention de la donnée météo"
     *      }
     * )
     */
    private $createdAt;

    /**
     * Weather data sensor
     * 
     * @ORM\ManyToOne(targetEntity="App\Entity\Sensor", inversedBy="weatherData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sensor;
    

    /**
     * Returns the ID
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns the value
     *
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * Sets the value
     *
     * @param float $value
     * @return self
     */
    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Returns thecreation date
     *
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Sets automatically the creation date
     * 
     * @ORM\PrePersist
     *
     * @return self
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \Datetime();

        return $this;
    }

    /**
     * Returns the sensor
     *
     * @return Sensor|null
     */
    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    /**
     * Sets the sensor
     *
     * @param Sensor|null $sensor
     * @return self
     */
    public function setSensor(?Sensor $sensor): self
    {
        $this->sensor = $sensor;

        return $this;
    }
}

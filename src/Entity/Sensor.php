<?php // src/Entity/Sensor.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sensor entity.
 * A sensor is an electronic component mounted as a weather station equipment. It captures meteorological data.
 * 
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SensorRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @author Olivier FILLOL <fillol.olivier@gmail.com>
 * @version 1.0.0
 */
class Sensor
{
    /**
     * Sensor ID
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(
     *      type="integer",
     *      options={
     *          "comment": "Sensor ID"
     *      }
     * )
     */
    private $id;

    /**
     * Sensor name
     * 
     * @ORM\Column(
     *      type="string",
     *      length=255,
     *      options={
     *          "comment": "Sensor name"
     *      }
     * )
     */
    private $name;

    /**
     * Sensor creation date
     * 
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "Sensor creation date"
     *      }
     * )
     */
    private $createdAt;

    /**
     * Sensor update date
     * 
     * @ORM\Column(type="datetime",
     *      options={
     *          "comment": "Sensor update date"
     *      }
     * )
     */
    private $updatedAt;

    /**
     * Sensor collected data
     * 
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\WeatherData",
     *      mappedBy="sensor"
     * )
     */
    private $weatherData;

    /**
     * Sensor type
     * 
     * @ORM\ManyToOne(
     *      targetEntity="App\Entity\SensorType",
     *      inversedBy="sensors"
     * )
     * @ORM\JoinColumn(
     *      nullable=false
     * )
     */
    private $sensorType;

    /**
     * Sensor weather station
     * 
     * @ORM\ManyToOne(
     *      targetEntity="App\Entity\WeatherStation",
     *      inversedBy="sensors"
     * )
     * @ORM\JoinColumn(
     *      nullable=false
     * )
     */
    private $weatherStation;

    
    /**
     * Sensor constructor
     */
    public function __construct()
    {
        $this->weatherData = new ArrayCollection();
    }

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
     * Returns the name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the creation date
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
     * Returns the update date
     *
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * Sets automatically the update date
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return self
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \Datetime();

        return $this;
    }

    /**
     * Returns Sensor weather data
     *
     * @return Collection|WeatherData[]
     */
    public function getWeatherData(): Collection
    {
        return $this->weatherData;
    }

    /**
     * Adds a sensor data
     *
     * @param WeatherData $weatherData
     * @return self
     */
    public function addWeatherData(WeatherData $weatherData): self
    {
        if (!$this->weatherData->contains($weatherData)) {
            $this->weatherData[] = $weatherData;
            $weatherData->setSensor($this);
        }

        return $this;
    }

    /**
     * Deletes a sensor data
     *
     * @param WeatherData $weatherData
     * @return self
     */
    public function removeWeatherData(WeatherData $weatherData): self
    {
        if ($this->weatherData->contains($weatherData)) {
            $this->weatherData->removeElement($weatherData);
            // set the owning side to null (unless already changed)
            if ($weatherData->getSensor() === $this) {
                $weatherData->setSensor(null);
            }
        }

        return $this;
    }

    /**
     * Returns the type
     *
     * @return SensorType|null
     */
    public function getSensorType(): ?SensorType
    {
        return $this->sensorType;
    }

    /**
     * Sets the type
     *
     * @param SensorType|null $sensorType
     * @return self
     */
    public function setSensorType(?SensorType $sensorType): self
    {
        $this->sensorType = $sensorType;

        return $this;
    }

    /**
     * Returns the weather station
     *
     * @return WeatherStation|null
     */
    public function getWeatherStation(): ?WeatherStation
    {
        return $this->weatherStation;
    }

    /**
     * Sets the weather station
     *
     * @param WeatherStation|null $weatherStation
     * @return self
     */
    public function setWeatherStation(?WeatherStation $weatherStation): self
    {
        $this->weatherStation = $weatherStation;

        return $this;
    }
}

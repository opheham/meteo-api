<?php // src/Entity/WeatherStation.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * WeatherStation entity
 * The weather station is the heart of the system. It is created around an Arduino Nano board. It is equipped with different sensors that will allow it to transmit data.
 * 
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\WeatherStationRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @author Olivier FILLOL <fillol.olivier@gmail.com>
 * @version 1.0.0
 */
class WeatherStation
{
    /**
     * Weather station ID
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(
     *      type="integer",
     *      options={
     *          "comment": "L'ID de la station météo"
     *      }
     * )
     */
    private $id;

    /**
     * Weather station name
     * 
     * @ORM\Column(
     *      type="string",
     *      length=255,
     *      options={
     *          "comment": "Le nom de la station"
     *      }
     * )
     */
    private $name;

    /**
     * Weather station description
     * 
     * @ORM\Column(
     *      type="text",
     *      options={
     *          "comment": "La description de la station"
     *      }
     * )
     */
    private $description;

    /**
     * Weather station latitude
     * 
     * @ORM\Column(
     *      type="float",
     *      nullable=true,
     *      options={
     *          "comment": "La latitude de la station"
     *      }
     * )
     */
    private $lat;

    /**
     * Weather station longitude
     * 
     * @ORM\Column(
     *      type="float", 
     *      nullable=true,
     *      options={
     *          "comment": "La longitude de la station"
     *      }
     * )
     */
    private $lng;

    /**
     * Weather station creation date
     * 
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date d'implentation de la station"
     *      }
     * )
     */
    private $createdAt;

    /**
     * Weather station update date
     * 
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de la dernière modification effectuée sur la station"
     *      }
     * )
     */
    private $updatedAt;

    /**
     * Weather station sensors
     * 
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\Sensor",
     *      mappedBy="weatherStation",
     *      orphanRemoval=true
     * )
     */
    private $sensors;

    /**
     * Weather station software version
     * @ORM\ManyToOne(
     *      targetEntity="App\Entity\SoftwareVersion",
     *      inversedBy="weatherStations"
     * )
     */
    private $softwareVersion;
    

    /**
     * Weather station constructor
     */
    public function __construct()
    {
        $this->sensors = new ArrayCollection();
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
     * Returns the description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Returns the latitude
     *
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * Sets the latitude
     *
     * @param float|null $lat
     * @return self
     */
    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }
    
    /**
     * Returns the longitude
     *
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * Sets the longitude
     *
     * @param float|null $lng
     * @return self
     */
    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

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
     * Returns the sensors list
     * 
     * @return Collection|Sensor[]
     */
    public function getSensors(): Collection
    {
        return $this->sensors;
    }

    /**
     * Adds a sensor to the list
     *
     * @param Sensor $sensor
     * @return self
     */
    public function addSensor(Sensor $sensor): self
    {
        if (!$this->sensors->contains($sensor)) {
            $this->sensors[] = $sensor;
            $sensor->setWeatherStation($this);
        }

        return $this;
    }

    /**
     * Deletes a sensor from the list
     *
     * @param Sensor $sensor
     * @return self
     */
    public function removeSensor(Sensor $sensor): self
    {
        if ($this->sensors->contains($sensor)) {
            $this->sensors->removeElement($sensor);
            // set the owning side to null (unless already changed)
            if ($sensor->getWeatherStation() === $this) {
                $sensor->setWeatherStation(null);
            }
        }

        return $this;
    }
    
    /**
     * Returns the software version
     *
     * @return SoftwareVersion|null
     */
    public function getSoftwareVersion(): ?SoftwareVersion
    {
        return $this->softwareVersion;
    }

    /**
     * Sets the software version
     *
     * @param SoftwareVersion|null $softwareVersion
     * @return self
     */
    public function setSoftwareVersion(?SoftwareVersion $softwareVersion): self
    {
        $this->softwareVersion = $softwareVersion;

        return $this;
    }
}

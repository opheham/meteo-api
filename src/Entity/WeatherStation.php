<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Une station météo
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\WeatherStationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class WeatherStation
{
    /**
     * L'ID de la station météo
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
     * Le nom de la station
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
     * La description de la station
     * @ORM\Column(
     *      type="text",
     *      options={
     *          "comment": "La description de la station"
     *      }
     * )
     */
    private $description;

    /**
     * La latitude de la station
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
     * La longitude de la station
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
     * La date de la création de la station
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date d'implentation de la station"
     *      }
     * )
     */
    private $createdAt;

    /**
     * La date de la dernière mise à jour de la station
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de la dernière modification effectuée sur la station"
     *      }
     * )
     */
    private $updatedAt;

    /**
     * Les capteurs météo de la station
     * @ORM\OneToMany(targetEntity="App\Entity\Sensor", mappedBy="weatherStation", orphanRemoval=true)
     */
    private $sensors;

    /**
     * La version logicielle de la station
     * @ORM\ManyToOne(targetEntity="App\Entity\SoftwareVersion", inversedBy="weatherStations")
     */
    private $softwareVersion;

    public function __construct()
    {
        $this->sensors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): self
    {
        $this->lng = $lng;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \Datetime();

        return $this;
    }

    /**
     * @return Collection|Sensor[]
     */
    public function getSensors(): Collection
    {
        return $this->sensors;
    }

    public function addSensor(Sensor $sensor): self
    {
        if (!$this->sensors->contains($sensor)) {
            $this->sensors[] = $sensor;
            $sensor->setWeatherStation($this);
        }

        return $this;
    }

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

    public function getSoftwareVersion(): ?SoftwareVersion
    {
        return $this->softwareVersion;
    }

    public function setSoftwareVersion(?SoftwareVersion $softwareVersion): self
    {
        $this->softwareVersion = $softwareVersion;

        return $this;
    }
}

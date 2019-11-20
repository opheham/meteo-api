<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Un capteur météo implanté sur une station
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SensorRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Sensor
{
    /**
     * L'ID du capteur
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(
     *      type="integer",
     *      options={
     *          "comment": "L'ID du capteur"
     *      }
     * )
     */
    private $id;

    /**
     * Le nom du capteur
     * @ORM\Column(
     *      type="string",
     *      length=255,
     *      options={
     *          "comment": "Le nom du capteur"
     *      }
     * )
     */
    private $name;

    /**
     * La date de création du capteur
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de création du capteur"
     *      }
     * )
     */
    private $createdAt;

    /**
     * La date de la dernière mise à jour du capteur
     * @ORM\Column(type="datetime",
     *      options={
     *          "comment": "La date de la dernière mise à jour du capteur"
     *      }
     * )
     */
    private $updatedAt;

    /**
     * Les données météo du capteur
     * @ORM\OneToMany(targetEntity="App\Entity\WeatherData", mappedBy="sensor")
     */
    private $weatherData;

    /**
     * Le type du capteur
     * @ORM\ManyToOne(targetEntity="App\Entity\SensorType", inversedBy="sensors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sensorType;

    /**
     * La station météo du capteur
     * @ORM\ManyToOne(targetEntity="App\Entity\WeatherStation", inversedBy="sensors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $weatherStation;

    public function __construct()
    {
        $this->weatherData = new ArrayCollection();
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

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

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
     * @return Collection|WeatherData[]
     */
    public function getWeatherData(): Collection
    {
        return $this->weatherData;
    }

    public function addWeatherData(WeatherData $weatherData): self
    {
        if (!$this->weatherData->contains($weatherData)) {
            $this->weatherData[] = $weatherData;
            $weatherData->setSensor($this);
        }

        return $this;
    }

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

    public function getSensorType(): ?SensorType
    {
        return $this->sensorType;
    }

    public function setSensorType(?SensorType $sensorType): self
    {
        $this->sensorType = $sensorType;

        return $this;
    }

    public function getWeatherStation(): ?WeatherStation
    {
        return $this->weatherStation;
    }

    public function setWeatherStation(?WeatherStation $weatherStation): self
    {
        $this->weatherStation = $weatherStation;

        return $this;
    }
}

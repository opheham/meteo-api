<?php // src/Entity/SoftwareVersion.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SoftwareVersion entity
 * Weather station software version
 * 
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SoftwareVersionRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @author Olivier FILLOL <fillol.olivier@gmail.com>
 * @version 1.0.0
 */
class SoftwareVersion
{
    /**
     * Software version ID
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(
     *      type="integer",
     *      options={
     *          "comment": "L'ID de la version"
     *      }
     * )
     */
    private $id;

    /**
     * Software version number
     * 
     * @ORM\Column(
     *      type="string",
     *      length=255,
     *      options={
     *          "comment": "Le numéro de la version"
     *      }
     * )
     */
    private $version;

    /**
     * Software version creation date
     * 
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de création de la version"
     *      }
     * )
     */
    private $createdAt;

    /**
     * Weather stations using the software version
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\WeatherStation", mappedBy="softwareVersion")
     */
    private $weatherStations;
    
    /**
     * Software version constructor
     */
    public function __construct()
    {
        $this->weatherStations = new ArrayCollection();
    }

    /**
     * Returns ID
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns software version number
     *
     * @return string|null
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Sets software version number
     *
     * @param string $version
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Returns creation date
     *
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Sets automatically creation data
     * 
     * @ORM\PrePersist
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \Datetime();

        return $this;
    }

    /**
     * Returns the weather stations using the software version
     * 
     * @return Collection|WeatherStation[]
     */
    public function getWeatherStations(): Collection
    {
        return $this->weatherStations;
    }

    /**
     * Adds a weather station to the list
     *
     * @param WeatherStation $weatherStation
     * @return self
     */
    public function addWeatherStation(WeatherStation $weatherStation): self
    {
        if (!$this->weatherStations->contains($weatherStation)) {
            $this->weatherStations[] = $weatherStation;
            $weatherStation->setSoftwareVersion($this);
        }

        return $this;
    }

    /**
     * Deletes weather station from the list
     *
     * @param WeatherStation $weatherStation
     * @return self
     */
    public function removeWeatherStation(WeatherStation $weatherStation): self
    {
        if ($this->weatherStations->contains($weatherStation)) {
            $this->weatherStations->removeElement($weatherStation);
            // set the owning side to null (unless already changed)
            if ($weatherStation->getSoftwareVersion() === $this) {
                $weatherStation->setSoftwareVersion(null);
            }
        }

        return $this;
    }
}

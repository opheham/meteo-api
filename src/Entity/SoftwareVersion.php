<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Version logicielle des stations météo
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SoftwareVersionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SoftwareVersion
{
    /**
     * L'ID de la version logicielle
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
     * Le numéro de version
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
     * La date de création de la version logicielle
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de création de la version"
     *      }
     * )
     */
    private $createdAt;

    /**
     * Les stations météo équipées de la version logicielle
     * @ORM\OneToMany(targetEntity="App\Entity\WeatherStation", mappedBy="softwareVersion")
     */
    private $weatherStations;

    public function __construct()
    {
        $this->weatherStations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

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

    /**
     * @return Collection|WeatherStation[]
     */
    public function getWeatherStations(): Collection
    {
        return $this->weatherStations;
    }

    public function addWeatherStation(WeatherStation $weatherStation): self
    {
        if (!$this->weatherStations->contains($weatherStation)) {
            $this->weatherStations[] = $weatherStation;
            $weatherStation->setSoftwareVersion($this);
        }

        return $this;
    }

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

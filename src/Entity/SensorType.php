<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SensorTypeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class SensorType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(
     *      type="integer",
     *      options={
     *          "comment": "L'ID du type de capteur"
     *      }
     * )
     */
    private $id;

    /**
     * @ORM\Column(
     *      type="string",
     *      length=255,
     *      options={
     *          "comment": "Le nom du type de capteur"
     *      }
     * )
     */
    private $name;

    /**
     * @ORM\Column(
     *      type="text",
     *      options={
     *          "comment": "La description du type de capteur"
     *      }
     * )
     */
    private $description;

    /**
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de création du type de capteur"
     *      }
     * )
     */
    private $createdAt;

    /**
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de la dernière mise à jour du type de capteur"
     *      }
     * )
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sensor", mappedBy="sensorType", orphanRemoval=true)
     */
    private $sensors;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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
            $sensor->setSensorType($this);
        }

        return $this;
    }

    public function removeSensor(Sensor $sensor): self
    {
        if ($this->sensors->contains($sensor)) {
            $this->sensors->removeElement($sensor);
            // set the owning side to null (unless already changed)
            if ($sensor->getSensorType() === $this) {
                $sensor->setSensorType(null);
            }
        }

        return $this;
    }
}

<?php // src/Entity/SensorType.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SensorType entity.
 * The type of sensor defined a weather sensor.
 * 
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\SensorTypeRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * @author Olivier FILLOL <fillol.olivier@gmail.com>
 * @version 1.0.0
 */
class SensorType
{
    /**
     * Sensor type ID
     * 
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
     * Sensor type name
     * 
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
     * Sensor type description
     * 
     * @ORM\Column(
     *      type="text",
     *      options={
     *          "comment": "La description du type de capteur"
     *      }
     * )
     */
    private $description;

    /**
     * Sensor type creation date
     * 
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de création du type de capteur"
     *      }
     * )
     */
    private $createdAt;

    /**
     * Sensor type update date
     * 
     * @ORM\Column(
     *      type="datetime",
     *      options={
     *          "comment": "La date de la dernière mise à jour du type de capteur"
     *      }
     * )
     */
    private $updatedAt;

    /**
     * Sensors list associated with SensorType
     * 
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\Sensor",
     *      mappedBy="sensorType",
     *      orphanRemoval=true
     * )
     */
    private $sensors;

    
    /**
     * Sensor type constructor
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
     * @param \DateTimeInterface $createdAt
     * @return self
     */
    public function setCreatedAt(): self
    {
        $this->createdAt = new \DateTime();

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
     * @param \DateTimeInterface $updatedAt
     * @return self
     */
    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime();

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
     * Adds a sensor to sensors list
     *
     * @param Sensor $sensor
     * @return self
     */
    public function addSensor(Sensor $sensor): self
    {
        if (!$this->sensors->contains($sensor)) {
            $this->sensors[] = $sensor;
            $sensor->setSensorType($this);
        }

        return $this;
    }

    /**
     * Deletes a sensor from the sensors list
     *
     * @param Sensor $sensor
     * @return self
     */
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

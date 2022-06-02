<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircleRepository::class)
 */
final class Circle implements CircumferenceInterface, AreaInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float")
     */
    private float $radius;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $type;

    public function __construct(float $radius)
    {
        $this->radius = $radius;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): self
    {
        $this->radius = $radius;

        return $this;
    }

    public function getType(): ?string
    {
        return __CLASS__;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCircumference() : float
    {         
    	$circumference = 2 * pi() * $this->radius;
         
    	return $circumference;
 	}

    public function getArea() : float
	{
		$area = pi() * pow($this->radius, 2);

		return $area;
	}

}

<?php

namespace App\Entity;

use App\Repository\CircleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircleRepository::class)
 */
class Circle implements CircleInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $radius;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

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
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function circumference() : float
    {         
    	$circumference = 2 * pi() * $this->radius;
         
    	return $circumference;
 	}

    public function area() : float
	{
		$area = pi() * pow($this->radius, 2);

		return $area;
	}

}

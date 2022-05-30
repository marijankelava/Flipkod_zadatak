<?php

namespace App\Entity;

use App\Repository\TriangleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TriangleRepository::class)
 */
class Triangle
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
    private $a;

    /**
     * @ORM\Column(type="float")
     */
    private $b;

    /**
     * @ORM\Column(type="float")
     */
    private $c;

    public function __construct(float $a, float $b, float $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): ?float
    {
        return $this->a;
    }

    public function setA(float $a): self
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?float
    {
        return $this->b;
    }

    public function setB(float $b): self
    {
        $this->b = $b;

        return $this;
    }

    public function getC(): ?float
    {
        return $this->c;
    }

    public function setC(float $c): self
    {
        $this->c = $c;

        return $this;
    }

    public function circumference() : float
	{
		$circumference = $this->a + $this->b + $this->c;

		return $circumference;
	}

    public function area() : float
	{
		$s = ($this->a + $this->b + $this->c)/2;

		$area = sqrt($s*($s-$this->a)*($s-$this->b)*($s-$this->c));

		return $area;
	}
}

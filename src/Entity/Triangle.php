<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TriangleRepository::class)
 */
final class Triangle implements CircumferenceInterface, AreaInterface
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
    private float $a;

    /**
     * @ORM\Column(type="float")
     */
    private float $b;

    /**
     * @ORM\Column(type="float")
     */
    private float $c;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $type;

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
		$circumference = $this->a + $this->b + $this->c;

		return $circumference;
	}

    public function getArea() : float
	{
		$s = ($this->a + $this->b + $this->c)/2;

		$area = sqrt($s*($s-$this->a)*($s-$this->b)*($s-$this->c));

		return $area;
	}
}

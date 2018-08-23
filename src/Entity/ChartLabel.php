<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChartLabelRepository")
 */
class ChartLabel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"test"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chart", inversedBy="chartLabels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chart;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"test"})
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChart(): ?Chart
    {
        return $this->chart;
    }

    public function setChart(?Chart $chart): self
    {
        $this->chart = $chart;

        return $this;
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
}

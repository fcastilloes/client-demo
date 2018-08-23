<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChartRepository")
 */
class Chart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"test"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"test"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"test"})
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ChartLabel", mappedBy="chart", orphanRemoval=true)
     * @Groups({"test"})
     */
    private $chartLabels;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"test"})
     */
    private $repo;

    /**
     * @Assert\Callback()
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if (substr_count($this->getRepo(), '/') !== 1) {
            $context->buildViolation('Repositorio inválido')
                ->atPath('repo')
                ->addViolation();
        }
    }

    public function __construct()
    {
        $this->chartLabels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|ChartLabel[]
     */
    public function getChartLabels(): Collection
    {
        return $this->chartLabels;
    }

    public function addChartLabel(ChartLabel $chartLabel): self
    {
        if (!$this->chartLabels->contains($chartLabel)) {
            $this->chartLabels[] = $chartLabel;
            $chartLabel->setChart($this);
        }

        return $this;
    }

    public function removeChartLabel(ChartLabel $chartLabel): self
    {
        if ($this->chartLabels->contains($chartLabel)) {
            $this->chartLabels->removeElement($chartLabel);
            // set the owning side to null (unless already changed)
            if ($chartLabel->getChart() === $this) {
                $chartLabel->setChart(null);
            }
        }

        return $this;
    }

    public function getRepo(): ?string
    {
        return $this->repo;
    }

    public function setRepo(string $repo): self
    {
        $this->repo = $repo;

        return $this;
    }
}

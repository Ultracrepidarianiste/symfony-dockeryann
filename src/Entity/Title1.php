<?php

namespace App\Entity;

use App\Repository\Title1Repository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: Title1Repository::class)]
class Title1
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $title2 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $title3 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle2(): ?string
    {
        return $this->title2;
    }

    public function setTitle2(?string $title2): static
    {
        $this->title2 = $title2;

        return $this;
    }

    public function getTitle3(): ?string
    {
        return $this->title3;
    }

    public function setTitle3(string $title3): static
    {
        $this->title3 = $title3;

        return $this;
    }
}

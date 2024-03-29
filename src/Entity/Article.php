<?php

namespace App\Entity;

use App\Entity\Commentaire;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $titre1 = null;
    #[ORM\Column(type: Types::TEXT)]
    private ?string $Text = null;
    #[ORM\Column(type: Types::TEXT)]
    private ?string $Author = null;
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $Date = null;

    #[ORM\OneToMany(targetEntity: commentaire::class, mappedBy: 'relart', orphanRemoval: true)]
    private Collection $relation;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'Article')]
    private Collection $idArticle;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->idArticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre1(): ?string
    {
        return $this->titre1;
    }

    public function setTitre1(string $titre1): static
    {
        $this->titre1 = $titre1;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(string $Text): static
    {
        $this->Text = $Text;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->Author;
    }

    public function setAuthor(string $Author): static
    {
        $this->Author = $Author;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(\DateTime $Date): static
    {
        $this->Date = $Date;

        return $this;
    }


    /**
     * @return Collection<int, commentaire>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(commentaire $relation): static
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
            $relation->setRelart($this);
        }

        return $this;
    }

    public function removeRelation(commentaire $relation): static
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getRelart() === $this) {
                $relation->setRelart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getIdArticle(): Collection
    {
        return $this->idArticle;
    }

    public function addIdArticle(Commentaire $idArticle): static
    {
        if (!$this->idArticle->contains($idArticle)) {
            $this->idArticle->add($idArticle);
            $idArticle->setArticle($this);
        }

        return $this;
    }

    public function removeIdArticle(Commentaire $idArticle): static
    {
        if ($this->idArticle->removeElement($idArticle)) {
            // set the owning side to null (unless already changed)
            if ($idArticle->getArticle() === $this) {
                $idArticle->setArticle(null);
            }
        }

        return $this;
    }
}

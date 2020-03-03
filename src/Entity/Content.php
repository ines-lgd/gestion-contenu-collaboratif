<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $releasedDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="content")
     */
    private $editor;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReleasedDate(): ?\DateTimeInterface
    {
        return $this->releasedDate;
    }

    public function setReleasedDate(?\DateTimeInterface $releasedDate): self
    {
        $this->releasedDate = $releasedDate;

        return $this;
    }

    public function getEditor(): ?SocialNetwork
    {
        return $this->editor;
    }

    public function setEditor(?SocialNetwork $editor): self
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setContent($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getContent() === $this) {
                $comment->setContent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getReviewer(): Collection
    {
        return $this->Reviewer;
    }

    public function addReviewer(User $reviewer): self
    {
        if (!$this->reviewer->contains($reviewer)) {
            $this->reviewer[] = $reviewer;
        }

        return $this;
    }

    public function removeReviewer(User $reviewer): self
    {
        if ($this->reviewer->contains($reviewer)) {
            $this->reviewer->removeElement($reviewer);
        }

        return $this;
    }
}

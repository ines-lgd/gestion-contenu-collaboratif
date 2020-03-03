<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatformRepository")
 */
class Comments
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
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", mappedBy="editor")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="content")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $reviewer;

    /**
     * Content constructor
     */
    function __construct()
    {
        $this->date = new \DateTime();
        $this->isPublished = false;
        $this->comments = new ArrayCollection();
        $this->reviewer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAuthor(): ?User

    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }
}

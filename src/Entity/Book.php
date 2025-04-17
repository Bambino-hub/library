<?php

    namespace App\Entity;

    use App\Enum\BookStatus;
    use App\Repository\BookRepository;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\DBAL\Types\Types;
    use Doctrine\ORM\Mapping as ORM;

    #[ORM\Entity(repositoryClass: BookRepository::class)]
    class Book
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;

        #[ORM\Column(length: 255)]
        private ?string $title = null;

        #[ORM\Column(length: 255)]
        private ?string $isbn = null;

        #[ORM\Column(length: 255)]
        private ?string $cover = null;

        #[ORM\Column]
        private ?\DateTimeImmutable $editedAt = null;

        #[ORM\Column(length: 255)]
        private ?string $plot = null;

        #[ORM\Column]
        private ?int $pageNumber = null;

        #[ORM\Column(type: Types::SIMPLE_ARRAY, enumType: BookStatus::class)]
        private array $status = [];

        #[ORM\ManyToOne(inversedBy: 'books')]
        private ?Author $author = null;

        #[ORM\ManyToOne(inversedBy: 'books')]
        private ?Editor $editor = null;

        /**
         * @var Collection<int, Comment>
         */
        #[ORM\ManyToMany(targetEntity: Comment::class, inversedBy: 'books')]
        private Collection $comment;

        public function __construct()
        {
            $this->comment = new ArrayCollection();
        }


        

        // setters and getters

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getTitle(): ?string
        {
            return $this->title;
        }

        public function setTitle(string $title): static
        {
            $this->title = $title;

            return $this;
        }

        public function getIsbn(): ?string
        {
            return $this->isbn;
        }

        public function setIsbn(string $isbn): static
        {
            $this->isbn = $isbn;

            return $this;
        }

        public function getCover(): ?string
        {
            return $this->cover;
        }

        public function setCover(string $cover): static
        {
            $this->cover = $cover;

            return $this;
        }

        public function getEditedAt(): ?\DateTimeImmutable
        {
            return $this->editedAt;
        }

        public function setEditedAt(\DateTimeImmutable $editedAt): static
        {
            $this->editedAt = $editedAt;

            return $this;
        }

        public function getPlot(): ?string
        {
            return $this->plot;
        }

        public function setPlot(string $plot): static
        {
            $this->plot = $plot;

            return $this;
        }

        public function getPageNumber(): ?int
        {
            return $this->pageNumber;
        }

        public function setPageNumber(int $pageNumber): static
        {
            $this->pageNumber = $pageNumber;

            return $this;
        }

        /**
         * @return BookStatus[]
         */
        public function getStatus(): array
        {
            return $this->status;
        }

        public function setStatus(array $status): static
        {
            $this->status = $status;

            return $this;
        }

        public function getAuthor(): ?Author
        {
            return $this->author;
        }

        public function setAuthor(?Author $author): static
        {
            $this->author = $author;

            return $this;
        }

        public function getEditor(): ?Editor
        {
            return $this->editor;
        }

        public function setEditor(?Editor $editor): static
        {
            $this->editor = $editor;

            return $this;
        }

        /**
         * @return Collection<int, Comment>
         */
        public function getComment(): Collection
        {
            return $this->comment;
        }

        public function addComment(Comment $comment): static
        {
            if (!$this->comment->contains($comment)) {
                $this->comment->add($comment);
            }

            return $this;
        }

        public function removeComment(Comment $comment): static
        {
            $this->comment->removeElement($comment);

            return $this;
        }
    }

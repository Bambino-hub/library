<?php

namespace App\DataFixtures;

use App\Enum\CommentStatus;
use App\Enum\BookStatus;
use App\Entity\Book;
use App\Entity\Comment;
use App\Entity\Editor;
use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // $faker = Factory::create();
        $faker = Factory::create('fr_FR'); // Use French locale for Faker
        // Create Authors
        $authors = [];
        for ($i = 0; $i < 5; $i++) {
            $author = new Author();
            $author->setName($faker->name());
            $author->setDateOfBirth(new \DateTimeImmutable($faker->date()));
            $manager->persist($author);
            $authors[] = $author;
        }

        // Create Editors
        $editors = [];
        for ($i = 0; $i < 3; $i++) {
            $editor = new Editor();
            $editor->setName($faker->company());
            $manager->persist($editor);
            $editors[] = $editor;
        }

        // Create Comments
        $comments = [];
        for ($i = 0; $i < 10; $i++) {
            $comment = new Comment();
            $comment->setContent($faker->sentence());
            $comment->setCreatedAt(new \DateTimeImmutable($faker->date()));
            $comment->setName($faker->name());
            $comment->setEmail($faker->email());
            $comment->setStatus($faker->randomElement([CommentStatus::PENDING, CommentStatus::APPROVED, CommentStatus::REJECTED]));
            $manager->persist($comment);
            $comments[] = $comment;
        }

        // Create Books
        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence(3));
            $book->setIsbn($faker->isbn13());
            $book->setCover($faker->imageUrl(200, 300, 'books'));
            $book->setPlot($faker->paragraph());
            $book->setPageNumber($faker->numberBetween(100, 1000));
            $book->setEditedAt(new \DateTimeImmutable($faker->date()));
            // Set random status
            $book->setStatus([BookStatus::AVAILABLE]); // Example status
            $book->setAuthor($faker->randomElement($authors));
            $book->setEditor($faker->randomElement($editors));

            // Add random comments
            foreach ($faker->randomElements($comments, $faker->numberBetween(1, 5)) as $comment) {
                $book->addComment($comment);
            }

            $manager->persist($book);
        }


        $manager->flush();
    }
}

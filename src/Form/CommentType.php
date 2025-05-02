<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Comment;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('name')
            // ->add('email')
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('publisheAt', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('content')
            // ->add('status')
            // ->add('books', EntityType::class, [
            //     'class' => Book::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
            ->add(
                'Save',
                SubmitType::class,
                [
                    'label' => 'Evoyer'
                ]
            )
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'attachTimesTamp'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }

    /**
     * add event listener to createadAt field
     * @param \Symfony\Component\Form\Event\PostSubmitEvent $event
     * @return void
     */
    public function attachTimesTamp(PostSubmitEvent $event): void
    {
        $data = $event->getData();
        if (!($data instanceof Comment)) {
            return;
        }

        if (!($data->getId())) {
            $data->setCreatedAt(new \DateTimeImmutable());
        }
    }
}

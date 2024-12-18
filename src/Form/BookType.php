<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Supplier;
use App\Enum\GenreTypeEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('pages')
            ->add('publishedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('genre',EnumType::class,[
                'class'=>GenreTypeEnum::class
            ])
            ->add('author',EntityType::class,[
                'class' => Author::class,
                'choice_label' => 'fullName'
                ]
            )
            ->add('suppliers',EntityType::class,[
                'class' => Supplier::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'by_reference' => false

    ])
//            ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
            'csrf_protection' => true,
            'csrf_field_name' => "_token",
            'csrf_token_id' => 'book_item'
        ]);
    }
}

<?php

namespace App\Form;

use App\Filter\BlogFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setMethod('GET') //если это не поставить то будет ругаться
            ->add('title', TextType::class, ['required' => false])
            ->add('content', TextType::class, ['required' => false, 'mapped' => false])
        ;// сейчас ищет только по имени, если добавляются критерии отбора
    }// то надо в классе BlogFilter добавить поле и в методе репозитория тоже обработать значение.
// метод репозитория вызывается в контроллере   'blogs' => $blogRepository->findByBlogFilter($blogFilter),
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogFilter::class,
            'csrf_protection' => false,
        ]);
    }
}

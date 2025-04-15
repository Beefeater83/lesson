<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\User;
use App\Form\DataTransformer\TagTransformer;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogType extends AbstractType
{
    public function __construct(
        private readonly TagTransformer $tagTransformer,
        private readonly Security $security)
    {

    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'help' => 'Заполни заголовок',
                'attr' => [
                    'class' => 'my-class',
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
            ])
            ->add('text', TextareaType::class, [
                'required' => true,
            ]);
            if($this->security->isGranted('ROLE_ADMIN')){
                $builder ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'query_builder' => function (CategoryRepository $repository) {
                        return $repository->createQueryBuilder('c')->orderBy('c.name', 'ASC');
                    },
                    'choice_label' => 'name',
                    'required' => false,
                    'placeholder' => 'Виберіть категорію',
                ])->add('user', EntityType::class, [
                    'class' => User::class,
                    'query_builder' => function (UserRepository $repository) {
                        return $repository->createQueryBuilder('u')->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => 'email',
                    'required' => false,
                    'placeholder' => 'Выберите пользователя',
                ]);
            }

           $builder ->add('tags', TextType::class, [
                'label' => 'Теги',
                'required' => false,
            ])
        ;

        $builder->get('tags')->addModelTransformer($this->tagTransformer);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}

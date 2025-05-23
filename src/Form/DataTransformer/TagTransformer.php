<?php

namespace App\Form\DataTransformer;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Collections\Collection;


class TagTransformer implements DataTransformerInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private TagRepository $tagRepository,
    ) {
    }


    public function transform($tags): string
    {
        if (null === $tags || count($tags) === 0) {
            return '';
        }

        return implode(', ', $tags->map(fn(Tag $tag) => $tag->getName())->toArray());
    }

    public function reverseTransform(mixed $value = null): ?ArrayCollection
    {
        if (!$value) {
            return null;
        }

        $items = explode(',', $value);
        $items = array_map('trim', $items);
        $items = array_unique($items);

        $tags = new ArrayCollection();

        foreach ($items as $item) {
            $tag = $this->tagRepository->findOneBy(['name' => $item]);
            if(!$tag) {
                $tag = (new Tag())->setName($item);
            }
            $tags->add($tag);
        }

        return $tags;
    }
}
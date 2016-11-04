<?php

declare(strict_types=1);

namespace Psi\Component\View;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ViewFactory
{
    private $registry;

    public function __construct(
        TypeRegistry $registry

    ) {
        $this->registry = $registry;
    }

    public function create(string $typeName, $data, array $options): ViewInterface
    {
        $resolver = new OptionsResolver();
        $type = $this->registry->get($typeName);
        $type->configureOptions($resolver);

        $options = $resolver->resolve($options);

        return $type->createView($this, $data, $options);
    }
}

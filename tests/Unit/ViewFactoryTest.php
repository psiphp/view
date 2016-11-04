<?php

namespace Psi\Component\View\Tests\Unit;

use Prophecy\Argument;
use Psi\Component\View\TypeInterface;
use Psi\Component\View\TypeRegistry;
use Psi\Component\View\ViewFactory;
use Psi\Component\View\ViewInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ViewFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $registry;
    private $factory;

    public function setUp()
    {
        $this->registry = $this->prophesize(TypeRegistry::class);
        $this->factory = new ViewFactory(
            $this->registry->reveal()
        );

        $this->viewType = $this->prophesize(TypeInterface::class);
        $this->view = $this->prophesize(ViewInterface::class);
    }

    /**
     * It should create new views.
     */
    public function testCreateView()
    {
        $data = new \stdClass();
        $typeName = 'foobar';
        $options = [
            'one' => 'two',
        ];

        $this->registry->get($typeName)->willReturn($this->viewType->reveal());
        $this->viewType->configureOptions(Argument::type(OptionsResolver::class))->will(function ($args) {
            $args[0]->setDefault('one', 'three');
            $args[0]->setDefault('six', 'seven');
        });
        $this->viewType->createView(
            $this->factory,
            $data,
            [
                'one' => 'two',
                'six' => 'seven',
            ]
        )->willReturn($this->view->reveal());

        $view = $this->factory->create($typeName, $data, $options);

        $this->assertSame($this->view->reveal(), $view);
    }
}

View
====

The view component is a simple object-based "view" system. It is roughly
analagous to a more-specific implementation of the controller and view of the
MVC pattern, but without rendered output.

Each view has a type, for example ``markdown`` or ``image`` (or ``table``,
``row``, ``cell``, or whatever). The type is responsible for creating a view
*object* from some data and a given configuration. The resulting object can
then be rendered by something (e.g. simple PHP, Twig, or some other PHP
templating engine).

.. note::

    An easy way to apply templates to the view objects is to use the Twig
    based `object template`_ bundle.

.. _object template: https://github.com/psiphp/object-render-bundle

Problem
-------

Oftentimes it is required to programatically configure an aspect of a
generated view. One example would be the formatting of grid cells in an
admin interface.

One solution is to allow the specification of a specific template for a
specific cell. However this does not allow you to configure options for the
cell, or be able to access any services which might be required in order to
render the cell.

Solution
--------

The view component provides view *types* which generate view objects. The view
types are *factory services* which are available via. the ``TypeRegistry``.
They can instantiate new views based on a given type and a configuration.

Configuration is defined by using the Symfony `OptionsResolver`_ component.

.. _OptionsResolver: http://symfony.com/doc/current/components/options_resolver.html

Usage
-----

TODO



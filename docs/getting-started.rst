.. _getting-started:

Getting Started
===============

In this chapter you will learn how to install PhpStratum, loading stored routines, and generating the data layer. The data layer is a class for conveniently invoking your stored routines in your PHP code.

Installing PhpStratum
---------------------

The preferred way to install PhpStratum is using composer_:

.. code-block:: sh

  composer require setbased/php-stratum-mysql
  composer require setbased/php-stratum

The first line installs the MySQL and MariaDB backend and the second line installs the frontend (a.k.a the CLI) of PhpStratum.

Running PhpStratum
------------------

You can run PhpStratum from the command line:

.. code-block:: sh

  ./vendor/bin/stratum

If you have set ``bin-dir`` in the ``config`` section in ``composer.json`` you must use a different path.




























.. _composer: https://getcomposer.org/

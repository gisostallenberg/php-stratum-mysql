Installing & Uninstalling PhpStratum
====================================

Installing PhpStratum
---------------------

The preferred way to install PhpStratum is using composer_:

.. code-block:: sh

  composer require setbased/php-stratum-mysql
  composer require setbased/php-stratum

The first line installs the MySQL and MariaDB backend and the second line installs the frontend (a.k.a the CLI) of PhpStratum.

Running PhpStratum
``````````````````

You can run PhpStratum from the command line:

.. code-block:: sh

  ./vendor/bin/stratum

If you have set ``bin-dir`` in the ``config`` section in ``composer.json`` you must use a different path.

For example:

.. code-block:: json

  {
    "config": {
      "bin-dir": "bin/"
    }
  }

then you can run PhpStratum from the command line:

.. code-block:: sh

  ./bin/stratum

Uninstalling PhpStratum
-----------------------

Remove PhpStratum from your project with composer_:

.. code-block:: sh

  composer remove setbased/php-stratum-mysql
  composer remove setbased/php-stratum

.. _composer: https://getcomposer.org/

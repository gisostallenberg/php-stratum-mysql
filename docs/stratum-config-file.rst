.. _php-stratum-config-file:

The PhpStratum Config File
==========================

This chapter is the specification of the stratum config file.

For most projects the stratum config file must added to the VCS and distributed to the production environment of your project (unless you have some other mechanism for loading stored routines into your production database).

The stratum config file is a JSON, XML, YML or INI file and consist out of five sections which we discuss in detail in the sections below. Throughout this manual we are using INI file.

The stratum section
-------------------

The ``stratum`` section is mandatory and holds one variable only:

  ``backend`` (mandatory)
    The fully qualified name of the class that implements the required backend. The backend must be a child class of ``SetBased\Stratum\Backend\Backend``. The backend of PhpStratum for MySQL and MariaDB is implemented in ``SetBased\Stratum\MySql\Backend\MysqlBackend``.

The database section
--------------------

The ``database`` section is mandatory and holds the parameters to connect to the MySQL or MariaDB instance.

  ``host`` (mandatory)
    The host were the MySQL or MariaDB instance is running.

  ``user`` (mandatory)
    The user name. The user must have the `create routine` privilege.

  ``password`` (mandatory)
    The password of `user`.

  ``database`` (mandatory)
    The schema (database) with your application tables.

  ``port`` (optional)
    The port number for connecting to the MySQL or MariaDB instance. Default value is 3306.

The constants section
---------------------

The ``constants`` section is optional and holds the variables for constants based on column sizes and constants defined in PHP available in the sources of stored routines.

  ``columns`` (mandatory)
    A plain text file with table column names and their corresponding constant names.

  ``class`` (mandatory)
    The class defining constants.

  ``prefix`` (mandatory)
    The default prefix to used when generating a constant name based on the size of a column.

The loader section
------------------

The ``loader`` section is mandatory and holds the variables for loading your stored routines into the database.

  ``sources`` (mandatory)
    Holds the pattern with sources of stored routines. This variable can have two forms:

    * A wildcard pattern like ``lib/psql/**/*.psql``.

    * A filename like ``file:stratum-sources.txt``. The filename is relative to the directory of the stratum config file. The file holds a wildcard pattern per line.

  ``metadata`` (mandatory)
    The path to the file were the metadata of stored routines must be stored in JSON format. This metadata is used to determine which stored routines must loaded or removed from the database and provide information for wrapper generator.

  ``sql_mode`` (mandatory)
    The SQL mode under which the stored routines must run.

  ``character_set`` (mandatory)
    The (default) character set under which the stored routine must run.

  ``collate`` (mandatory)
    The (default) collate under which the stored routine must run.

Note: the SQL mode, character set, and collate under which a store routine runs is determined when the stored routine is defined and not inherited from the session that call the stored routine.

The wrapper section
-------------------

The wrapper section is optional and holds variables for generating the wrapper class (a.k.a. the data layer).

  ``parent_class`` (mandatory)
    The fully qualified name of the parent class of the wrapper class. PhpStratum for MySQL and MariaDB provides class ``SetBased\Stratum\MySql\MySqlDataLayer``.

  ``mangler_class`` (optional)
    The fully qualified name of the class for converting the name of a stored routine into the name of the method for calling the stored routine. This class must implement ``SetBased\Stratum\Middle\NameMangler\NameMangler``. Fr converting stored routines with underscores use class ``\SetBased\Stratum\Middle\NameMangler\PsrNameMangler``.

  ``wrapper_class`` (mandatory)
    The fully qualified name of the generated wrapper class.

  ``wrapper_file`` (mandatory)
    The path the file where to source of the wrapper class must be stored.

  ``strict_types`` (optional, default ``1``)
    If ``1`` the wrapper class will enable strict mode. If ``0`` strict mode is disabled.

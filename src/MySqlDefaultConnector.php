<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql;

use SetBased\Stratum\MySql\Exception\MySqlConnectFailedException;

/**
 * Connects to a MySql instance using user name and password.
 */
class MySqlDefaultConnector implements MySqlConnector
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The connection between PHP and the MySQL instance.
   *
   * @var \mysqli
   */
  protected $mysqli;

  /**
   * @var string
   */
  private $database;

  /**
   * The hostname.
   *
   * @var string
   */
  private $host;

  /**
   * The password.
   *
   * @var string
   */
  private $password;

  /**
   * The port number.
   *
   * @var int
   */
  private $port;

  /**
   * The MySQL user name.
   *
   * @var string
   */
  private $user;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param string $host     The hostname.
   * @param string $user     The MySQL user name.
   * @param string $password The password.
   * @param string $database The default database.
   * @param int    $port     The port number.
   *
   * @since 5.0.0
   * @api
   */
  public function __construct(string $host, string $user, string $password, string $database, int $port = 3306)
  {
    $this->host     = $host;
    $this->user     = $user;
    $this->password = $password;
    $this->database = $database;
    $this->port     = $port;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object destructor.
   *
   * @since 5.0.0
   * @api
   */
  public function __destruct()
  {
    $this->disconnect();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Connects to the MySql instance.
   *
   * @return \mysqli
   *
   * @throws MySqlConnectFailedException
   *
   * @since 5.0.0
   * @api
   */
  public function connect(): \mysqli
  {
    $this->disconnect();

    $this->mysqli = @new \mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
    if ($this->mysqli->connect_errno)
    {
      $exception    = new MySqlConnectFailedException($this->mysqli->connect_errno,
                                                      $this->mysqli->connect_error,
                                                      'mysqli::__construct');
      $this->mysqli = null;

      throw $exception;
    }

    return $this->mysqli;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Disconnects from the MySql instance.
   *
   * @since 5.0.0
   * @api
   */
  public function disconnect(): void
  {
    if ($this->mysqli!==null)
    {
      @$this->mysqli->close();
      $this->mysqli = null;
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if PHP is (still) connected with the MySql instance.
   *
   * @return bool
   *
   * @since 5.0.0
   * @api
   */
  public function isAlive(): bool
  {
    if ($this->mysqli===null)
    {
      return false;
    }

    $result = @$this->mysqli->query('select 1');
    if (is_bool($result))
    {
      return false;
    }
    $result->free();

    return true;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

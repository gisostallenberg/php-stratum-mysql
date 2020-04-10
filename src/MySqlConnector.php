<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql;

use SetBased\Stratum\MySql\Exception\MySqlConnectFailedException;

/**
 * Interface for classes connection a MySql instance.
 */
interface MySqlConnector
{
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
  public function connect(): \mysqli;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Disconnects from the MySql instance.
   *
   * This method will never throw an exception.
   *
   * @since 5.0.0
   * @api
   */
  public function disconnect(): void;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if PHP is (still) connected with the MySql instance. Otherwise returns false.
   *
   * This method will never throw an exception.
   *
   * @return bool
   *
   * @since 5.0.0
   * @api
   */
  public function isAlive(): bool;

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

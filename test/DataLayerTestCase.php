<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Stratum\MySql\Exception\MySqlConnectFailedException;
use SetBased\Stratum\MySql\Exception\MySqlDataLayerException;
use SetBased\Stratum\MySql\MySqlDefaultConnector;

/**
 * Parent class for all test cases.
 */
class DataLayerTestCase extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The data layer.
   *
   * @var TestMySqlDataLayer
   */
  protected TestMySqlDataLayer $dataLayer;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Connects to the MySQL server.
   *
   * @throws MySqlConnectFailedException
   * @throws MySqlDataLayerException
   */
  protected function setUp(): void
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');
    $this->dataLayer = new TestMySqlDataLayer($connector);
    $this->dataLayer->connect();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if the server is a MariaDB 10.3 or 10.4 instance.
   *
   * @return bool
   *
   * @throws MySqlDataLayerException
   */
  protected function isMariaDB103plus(): bool
  {
    $row = $this->dataLayer->executeRow1("show variables like 'version'");

    return (preg_match('/^10\.[34].*MariaDB$/', $row['Value'])==1);
  }
  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

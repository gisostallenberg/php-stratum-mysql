<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use PHPUnit\Framework\TestCase;

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
  protected $dataLayer;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Connects to the MySQL server.
   */
  protected function setUp(): void
  {
    $this->dataLayer = new TestMySqlDataLayer();

    $this->dataLayer->connect('localhost', 'test', 'test', 'test');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if the server is a MariaDB 10.3 or 10.4 instance.
   *
   * @return bool
   */
  protected function isMariaDB103plus(): bool
  {
    $row = $this->dataLayer->executeRow1("show variables like 'version'");

    return (preg_match('/^10\.[34].*MariaDB$/', $row['Value'])==1);
  }
  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

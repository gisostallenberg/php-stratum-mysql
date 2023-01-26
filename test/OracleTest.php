<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Stratum\MySql\Exception\MySqlConnectFailedException;
use SetBased\Stratum\MySql\Exception\MySqlDataLayerException;

/**
 * Test cases for stored routines with Pl/SQL syntax
 */
class OracleTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritDoc
   *
   * @throws MySqlDataLayerException
   * @throws MySqlConnectFailedException
   */
  public function setUp(): void
  {
    parent::setUp();

    if (!file_exists('test/psql/oracle'))
    {
      $this->markTestSkipped('Server does not have ORACLE SQL_MODE.');
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test invoking a stored function.
   *
   * @throws MySqlDataLayerException
   */
  public function testAddFunction(): void
  {
    $total = $this->dataLayer->tstOracleAddFunction(3, 5);
    self::assertSame(8, $total);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test invoking a stored procedure.
   *
   * @throws MySqlDataLayerException
   */
  public function testAddProcedure(): void
  {
    $total = $this->dataLayer->tstOracleAddProcedure(3, 5);
    self::assertSame(8, $total);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test a stored procedure selecting one row.
   *
   * @throws MySqlDataLayerException
   */
  public function testEcho(): void
  {
    $message = $this->dataLayer->tstOracleEcho('Hello, nurse!');
    self::assertSame('Hello, nurse!', $message);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test stored procedure without arguments.
   *
   * @throws MySqlDataLayerException
   */
  public function testHelloWorld(): void
  {
    $message = $this->dataLayer->tstOracleHelloWorld();
    self::assertSame('Hello, World!', $message);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


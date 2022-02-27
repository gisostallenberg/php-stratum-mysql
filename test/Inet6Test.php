<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Stratum\MySql\Exception\MySqlConnectFailedException;
use SetBased\Stratum\MySql\Exception\MySqlDataLayerException;

/**
 * Test cases for stored routines inet6 data types.
 */
class Inet6Test extends DataLayerTestCase
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

    if (!file_exists('test/psql/inet6'))
    {
      $this->markTestSkipped('Server does not have inet6 column type.');
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test invoking a stored function.
   *
   * @throws MySqlDataLayerException
   */
  public function testInet6()
  {
    $this->dataLayer->tstInet6InsertInet6('::');
    self::assertTrue(true);

    $this->dataLayer->tstInet6InsertInet6('1:2:3:4:5:6:7:8');
    self::assertTrue(true);

    $this->dataLayer->tstInet6InsertInet6('1000:2000:3000:4000:5000:6000:7000:8000');
    self::assertTrue(true);

    $this->dataLayer->tstInet6InsertInet6('::ffff:192.168.100.228');
    self::assertTrue(true);

    $this->dataLayer->tstInet6InsertInet6('');
    self::assertTrue(true);

    $this->dataLayer->tstInet6InsertInet6(null);
    self::assertTrue(true);

    $addresses = $this->dataLayer->tstInet6GetAll();
    self::assertCount(6, $addresses);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Stratum\Middle\Exception\ResultException;

/**
 * Test cases for stored routines with designation type row1 with LOBs.
 */
class Row1WithLobTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type row1 must return 1 row and 1 row only.
   */
  public function test1()
  {
    $ret = $this->dataLayer->tstTestRow1aWithLob(1, 'blob');
    self::assertIsArray($ret);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * An exception must be thrown when a stored routine with designation type row1 returns 0 rows.
   */
  public function test2()
  {
    $this->expectException(ResultException::class);
    $this->dataLayer->tstTestRow1aWithLob(0, 'blob');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * An exception must be thrown when a stored routine with designation type row1 returns more than 1 rows.
   */
  public function test3()
  {
    $this->expectException(ResultException::class);
    $this->dataLayer->tstTestRow1aWithLob(2, 'blob');
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


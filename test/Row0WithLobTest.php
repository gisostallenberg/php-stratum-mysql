<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Stratum\Middle\Exception\ResultException;

/**
 * Test cases for stored routines with designation type row0 with LOBs.
 */
class Row0WithLobTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type row0 must return null.
   */
  public function test1()
  {
    $ret = $this->dataLayer->tstTestRow0aWithLob(0, 'blob');
    self::assertNull($ret);

  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type row0 must return 1 row.
   */
  public function test2()
  {
    $ret = $this->dataLayer->tstTestRow0aWithLob(1, 'blob');
    self::assertIsArray($ret);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * An exception must be thrown when a stored routine with designation type row0 returns more than 1 rows.
   */
  public function test3()
  {
    $this->expectException(ResultException::class);
    $this->dataLayer->tstTestRow0aWithLob(2, 'blob');
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

/**
 * Test cases for stored routines with designation type rows_with_key LOBs.
 */
class RowsWithKeyWithLobTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type rows_with_key must return multi dimensional array.
   */
  public function test1()
  {
    $rows = $this->dataLayer->tstTestRowsWithKey1WithLob(100, 'blob');
    self::assertIsArray($rows);
    self::assertCount(1, $rows);

    self::assertArrayHasKey('a', $rows);
    self::assertArrayHasKey('b', $rows['a']);

    self::assertNotCount(0, $rows['a']['b']);

    self::assertArrayHasKey('c1', $rows['a']['b']);

    self::assertNotCount(0, $rows['a']['b']['c1']);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type rows_with_key must return empty array when no rwos are selected.
   */
  public function test2()
  {
    $rows = $this->dataLayer->tstTestRowsWithKey1WithLob(0, 'blob');
    self::assertIsArray($rows);
    self::assertCount(0, $rows);

  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


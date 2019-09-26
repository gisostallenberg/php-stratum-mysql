<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

/**
 * Test cases for stored routines with designation type rows_with_index with LOBs.
 */
class RowsWithIndexWithLobTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type rows_with_index must return multi dimensional array.
   */
  public function test1()
  {
    $rows = $this->dataLayer->tstTestRowsWithIndex1WithLob(100, 'blob');
    self::assertIsArray($rows);

    self::assertArrayHasKey('a', $rows);
    self::assertArrayHasKey('b', $rows['a']);

    self::assertNotCount(0, $rows['a']['b']);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type rows_with_index must return empty array when no rwos are selected.
   */
  public function test2()
  {
    $rows = $this->dataLayer->tstTestRowsWithIndex1(0);
    self::assertIsArray($rows);
    self::assertCount(0, $rows);

  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


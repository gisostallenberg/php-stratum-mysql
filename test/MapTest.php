<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

/**
 * Test cases for stored routines with designation type map.
 */
class MapTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type map must return an array.
   */
  public function test1()
  {
    $map = $this->dataLayer->tstTestMap1(100);
    self::assertIsArray($map);
    self::assertCount(3, $map);
    self::assertEquals(1, $map['c1']);
    self::assertEquals(2, $map['c2']);
    self::assertEquals(3, $map['c3']);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Stored routine with designation type map must return an empty array when no rows are selected.
   */
  public function test2()
  {
    $rows = $this->dataLayer->tstTestMap1(0);
    self::assertIsArray($rows);
    self::assertCount(0, $rows);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


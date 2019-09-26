<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

/**
 * Test cases for stored routines with designation type row0.
 */
class MultiTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test results of multi query.
   */
  public function test1()
  {
    $results = $this->dataLayer->executeMulti(file_get_contents(__DIR__.'/sql/multi_test01.sql'));

    self::assertIsArray($results);
    self::assertEquals(6, count($results));

    self::assertIsInt($results[0]);
    self::assertEquals(0, $results[0]);

    self::assertIsInt($results[1]);
    self::assertEquals(2, $results[1]);

    self::assertIsArray($results[2]);
    self::assertEquals(2, count($results[2]));

    self::assertIsInt($results[3]);
    self::assertEquals(1, $results[3]);

    self::assertIsArray($results[4]);
    self::assertEquals(1, count($results[4]));

    self::assertIsArray($results[5]);
    self::assertEquals(3, count($results[5]));
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


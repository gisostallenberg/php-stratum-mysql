<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Exception\RuntimeException;

/**
 * Test with illegal queries.
 */
class ExceptionTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @expectedException RuntimeException
   */
  public function test1()
  {
    $this->dataLayer->tstTestIllegalQuery();
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

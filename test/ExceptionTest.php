<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Stratum\MySql\Exception\MySqlQueryErrorException;

/**
 * Test with illegal queries.
 */
class ExceptionTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   */
  public function test1()
  {
    $this->expectException(MySqlQueryErrorException::class);
    $this->dataLayer->tstTestIllegalQuery();
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Stratum\MySql\Exception\MySqlDataLayerException;

/**
 * Test cases for class MySqlDataLayerException.
 */
class MySqlDataLyerExceptionTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test the form of the message of a MySqlDataLayerException.
   */
  public function testMessage(): void
  {
    $exception = new MySqlDataLayerException(123, "The is an error\nwith 2 lines", 'myMethod');
    $actual    = $exception->getMessage();
    $expected  = '
MySQL Errno: 123
Error      : The is an error
           : with 2 lines
Method     : myMethod';
    self::assertSame($expected, $actual);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

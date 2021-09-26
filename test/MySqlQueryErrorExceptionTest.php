<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Stratum\MySql\Exception\MySqlQueryErrorException;

/**
 * Test cases for class MySqlQueryErrorException.
 */
class MySqlQueryErrorExceptionTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test the form of the message of a MySqlQueryErrorException.
   */
  public function testMessage(): void
  {
    $exception = new MySqlQueryErrorException(123, "The is an error\nwith 2 lines", 'myMethod', "xelect *\nform Foo");
    $actual    = $exception->getMessage();
    $expected  = '
MySQL Errno: 123
Error      : The is an error
           : with 2 lines
Query      : xelect *
           : form Foo
Method     : myMethod';
    self::assertSame($expected, $actual);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

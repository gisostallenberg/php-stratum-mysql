<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Exception\RuntimeException;
use SetBased\Stratum\MySql\Exception\MySqlQueryErrorException;

/**
 * Test cases with max-allowed-packet.
 */
class MaxAllowedPacketTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generate test for the data Lob type different size.
   *
   * @param int $size The size of the BLOB.
   */
  public function crc32WithStoredRoutine(int $size)
  {
    $data  = '';
    $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ1234567890';
    for ($i = 0; $i<=1024; $i++)
    {
      $data .= substr($chars, rand(0, strlen($chars)), 1);
    }
    $data = substr(str_repeat($data, (int)($size / 1024 + 1024)), 0, $size);

    $crc32_php = sprintf("%u", crc32($data));

    $crc32_db = $this->dataLayer->tstTestMaxAllowedPacket($data);

    self::assertEquals($crc32_php, $crc32_db);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Calling a stored routine with a BLOB less than max_allowed_packet must not be a problem.
   */
  public function test1()
  {
    $this->crc32WithStoredRoutine((int)(0.5 * $this->dataLayer->getMaxAllowedPacket()));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Calling a stored routine with a BLOB of max_allowed_packet bytes must not be a problem.
   */
  public function test2()
  {
    $this->crc32WithStoredRoutine($this->dataLayer->getMaxAllowedPacket());
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Calling a stored routine with a BLOB of larger than max_allowed_packet bytes is not possible.
   */
  public function test4()
  {
    $this->expectException(MySqlQueryErrorException::class);
    $this->crc32WithStoredRoutine(2 * $this->dataLayer->getMaxAllowedPacket());
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Calling a stored routine with a BLOB larger than max_allowed_packet bytes is not possible.
   */
  public function xtest3()
  {
    $this->expectException(RuntimeException::class);
    $this->crc32WithStoredRoutine((int)(1.05 * $this->dataLayer->getMaxAllowedPacket()));
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------


<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

/**
 * Test cases for PHP parameter names.
 */
class ParameterTypeTest extends DataLayerTestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test parameter names.
   */
  public function test1()
  {
    $reflection_class  = new \ReflectionClass(TestDataLayer::class);
    $reflection_method = $reflection_class->getMethod('tstTestParameterType');

    $doc_block = $reflection_method->getDocComment();

    self::assertStringContainsString('@param int|float|string|null $pPhpType1', $doc_block);
    self::assertStringContainsString('@param int|float|string|null $pPhpType2', $doc_block);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

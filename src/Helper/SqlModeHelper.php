<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Helper;

use SetBased\Stratum\MySql\Exception\MySqlQueryErrorException;
use SetBased\Stratum\MySql\MySqlMetaDataLayer;

/**
 * Helper class for handling the SQL mode of the MySQL instance.
 */
class SqlModeHelper
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The canonical SQL mode.
   *
   * @var string
   */
  private $canonicalSqlMode;

  /**
   * The metadata layer.
   *
   * @var MySqlMetaDataLayer
   */
  private $dl;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param MySqlMetaDataLayer $dl      The metadata layer.
   * @param string             $sqlMode The SQL mode.
   *
   * @throws MySqlQueryErrorException
   */
  public function __construct(MySqlMetaDataLayer $dl, string $sqlMode)
  {
    $this->dl = $dl;

    $this->dl->setSqlMode($sqlMode);
    $this->canonicalSqlMode = $this->dl->getCanonicalSqlMode($sqlMode);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the canonical SQL mode.
   *
   * @return string
   */
  public function getCanonicalSqlMode(): string
  {
    return $this->canonicalSqlMode;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

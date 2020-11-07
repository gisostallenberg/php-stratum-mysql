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
   * The canonical SQL mode with ORACLE.
   *
   * @var ?string
   */
  private $canonicalSqlModeWithOracle = null;

  /**
   * The current SQL mode (also in canonical order).
   *
   * @var string
   */
  private $currentSqlMode;

  /**
   * The metadata layer.
   *
   * @var MySqlMetaDataLayer
   */
  private $dl;

  /**
   * True if and only if the MySQL instance has ORACLE SQL mode.
   *
   * @var bool|null
   */
  private $hasOracleMode;

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

    try
    {
      $this->dl->setSqlMode('ORACLE');
      $this->hasOracleMode = true;
    }
    catch (MySqlQueryErrorException $e)
    {
      $this->hasOracleMode = false;
    }

    if ($this->hasOracleMode)
    {
      $parts   = explode(',', $sqlMode);
      $parts[] = 'ORACLE';
      $this->dl->setSqlMode(implode(',', $parts));
      $this->canonicalSqlModeWithOracle = $this->dl->getCanonicalSqlMode();
    }

    $this->dl->setSqlMode($sqlMode);
    $this->canonicalSqlMode = $this->dl->getCanonicalSqlMode();
    $this->currentSqlMode   = $this->canonicalSqlMode;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Adds ORACLE too the current SQL_MODE if the initial SQL_MODE did not include ORACLE.
   *
   * @throws MySqlQueryErrorException
   */
  public function addIfRequiredOracleMode(): void
  {
    if ($this->currentSqlMode!==$this->canonicalSqlModeWithOracle)
    {
      $this->dl->setSqlMode($this->canonicalSqlModeWithOracle);
      $this->currentSqlMode = $this->canonicalSqlModeWithOracle;
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Compares a SQL mode with the current SQL mode with or without ORACLE when appropriate.
   *
   * @param string $sqlMode The SQL mode.
   *
   * @return bool
   */
  public function compare(string $sqlMode): bool
  {
    $parts = explode(',', $sqlMode);
    if (in_array('ORACLE', $parts))
    {
      return ($sqlMode===$this->canonicalSqlModeWithOracle);
    }

    return ($sqlMode===$this->canonicalSqlMode);
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
  /**
   * Returns the canonical SQL mode.
   *
   * @return string
   */
  public function getCanonicalSqlModeWithOracle(): string
  {
    return $this->canonicalSqlModeWithOracle;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if and only if the MySQL instance has ORACLE SQL mode.
   *
   * @return bool
   */
  public function hasOracleMode(): bool
  {
    return $this->hasOracleMode;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Removes ORACLE from the current SQL_MODE if the initial SQL_MODE did not include ORACLE.
   *
   * @throws MySqlQueryErrorException
   */
  public function removeIfRequiredOracleMode(): void
  {
    if ($this->currentSqlMode!==$this->canonicalSqlMode)
    {
      $this->dl->setSqlMode($this->canonicalSqlMode);
      $this->currentSqlMode = $this->canonicalSqlMode;
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

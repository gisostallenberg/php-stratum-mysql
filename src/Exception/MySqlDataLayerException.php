<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Exception;

use SetBased\Stratum\Middle\Exception\DataLayerException;

/**
 * Exception for situations where the execution of s SQL query has failed.
 */
class MySqlDataLayerException extends \RuntimeException implements DataLayerException
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The error code value of the error ($mysqli->errno).
   *
   * @var int
   */
  protected $errno;

  /**
   * Description of the last error ($mysqli->error).
   *
   * @var string
   */
  protected $error;

  /**
   * The method.
   *
   * @var string
   */
  protected $method;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param int    $errno  The error code value of the error ($mysqli->errno).
   * @param string $error  Description of the last error ($mysqli->error).
   * @param string $method The name of the executed method.
   */
  public function __construct(int $errno, string $error, string $method)
  {
    parent::__construct(self::message($errno, $error, $method));

    $this->errno  = $errno;
    $this->error  = $error;
    $this->method = $method;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Composes the exception message.
   *
   * @param int    $errno  The error code value of the error ($mysqli->errno).
   * @param string $error  Description of the error ($mysqli->error).
   * @param string $method The name of the executed method.
   *
   * @return string
   */
  private static function message(int $errno, string $error, string $method): string
  {
    $message = 'MySQL Error no: '.$errno."\n";
    $message .= $error."\n";
    $message .= 'Failed method: '.$method;

    return $message;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the error code of the error
   *
   * @return int
   */
  public function getErrno(): int
  {
    return $this->errno;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the description of the error.
   *
   * @return string
   */
  public function getError(): string
  {
    return $this->error;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritdoc
   */
  public function getName()
  {
    return 'MySQL Error';
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

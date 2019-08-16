<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use SetBased\Stratum\Exception\ResultException;
use SetBased\Stratum\MySql\StaticDataLayer;

/**
 * The data layer.
 */
class TestDataLayer extends StaticDataLayer
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for magic constant.
   *
   * @return string
   */
  public static function tstMagicConstant01(): string
  {
    return self::executeSingleton1('call tst_magic_constant01()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for magic constant.
   *
   * @return int
   */
  public static function tstMagicConstant02(): int
  {
    return self::executeSingleton1('call tst_magic_constant02()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for magic constant.
   *
   * @return string
   */
  public static function tstMagicConstant03(): string
  {
    return self::executeSingleton1('call tst_magic_constant03()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for magic constant.
   *
   * @return string
   */
  public static function tstMagicConstant04(): string
  {
    return self::executeSingleton1('call tst_magic_constant04()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for magic constant.
   *
   * @return string
   */
  public static function tstMagicConstant05(): string
  {
    return self::executeSingleton1('call tst_magic_constant05()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for all possible types of parameters excluding LOB's.
   *
   * @param int|null              $pTstInt               Parameter of type int.
   *                                                     int(11)
   * @param int|null              $pTstSmallint          Parameter of type smallint.
   *                                                     smallint(6)
   * @param int|null              $pTstTinyint           Parameter of type tinyint.
   *                                                     tinyint(4)
   * @param int|null              $pTstMediumint         Parameter of type mediumint.
   *                                                     mediumint(9)
   * @param int|null              $pTstBigint            Parameter of type bigint.
   *                                                     bigint(20)
   * @param int|null              $pTstIntUnsigned       Parameter of type int unsigned.
   *                                                     int(10) unsigned
   * @param int|null              $pTstSmallintUnsigned  Parameter of type smallint unsigned.
   *                                                     smallint(5) unsigned
   * @param int|null              $pTstTinyintUnsigned   Parameter of type tinyint unsigned.
   *                                                     tinyint(3) unsigned
   * @param int|null              $pTstMediumintUnsigned Parameter of type mediumint unsigned.
   *                                                     mediumint(8) unsigned
   * @param int|null              $pTstBigintUnsigned    Parameter of type bigint unsigned.
   *                                                     bigint(20) unsigned
   * @param int|float|string|null $pTstDecimal           Parameter of type decimal.
   *                                                     decimal(10,2)
   * @param int|float|string|null $pTstDecimal0          Parameter of type decimal with 0 scale.
   *                                                     decimal(65,0)
   * @param float|null            $pTstFloat             Parameter of type float.
   *                                                     float
   * @param float|null            $pTstDouble            Parameter of type double.
   *                                                     double
   * @param string|null           $pTstBit               Parameter of type bit.
   *                                                     bit(8)
   * @param string|null           $pTstDate              Parameter of type date.
   *                                                     date
   * @param string|null           $pTstDatetime          Parameter of type datetime.
   *                                                     datetime
   * @param string|null           $pTstTimestamp         Parameter of type timestamp.
   *                                                     timestamp
   * @param string|null           $pTstTime              Parameter of type time.
   *                                                     time
   * @param int|null              $pTstYear              Parameter of type year.
   *                                                     year(4)
   * @param string|null           $pTstChar              Parameter of type char.
   *                                                     char(10) character set utf8 collation utf8_general_ci
   * @param string|null           $pTstVarchar           Parameter of type varchar.
   *                                                     varchar(10) character set utf8 collation utf8_general_ci
   * @param string|null           $pTstBinary            Parameter of type binary.
   *                                                     binary(10)
   * @param string|null           $pTstVarbinary         Parameter of type varbinary.
   *                                                     varbinary(10)
   * @param string|null           $pTstEnum              Parameter of type enum.
   *                                                     enum('a','b') character set utf8 collation utf8_general_ci
   * @param string|null           $pTstSet               Parameter of type set.
   *                                                     set('a','b') character set utf8 collation utf8_general_ci
   *
   * @return int
   */
  public static function tstTest01(?int $pTstInt, ?int $pTstSmallint, ?int $pTstTinyint, ?int $pTstMediumint, ?int $pTstBigint, ?int $pTstIntUnsigned, ?int $pTstSmallintUnsigned, ?int $pTstTinyintUnsigned, ?int $pTstMediumintUnsigned, ?int $pTstBigintUnsigned, $pTstDecimal, $pTstDecimal0, ?float $pTstFloat, ?float $pTstDouble, ?string $pTstBit, ?string $pTstDate, ?string $pTstDatetime, ?string $pTstTimestamp, ?string $pTstTime, ?int $pTstYear, ?string $pTstChar, ?string $pTstVarchar, ?string $pTstBinary, ?string $pTstVarbinary, ?string $pTstEnum, ?string $pTstSet): int
  {
    return self::executeNone('call tst_test01('.self::quoteInt($pTstInt).','.self::quoteInt($pTstSmallint).','.self::quoteInt($pTstTinyint).','.self::quoteInt($pTstMediumint).','.self::quoteInt($pTstBigint).','.self::quoteInt($pTstIntUnsigned).','.self::quoteInt($pTstSmallintUnsigned).','.self::quoteInt($pTstTinyintUnsigned).','.self::quoteInt($pTstMediumintUnsigned).','.self::quoteInt($pTstBigintUnsigned).','.self::quoteDecimal($pTstDecimal).','.self::quoteDecimal($pTstDecimal0).','.self::quoteFloat($pTstFloat).','.self::quoteFloat($pTstDouble).','.self::quoteBit($pTstBit).','.self::quoteString($pTstDate).','.self::quoteString($pTstDatetime).','.self::quoteString($pTstTimestamp).','.self::quoteString($pTstTime).','.self::quoteInt($pTstYear).','.self::quoteString($pTstChar).','.self::quoteString($pTstVarchar).','.self::quoteBinary($pTstBinary).','.self::quoteBinary($pTstVarbinary).','.self::quoteString($pTstEnum).','.self::quoteString($pTstSet).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for all possible types of parameters including LOB's.
   *
   * @param int|null              $pTstInt        Parameter of type int.
   *                                              int(11)
   * @param int|null              $pTstSmallint   Parameter of type smallint.
   *                                              smallint(6)
   * @param int|null              $pTstTinyint    Parameter of type tinyint.
   *                                              tinyint(4)
   * @param int|null              $pTstMediumint  Parameter of type mediumint.
   *                                              mediumint(9)
   * @param int|null              $pTstBigint     Parameter of type bigint.
   *                                              bigint(20)
   * @param int|float|string|null $pTstDecimal    Parameter of type decimal.
   *                                              decimal(10,2)
   * @param int|float|string|null $pTstDecimal0   Parameter of type decimal with 0 scale.
   *                                              decimal(65,0)
   * @param float|null            $pTstFloat      Parameter of type float.
   *                                              float
   * @param float|null            $pTstDouble     Parameter of type double.
   *                                              double
   * @param string|null           $pTstBit        Parameter of type bit.
   *                                              bit(8)
   * @param string|null           $pTstDate       Parameter of type date.
   *                                              date
   * @param string|null           $pTstDatetime   Parameter of type datetime.
   *                                              datetime
   * @param string|null           $pTstTimestamp  Parameter of type timestamp.
   *                                              timestamp
   * @param string|null           $pTstTime       Parameter of type time.
   *                                              time
   * @param int|null              $pTstYear       Parameter of type year.
   *                                              year(4)
   * @param string|null           $pTstChar       Parameter of type char.
   *                                              char(10) character set utf8 collation utf8_general_ci
   * @param string|null           $pTstVarchar    Parameter of type varchar.
   *                                              varchar(10) character set utf8 collation utf8_general_ci
   * @param string|null           $pTstBinary     Parameter of type binary.
   *                                              binary(10)
   * @param string|null           $pTstVarbinary  Parameter of type varbinary.
   *                                              varbinary(10)
   * @param string|null           $pTstTinyblob   Parameter of type tinyblob.
   *                                              tinyblob
   * @param string|null           $pTstBlob       Parameter of type blob.
   *                                              blob
   * @param string|null           $pTstMediumblob Parameter of type mediumblob.
   *                                              mediumblob
   * @param string|null           $pTstLongblob   Parameter of type longblob.
   *                                              longblob
   * @param string|null           $pTstTinytext   Parameter of type tinytext.
   *                                              tinytext character set utf8 collation utf8_general_ci
   * @param string|null           $pTstText       Parameter of type text.
   *                                              text character set utf8 collation utf8_general_ci
   * @param string|null           $pTstMediumtext Parameter of type mediumtext.
   *                                              mediumtext character set utf8 collation utf8_general_ci
   * @param string|null           $pTstLongtext   Parameter of type longtext.
   *                                              longtext character set utf8 collation utf8_general_ci
   * @param string|null           $pTstEnum       Parameter of type enum.
   *                                              enum('a','b') character set utf8 collation utf8_general_ci
   * @param string|null           $pTstSet        Parameter of type set.
   *                                              set('a','b') character set utf8 collation utf8_general_ci
   *
   * @return int
   */
  public static function tstTest02(?int $pTstInt, ?int $pTstSmallint, ?int $pTstTinyint, ?int $pTstMediumint, ?int $pTstBigint, $pTstDecimal, $pTstDecimal0, ?float $pTstFloat, ?float $pTstDouble, ?string $pTstBit, ?string $pTstDate, ?string $pTstDatetime, ?string $pTstTimestamp, ?string $pTstTime, ?int $pTstYear, ?string $pTstChar, ?string $pTstVarchar, ?string $pTstBinary, ?string $pTstVarbinary, ?string $pTstTinyblob, ?string $pTstBlob, ?string $pTstMediumblob, ?string $pTstLongblob, ?string $pTstTinytext, ?string $pTstText, ?string $pTstMediumtext, ?string $pTstLongtext, ?string $pTstEnum, ?string $pTstSet)
  {
    $query = 'call tst_test02('.self::quoteInt($pTstInt).','.self::quoteInt($pTstSmallint).','.self::quoteInt($pTstTinyint).','.self::quoteInt($pTstMediumint).','.self::quoteInt($pTstBigint).','.self::quoteDecimal($pTstDecimal).','.self::quoteDecimal($pTstDecimal0).','.self::quoteFloat($pTstFloat).','.self::quoteFloat($pTstDouble).','.self::quoteBit($pTstBit).','.self::quoteString($pTstDate).','.self::quoteString($pTstDatetime).','.self::quoteString($pTstTimestamp).','.self::quoteString($pTstTime).','.self::quoteInt($pTstYear).','.self::quoteString($pTstChar).','.self::quoteString($pTstVarchar).','.self::quoteBinary($pTstBinary).','.self::quoteBinary($pTstVarbinary).',?,?,?,?,?,?,?,?,'.self::quoteString($pTstEnum).','.self::quoteString($pTstSet).')';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('bbbbbbbb', $null, $null, $null, $null, $null, $null, $null, $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pTstTinyblob);
    self::sendLongData($stmt, 1, $pTstBlob);
    self::sendLongData($stmt, 2, $pTstMediumblob);
    self::sendLongData($stmt, 3, $pTstLongblob);
    self::sendLongData($stmt, 4, $pTstTinytext);
    self::sendLongData($stmt, 5, $pTstText);
    self::sendLongData($stmt, 6, $pTstMediumtext);
    self::sendLongData($stmt, 7, $pTstLongtext);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $ret = self::$mysqli->affected_rows;

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation bulk_insert.
   *
   * @param array[] $rows The rows that must inserted.
   *
   * @return void
   */
  public static function tstTestBulkInsert01(?array $rows): void
  {
    self::realQuery('call tst_test_bulk_insert01()');
    if (is_array($rows) && !empty($rows))
    {
      $sql = "INSERT INTO `TST_TEMPO`(`tst_int`,`tst_smallint`,`tst_mediumint`,`tst_tinyint`,`tst_bigint`,`tst_int_unsigned`,`tst_smallint_unsigned`,`tst_mediumint_unsigned`,`tst_tinyint_unsigned`,`tst_bigint_unsigned`,`tst_year`,`tst_decimal`,`tst_decimal0`,`tst_float`,`tst_double`,`tst_binary`,`tst_varbinary`,`tst_char`,`tst_varchar`,`tst_time`,`tst_timestamp`,`tst_date`,`tst_datetime`,`tst_enum`,`tst_set`,`tst_bit`)";
      $first = true;
      foreach($rows as $row)
      {
        if ($first) $sql .=' values('.self::quoteInt($row['field_int']).','.self::quoteInt($row['field_smallint']).','.self::quoteInt($row['field_mediumint']).','.self::quoteInt($row['field_tinyint']).','.self::quoteInt($row['field_bigint']).','.self::quoteInt($row['field_int_unsigned']).','.self::quoteInt($row['field_smallint_unsigned']).','.self::quoteInt($row['field_mediumint_unsigned']).','.self::quoteInt($row['field_tinyint_unsigned']).','.self::quoteInt($row['field_bigint_unsigned']).','.self::quoteInt($row['field_year']).','.self::quoteDecimal($row['field_decimal']).','.self::quoteDecimal($row['field_decimal0']).','.self::quoteFloat($row['field_float']).','.self::quoteFloat($row['field_double']).','.self::quoteBinary($row['field_binary']).','.self::quoteBinary($row['field_varbinary']).','.self::quoteString($row['field_char']).','.self::quoteString($row['field_varchar']).','.self::quoteString($row['field_time']).','.self::quoteString($row['field_timestamp']).','.self::quoteString($row['field_date']).','.self::quoteString($row['field_datetime']).','.self::quoteString($row['field_enum']).','.self::quoteString($row['field_set']).','.self::quoteBit($row['field_bit']).')';
        else        $sql .=',      ('.self::quoteInt($row['field_int']).','.self::quoteInt($row['field_smallint']).','.self::quoteInt($row['field_mediumint']).','.self::quoteInt($row['field_tinyint']).','.self::quoteInt($row['field_bigint']).','.self::quoteInt($row['field_int_unsigned']).','.self::quoteInt($row['field_smallint_unsigned']).','.self::quoteInt($row['field_mediumint_unsigned']).','.self::quoteInt($row['field_tinyint_unsigned']).','.self::quoteInt($row['field_bigint_unsigned']).','.self::quoteInt($row['field_year']).','.self::quoteDecimal($row['field_decimal']).','.self::quoteDecimal($row['field_decimal0']).','.self::quoteFloat($row['field_float']).','.self::quoteFloat($row['field_double']).','.self::quoteBinary($row['field_binary']).','.self::quoteBinary($row['field_varbinary']).','.self::quoteString($row['field_char']).','.self::quoteString($row['field_varchar']).','.self::quoteString($row['field_time']).','.self::quoteString($row['field_timestamp']).','.self::quoteString($row['field_date']).','.self::quoteString($row['field_datetime']).','.self::quoteString($row['field_enum']).','.self::quoteString($row['field_set']).','.self::quoteBit($row['field_bit']).')';
        $first = false;
      }
      self::realQuery($sql);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation bulk_insert.
   *
   * @param array[] $rows The rows that must inserted.
   *
   * @return void
   */
  public static function tstTestBulkInsert02(?array $rows): void
  {
    self::realQuery('call tst_test_bulk_insert02()');
    if (is_array($rows) && !empty($rows))
    {
      $sql = "INSERT INTO `TST_TEMPO`(`tst_col1`,`tst_col4`,`tst_col5`)";
      $first = true;
      foreach($rows as $row)
      {
        if ($first) $sql .=' values('.self::quoteInt($row['field1']).','.self::quoteInt($row['field4']).','.self::quoteInt($row['field5']).')';
        else        $sql .=',      ('.self::quoteInt($row['field1']).','.self::quoteInt($row['field4']).','.self::quoteInt($row['field5']).')';
        $first = false;
      }
      self::realQuery($sql);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for stored function wrapper.
   *
   * @param int|null $pA Parameter A.
   *                     int(11)
   * @param int|null $pB Parameter B.
   *                     int(11)
   *
   * @return int|null
   */
  public static function tstTestFunction(?int $pA, ?int $pB): ?int
  {
    return self::executeSingleton0('select tst_test_function('.self::quoteInt($pA).','.self::quoteInt($pB).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for stored function with return type bool wrapper.
   *
   * @param int|null $pRet The return value.
   *                       int(11)
   *
   * @return bool
   */
  public static function tstTestFunctionBool1(?int $pRet): bool
  {
    return !empty(self::executeSingleton0('select tst_test_function_bool1('.self::quoteInt($pRet).')'));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for stored function with return type bool wrapper.
   *
   * @param string|null $pRet The return value.
   *                          varchar(8) character set utf8 collation utf8_general_ci
   *
   * @return bool
   */
  public static function tstTestFunctionBool2(?string $pRet): bool
  {
    return !empty(self::executeSingleton0('select tst_test_function_bool2('.self::quoteString($pRet).')'));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for illegal query.
   *
   * @return array[]
   */
  public static function tstTestIllegalQuery(): array
  {
    return self::executeRows('call tst_test_illegal_query()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *
   * @param string|int[]|null $pIds The id's in CSV format.
   *                                varchar(255) character set utf8 collation utf8_general_ci
   *
   * @return array[]
   */
  public static function tstTestListOfInt($pIds): array
  {
    $result = self::query('call tst_test_list_of_int('.self::quoteListOfInt($pIds, ',', '\"', '\\').')');
    $ret = [];
    while (($row = $result->fetch_array(MYSQLI_ASSOC))) $ret[$row['tst_id']] = $row;
    $result->free();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type log.
   *
   * @return int
   */
  public static function tstTestLog(): int
  {
    return self::executeLog('call tst_test_log()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type map.
   *
   * @param int|null $pCount Number of rows selected.
   *                         int(11)
   *
   * @return array
   */
  public static function tstTestMap1(?int $pCount): array
  {
    $result = self::query('call tst_test_map1('.self::quoteInt($pCount).')');
    $ret = [];
    while (($row = $result->fetch_array(MYSQLI_NUM))) $ret[$row[0]] = $row[1];
    $result->free();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type rows_with_key with BLOB.
   *
   * @param int|null    $pCount Number of rows selected.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return array
   */
  public static function tstTestMap1WithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_map1_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $result = $stmt->get_result();
    $ret = [];
    while (($row = $result->fetch_array(MYSQLI_NUM))) $ret[$row[0]] = $row[1];
    $result->free();

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for sending data larger than max_allowed_packet.
   *
   * @param string|null $pTmpBlob The BLOB larger than max_allowed_packet.
   *                              longblob
   *
   * @return int
   */
  public static function tstTestMaxAllowedPacket(?string $pTmpBlob)
  {
    $query = 'call tst_test_max_allowed_packet(?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pTmpBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $value)
      {
        $new[] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');
    if (count($tmp)!=1) throw new ResultException('1', count($tmp), $query);

    return $tmp[0][0];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   *
   * @return array
   */
  public static function tstTestNoDocBlock(): array
  {
    return self::executeRow1('call tst_test_no_doc_block()');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type none.
   *
   * @param int|null $pCount The number of iterations.
   *                         bigint(20)
   *
   * @return int
   */
  public static function tstTestNone(?int $pCount): int
  {
    return self::executeNone('call tst_test_none('.self::quoteInt($pCount).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type none with BLOB.
   *
   * @param int|null    $pCount The number of iterations.
   *                            bigint(20)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return int
   */
  public static function tstTestNoneWithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_none_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $ret = self::$mysqli->affected_rows;

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for conversion of MySQL types to PHP types.
   *
   * @param int|float|string|null $pPhpType1 Must be converted to PHP type string in the TestDataLayer.
   *                                         decimal(10,2)
   * @param int|float|string|null $pPhpType2 Must be converted to PHP type string in the TestDataLayer.
   *                                         decimal(65,0)
   *
   * @return int
   */
  public static function tstTestParameterType($pPhpType1, $pPhpType2): int
  {
    return self::executeNone('call tst_test_parameter_type('.self::quoteDecimal($pPhpType1).','.self::quoteDecimal($pPhpType2).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type row0.
   *
   * @param int|null $pCount The number of rows selected. * 0 For a valid test. * 1 For a valid test. * 2 For a invalid test.
   *                         int(11)
   *
   * @return array|null
   */
  public static function tstTestRow0a(?int $pCount): ?array
  {
    return self::executeRow0('call tst_test_row0a('.self::quoteInt($pCount).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type row0 with BLOB.
   *
   * @param int|null    $pCount The number of rows selected. * 0 For a valid test. * 1 For a valid test. * 2 For a invalid test.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return array|null
   */
  public static function tstTestRow0aWithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_row0a_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $key => $value)
      {
        $new[$key] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');
    if (count($tmp)>1) throw new ResultException('0 or 1', count($tmp), $query);

    return ($tmp) ? $tmp[0] : null;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type row1.
   *
   * @param int|null $pCount The number of rows selected. * 0 For a invalid test. * 1 For a valid test. * 2 For a invalid test.
   *                         int(11)
   *
   * @return array
   */
  public static function tstTestRow1a(?int $pCount): array
  {
    return self::executeRow1('call tst_test_row1a('.self::quoteInt($pCount).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type row1 with BLOB.
   *
   * @param int|null    $pCount The number of rows selected. * 0 For a invalid test. * 1 For a valid test. * 2 For a invalid test.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return array
   */
  public static function tstTestRow1aWithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_row1a_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $key => $value)
      {
        $new[$key] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');
    if (count($tmp)!=1) throw new ResultException('1', count($tmp), $query);

    return $row;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type rows.
   *
   * @param int|null $pCount The number of rows selected.
   *                         int(11)
   *
   * @return array[]
   */
  public static function tstTestRows1(?int $pCount): array
  {
    return self::executeRows('call tst_test_rows1('.self::quoteInt($pCount).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type rows.
   *
   * @param int|null    $pCount The number of rows selected.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return array[]
   */
  public static function tstTestRows1WithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_rows1_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $key => $value)
      {
        $new[$key] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');

    return $tmp;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type rows_with_index.
   *
   * @param int|null $pCount The number of rows selected.
   *                         int(11)
   *
   * @return array[]
   */
  public static function tstTestRowsWithIndex1(?int $pCount): array
  {
    $result = self::query('call tst_test_rows_with_index1('.self::quoteInt($pCount).')');
    $ret = [];
    while (($row = $result->fetch_array(MYSQLI_ASSOC))) $ret[$row['tst_c01']][$row['tst_c02']][] = $row;
    $result->free();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type rows_with_index with BLOB..
   *
   * @param int|null    $pCount The number of rows selected.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return array[]
   */
  public static function tstTestRowsWithIndex1WithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_rows_with_index1_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $ret = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $key => $value)
      {
        $new[$key] = $value;
      }
      $ret[$new['tst_c01']][$new['tst_c02']][] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type rows_with_key.
   *
   * @param int|null $pCount Number of rows selected.
   *                         int(11)
   *
   * @return array[]
   */
  public static function tstTestRowsWithKey1(?int $pCount): array
  {
    $result = self::query('call tst_test_rows_with_key1('.self::quoteInt($pCount).')');
    $ret = [];
    while (($row = $result->fetch_array(MYSQLI_ASSOC))) $ret[$row['tst_c01']][$row['tst_c02']][$row['tst_c03']] = $row;
    $result->free();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type rows_with_key with BLOB.
   *
   * @param int|null    $pCount The number of rows selected.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return array[]
   */
  public static function tstTestRowsWithKey1WithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_rows_with_key1_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $ret = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $key => $value)
      {
        $new[$key] = $value;
      }
      $ret[$new['tst_c01']][$new['tst_c02']][$new['tst_c03']] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton0.
   *
   * @param int|null $pCount The number of rows selected. * 0 For a valid test. * 1 For a valid test. * 2 For a invalid test.
   *                         int(11)
   *
   * @return int|null
   */
  public static function tstTestSingleton0a(?int $pCount): ?int
  {
    return self::executeSingleton0('call tst_test_singleton0a('.self::quoteInt($pCount).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton0 with BLOB..
   *
   * @param int|null    $pCount The number of rows selected. * 0 For a valid test. * 1 For a valid test. * 2 For a invalid test.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return int|null
   */
  public static function tstTestSingleton0aWithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_singleton0a_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $value)
      {
        $new[] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');
    if (count($tmp)>1) throw new ResultException('0 or 1', count($tmp), $query);

    return $tmp[0][0] ?? null;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton0 with return type bool.
   *
   * @param int|null $pCount The number of rows selected. * 0 For a valid test. * 1 For a valid test. * 2 For a invalid test.
   *                         int(11)
   * @param int|null $pValue The selected value.
   *                         int(11)
   *
   * @return bool
   */
  public static function tstTestSingleton0b(?int $pCount, ?int $pValue): bool
  {
    return !empty(self::executeSingleton0('call tst_test_singleton0b('.self::quoteInt($pCount).','.self::quoteInt($pValue).')'));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton0 with BLOB..
   *
   * @param int|null    $pCount The number of rows selected. * 0 For a valid test. * 1 For a valid test. * 2 For a invalid test.
   *                            int(11)
   * @param int|null    $pValue The selected value.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return bool
   */
  public static function tstTestSingleton0bWithLob(?int $pCount, ?int $pValue, ?string $pBlob)
  {
    $query = 'call tst_test_singleton0b_with_lob('.self::quoteInt($pCount).','.self::quoteInt($pValue).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $value)
      {
        $new[] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');
    if (count($tmp)>1) throw new ResultException('0 or 1', count($tmp), $query);

    return !empty($tmp[0][0]);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton1.
   *
   * @param int|null $pCount The number of rows selected. * 0 For a invalid test. * 1 For a valid test. * 2 For a invalid test.
   *                         int(11)
   *
   * @return int
   */
  public static function tstTestSingleton1a(?int $pCount): int
  {
    return self::executeSingleton1('call tst_test_singleton1a('.self::quoteInt($pCount).')');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton1 with BLOB.
   *
   * @param int|null    $pCount The number of rows selected. * 0 For a invalid test. * 1 For a valid test. * 2 For a invalid test.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return int
   */
  public static function tstTestSingleton1aWithLob(?int $pCount, ?string $pBlob)
  {
    $query = 'call tst_test_singleton1a_with_lob('.self::quoteInt($pCount).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $value)
      {
        $new[] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');
    if (count($tmp)!=1) throw new ResultException('1', count($tmp), $query);

    return $tmp[0][0];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton1 with return type bool.
   *
   * @param int|null $pCount The number of rows selected. * 0 For a invalid test. * 1 For a valid test. * 2 For a invalid test.
   *                         int(11)
   * @param int|null $pValue The selected value.
   *                         int(11)
   *
   * @return bool
   */
  public static function tstTestSingleton1b(?int $pCount, ?int $pValue): bool
  {
    return !empty(self::executeSingleton1('call tst_test_singleton1b('.self::quoteInt($pCount).','.self::quoteInt($pValue).')'));
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type singleton1 with BLOB.
   *
   * @param int|null    $pCount The number of rows selected. * 0 For a invalid test. * 1 For a valid test. * 2 For a invalid test.
   *                            int(11)
   * @param int|null    $pValue The selected value.
   *                            int(11)
   * @param string|null $pBlob  The BLOB.
   *                            blob
   *
   * @return bool
   */
  public static function tstTestSingleton1bWithLob(?int $pCount, ?int $pValue, ?string $pBlob)
  {
    $query = 'call tst_test_singleton1b_with_lob('.self::quoteInt($pCount).','.self::quoteInt($pValue).',?)';
    $stmt  = self::$mysqli->prepare($query);
    if (!$stmt) self::mySqlError('mysqli::prepare');

    $null = null;
    $b = $stmt->bind_param('b', $null);
    if (!$b) self::mySqlError('mysqli_stmt::bind_param');

    self::getMaxAllowedPacket();

    self::sendLongData($stmt, 0, $pBlob);

    if (self::$logQueries)
    {
      $time0 = microtime(true);

      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');

      self::$queryLog[] = ['query' => $query,
                           'time'  => microtime(true) - $time0];
    }
    else
    {
      $b = $stmt->execute();
      if (!$b) self::mySqlError('mysqli_stmt::execute');
    }

    $row = [];
    self::bindAssoc($stmt, $row);

    $tmp = [];
    while (($b = $stmt->fetch()))
    {
      $new = [];
      foreach($row as $value)
      {
        $new[] = $value;
      }
      $tmp[] = $new;
    }

    $stmt->close();
    if (self::$mysqli->more_results()) self::$mysqli->next_result();

    if ($b===false) self::mySqlError('mysqli_stmt::fetch');
    if (count($tmp)!=1) throw new ResultException('1', count($tmp), $query);

    return !empty($tmp[0][0]);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test for designation type table.
   *
   * @return int
   */
  public static function tstTestTable(): int
  {
    return self::executeTable('call tst_test_table()');
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

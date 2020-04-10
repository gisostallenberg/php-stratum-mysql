<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Wrapper;

use SetBased\Exception\FallenException;
use SetBased\Helper\CodeStore\PhpCodeStore;
use SetBased\Stratum\Middle\Exception\ResultException;
use SetBased\Stratum\Middle\NameMangler\NameMangler;
use SetBased\Stratum\MySql\Exception\MySqlDataLayerException;
use SetBased\Stratum\MySql\Exception\MySqlQueryErrorException;
use SetBased\Stratum\MySql\Helper\DataTypeHelper;

/**
 * Abstract parent class for all wrapper generators.
 */
abstract class Wrapper
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The code store for the generated PHP code.
   *
   * @var PhpCodeStore
   */
  protected $codeStore;

  /**
   * Array with fully qualified names that must be imported for this wrapper method.
   *
   * @var array
   */
  protected $imports = [];

  /**
   * The name mangler for wrapper and parameter names.
   *
   * @var NameMangler
   */
  protected $nameMangler;

  /**
   * The metadata of the stored routine.
   *
   * @var array
   */
  protected $routine;

  /**
   * @var bool If true BLOBs and CLOBs must be treated as strings.
   */
  private $lobAsStringFlag;

  /**
   * The exceptions that the wrapper can throw.
   *
   * @var string[]
   */
  private $throws;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param array        $routine     The metadata of the stored routine.
   * @param PhpCodeStore $codeStore   The code store for the generated code.
   * @param NameMangler  $nameMangler The mangler for wrapper and parameter names.
   * @param bool         $lobAsString If set BLOBs and CLOBs are treated as string. Otherwise, BLOBs and CLOBs will be
   *                                  send as long data.
   */
  public function __construct(array $routine, PhpCodeStore $codeStore, NameMangler $nameMangler, bool $lobAsString)
  {
    $this->routine         = $routine;
    $this->codeStore       = $codeStore;
    $this->nameMangler     = $nameMangler;
    $this->lobAsStringFlag = $lobAsString;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * A factory for creating the appropriate object for generating a wrapper method for a stored routine.
   *
   * @param array        $routine     The metadata of the stored routine.
   * @param PhpCodeStore $codeStore   The code store for the generated code.
   * @param NameMangler  $nameMangler The mangler for wrapper and parameter names.
   * @param bool         $lobAsString If set BLOBs and CLOBs are treated as string. Otherwise, BLOBs and CLOBs will be
   *                                  send as long data.
   *
   * @return Wrapper
   */
  public static function createRoutineWrapper(array $routine,
                                              PhpCodeStore $codeStore,
                                              NameMangler $nameMangler,
                                              bool $lobAsString): Wrapper
  {
    switch ($routine['designation'])
    {
      case 'bulk':
        $wrapper = new BulkWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'bulk_insert':
        $wrapper = new BulkInsertWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'log':
        $wrapper = new LogWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'map':
        $wrapper = new MapWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'none':
        $wrapper = new NoneWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'row0':
        $wrapper = new Row0Wrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'row1':
        $wrapper = new Row1Wrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'rows':
        $wrapper = new RowsWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'rows_with_key':
        $wrapper = new RowsWithKeyWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'rows_with_index':
        $wrapper = new RowsWithIndexWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'singleton0':
        $wrapper = new Singleton0Wrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'singleton1':
        $wrapper = new Singleton1Wrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'function':
        $wrapper = new FunctionWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      case 'table':
        $wrapper = new TableWrapper($routine, $codeStore, $nameMangler, $lobAsString);
        break;

      default:
        throw new FallenException('routine type', $routine['designation']);
    }

    return $wrapper;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns an array with fully qualified names that must be imported in the stored routine wrapper class.
   *
   * @return array
   */
  public function getImports(): array
  {
    return $this->imports;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns true if one of the parameters is a BLOB or CLOB.
   *
   * @param array|null $parameters The parameters info (name, type, description).
   *
   * @return bool
   */
  public function isBlobParameter(?array $parameters): bool
  {
    $hasBlob = false;

    if (!empty($parameters))
    {
      foreach ($parameters as $parameter_info)
      {
        $hasBlob = $hasBlob || DataTypeHelper::isBlobParameter($parameter_info['data_type']);
      }
    }

    return $hasBlob;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Adds a throw tag to the odc block of the generated method.
   *
   * @param string $class The name of the exception.
   */
  public function throws(string $class): void
  {
    $parts                = explode('\\', $class);
    $this->throws[$class] = array_pop($parts);
    $this->imports[]      = $class;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates a complete wrapper method.
   */
  public function writeRoutineFunction(): void
  {
    if (!$this->lobAsStringFlag && $this->isBlobParameter($this->routine['parameters']))
    {
      $this->writeRoutineFunctionWithLob();
    }
    else
    {
      $this->writeRoutineFunctionWithoutLob();
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates a complete wrapper method for a stored routine with a LOB parameter.
   */
  public function writeRoutineFunctionWithLob(): void
  {
    $this->throws(MySqlDataLayerException::class);
    $this->throws(MysqlQueryErrorException::class);
    $this->throws(ResultException::class);

    $wrapper_args = $this->getWrapperArgs();
    $routine_args = $this->getRoutineArgs();
    $method_name  = $this->nameMangler->getMethodName($this->routine['routine_name']);

    $bindings = '';
    $nulls    = '';
    foreach ($this->routine['parameters'] as $parameter_info)
    {
      $binding = DataTypeHelper::getBindVariableType($parameter_info, $this->lobAsStringFlag);
      if ($binding=='b')
      {
        $bindings .= 'b';
        if ($nulls!=='') $nulls .= ', ';
        $nulls .= '$null';
      }
    }

    $this->codeStore->appendSeparator();
    $this->generatePhpDocBlock();
    $this->codeStore->append('public function '.$method_name.'('.$wrapper_args.')');
    $this->codeStore->append('{');
    $this->codeStore->append('$query = \'call '.$this->routine['routine_name'].'('.$routine_args.')\';');
    $this->codeStore->append('$stmt  = @$this->mysqli->prepare($query);');
    $this->codeStore->append('if (!$stmt) throw $this->dataLayerError(\'mysqli::prepare\');');
    $this->codeStore->append('');
    $this->codeStore->append('$null = null;');
    $this->codeStore->append('$success = @$stmt->bind_param(\''.$bindings.'\', '.$nulls.');');
    $this->codeStore->append('if (!$success) throw $this->dataLayerError(\'mysqli_stmt::bind_param\');');
    $this->codeStore->append('');
    $this->codeStore->append('$this->getMaxAllowedPacket();');
    $this->codeStore->append('');

    $blobArgumentIndex = 0;
    foreach ($this->routine['parameters'] as $parameter_info)
    {
      if (DataTypeHelper::getBindVariableType($parameter_info, $this->lobAsStringFlag)=='b')
      {
        $mangledName = $this->nameMangler->getParameterName($parameter_info['parameter_name']);

        $this->codeStore->append('$this->sendLongData($stmt, '.$blobArgumentIndex.', $'.$mangledName.');');

        $blobArgumentIndex++;
      }
    }

    if ($blobArgumentIndex>0)
    {
      $this->codeStore->append('');
    }

    $this->codeStore->append('if ($this->logQueries)');
    $this->codeStore->append('{');
    $this->codeStore->append('$time0 = microtime(true);');
    $this->codeStore->append('');
    $this->codeStore->append('$success = @$stmt->execute();');
    $this->codeStore->append('if (!$success) throw $this->queryError(\'mysqli_stmt::execute\', $query);');
    $this->codeStore->append('');
    $this->codeStore->append('$this->queryLog[] = [\'query\' => $query,');
    $this->codeStore->append('                     \'time\'  => microtime(true) - $time0];', false);
    $this->codeStore->append('}');
    $this->codeStore->append('else');
    $this->codeStore->append('{');
    $this->codeStore->append('$success = $stmt->execute();');
    $this->codeStore->append('if (!$success) throw $this->queryError(\'mysqli_stmt::execute\', $query);');
    $this->codeStore->append('}');
    $this->codeStore->append('');
    $this->writeRoutineFunctionLobFetchData();
    $this->codeStore->append('$stmt->close();');
    $this->codeStore->append('if ($this->mysqli->more_results()) $this->mysqli->next_result();');
    $this->codeStore->append('');
    $this->writeRoutineFunctionLobReturnData();
    $this->codeStore->append('}');
    $this->codeStore->append('');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a wrapper method for a stored routine without LOB parameters.
   */
  public function writeRoutineFunctionWithoutLob(): void
  {
    $wrapperArgs = $this->getWrapperArgs();
    $methodName  = $this->nameMangler->getMethodName($this->routine['routine_name']);
    $returnType  = $this->getReturnTypeDeclaration();

    $tmp             = $this->codeStore;
    $this->codeStore = new PhpCodeStore();
    $this->writeResultHandler();
    $body            = $this->codeStore->getRawCode();
    $this->codeStore = $tmp;

    $this->codeStore->appendSeparator();
    $this->generatePhpDocBlock();
    $this->codeStore->append('public function '.$methodName.'('.$wrapperArgs.')'.$returnType);
    $this->codeStore->append('{');
    $this->codeStore->append($body, false);
    $this->codeStore->append('}');
    $this->codeStore->append('');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Enhances the metadata of the parameters of the store routine wrapper.
   *
   * @param array[] $parameters The metadata of the parameters. For each parameter the
   *                            following keys must be defined:
   *                            <ul>
   *                            <li> php_name             The name of the parameter (including $).
   *                            <li> description          The description of the parameter.
   *                            <li> php_type             The type of the parameter.
   *                            <li> data_type_descriptor The data type of the corresponding parameter of the stored
   *                            routine. Null if there is no corresponding parameter.
   *                            </ul>
   */
  protected function enhancePhpDocBlockParameters(array &$parameters): void
  {
    // Nothing to do.
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the return type the be used in the DocBlock.
   *
   * @return string
   */
  abstract protected function getDocBlockReturnType(): string;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the return type declaration of the wrapper method.
   *
   * @return string
   */
  abstract protected function getReturnTypeDeclaration(): string;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns code for the arguments for calling the stored routine in a wrapper method.
   *
   * @return string
   */
  protected function getRoutineArgs(): string
  {
    $ret = '';

    foreach ($this->routine['parameters'] as $parameter_info)
    {
      $mangledName = $this->nameMangler->getParameterName($parameter_info['parameter_name']);

      if ($ret) $ret .= ',';
      $ret .= DataTypeHelper::escapePhpExpression($parameter_info, '$'.$mangledName, $this->lobAsStringFlag);
    }

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns code for the parameters of the wrapper method for the stored routine.
   *
   * @return string
   */
  protected function getWrapperArgs(): string
  {
    $ret = '';

    if ($this->routine['designation']=='bulk')
    {
      $ret .= 'BulkHandler $bulkHandler';
    }

    foreach ($this->routine['parameters'] as $i => $parameter)
    {
      if ($ret!='') $ret .= ', ';

      $dataType    = DataTypeHelper::columnTypeToPhpTypeHinting($parameter);
      $declaration = DataTypeHelper::phpTypeHintingToPhpTypeDeclaration($dataType.'|null');
      if ($declaration!=='')
      {
        $ret .= $declaration.' ';
      }

      $ret .= '$'.$this->nameMangler->getParameterName($parameter['parameter_name']);
    }

    return $ret;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates code for calling the stored routine in the wrapper method.
   *
   * @return void
   */
  abstract protected function writeResultHandler(): void;
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates code for fetching data of a stored routine with one or more LOB parameters.
   *
   * @return void
   */
  abstract protected function writeRoutineFunctionLobFetchData(): void;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates code for retuning the data returned by a stored routine with one or more LOB parameters.
   *
   * @return void
   */
  abstract protected function writeRoutineFunctionLobReturnData(): void;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generate php doc block in the data layer for stored routine.
   */
  private function generatePhpDocBlock(): void
  {
    $this->codeStore->append('/**', false);

    // Generate phpdoc with short description of routine wrapper.
    $this->generatePhpDocBlockSortDescription();

    // Generate phpdoc with long description of routine wrapper.
    $this->generatePhpDocBlockLongDescription();

    // Generate phpDoc with parameters and descriptions of parameters.
    $this->generatePhpDocBlockParameters();

    // Generate return parameter doc.
    $this->generatePhpDocBlockReturn();

    // Generate throw tags.
    $this->generatePhpDocBlockThrow();

    $this->codeStore->append(' */', false);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates the long description of stored routine wrapper.
   */
  private function generatePhpDocBlockLongDescription(): void
  {
    if ($this->routine['phpdoc']['long_description']!=='')
    {
      $this->codeStore->append(' * '.$this->routine['phpdoc']['long_description'], false);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates the doc block for parameters of stored routine wrapper.
   */
  private function generatePhpDocBlockParameters(): void
  {
    $parameters = [];
    foreach ($this->routine['phpdoc']['parameters'] as $parameter)
    {
      $mangledName = $this->nameMangler->getParameterName($parameter['parameter_name']);

      $parameters[] = ['php_name'             => '$'.$mangledName,
                       'description'          => $parameter['description'],
                       'php_type'             => $parameter['php_type'],
                       'data_type_descriptor' => $parameter['data_type_descriptor']];
    }

    $this->enhancePhpDocBlockParameters($parameters);

    if (!empty($parameters))
    {
      // Compute the max lengths of parameter names and the PHP types of the parameters.
      $max_name_length = 0;
      $max_type_length = 0;
      foreach ($parameters as $parameter)
      {
        $max_name_length = max($max_name_length, mb_strlen($parameter['php_name']));
        $max_type_length = max($max_type_length, mb_strlen($parameter['php_type']));
      }

      $this->codeStore->append(' *', false);

      // Generate phpDoc for the parameters of the wrapper method.
      foreach ($parameters as $parameter)
      {
        $format = sprintf(' * %%-%ds %%-%ds %%-%ds %%s', mb_strlen('@param'), $max_type_length, $max_name_length);

        $lines = explode(PHP_EOL, $parameter['description'] ?? '');
        if (!empty($lines))
        {
          $line = array_shift($lines);
          $this->codeStore->append(sprintf($format, '@param', $parameter['php_type'], $parameter['php_name'], $line), false);
          foreach ($lines as $line)
          {
            $this->codeStore->append(sprintf($format, ' ', ' ', ' ', $line), false);
          }
        }
        else
        {
          $this->codeStore->append(sprintf($format, '@param', $parameter['php_type'], $parameter['php_name'], ''), false);
        }

        if ($parameter['data_type_descriptor']!==null)
        {
          $this->codeStore->append(sprintf($format, ' ', ' ', ' ', $parameter['data_type_descriptor']), false);
        }
      }
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates the PHP doc block for the return type of the stored routine wrapper.
   */
  private function generatePhpDocBlockReturn(): void
  {
    $return = $this->getDocBlockReturnType();
    if ($return!=='')
    {
      $this->codeStore->append(' *', false);
      $this->codeStore->append(' * @return '.$return, false);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates the sort description of stored routine wrapper.
   */
  private function generatePhpDocBlockSortDescription(): void
  {
    if ($this->routine['phpdoc']['sort_description']!=='')
    {
      $this->codeStore->append(' * '.$this->routine['phpdoc']['sort_description'], false);
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates the PHP doc block with throw tags.
   */
  private function generatePhpDocBlockThrow()
  {
    if (!empty($this->throws))
    {
      $this->codeStore->append(' *', false);

      $this->throws = array_unique($this->throws, SORT_REGULAR);
      foreach ($this->throws as $class)
      {
        $this->codeStore->append(sprintf(' * @throws %s;', $class), false);
      }
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

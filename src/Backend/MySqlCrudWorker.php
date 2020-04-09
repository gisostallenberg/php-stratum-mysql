<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Backend;

use SetBased\Exception\FallenException;
use SetBased\Stratum\Backend\CrudWorker;
use SetBased\Stratum\MySql\Helper\Crud\DeleteRoutine;
use SetBased\Stratum\MySql\Helper\Crud\InsertRoutine;
use SetBased\Stratum\MySql\Helper\Crud\SelectRoutine;
use SetBased\Stratum\MySql\Helper\Crud\UpdateRoutine;

/**
 *
 */
class MySqlCrudWorker extends MySqlWorker implements CrudWorker
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Generates the code for a stored routine.
   *
   * @param string $tableName   The name of the table.
   * @param string $operation   The operation {insert|update|delete|select}.
   * @param string $routineName The name of the generated routine.
   *
   * @return string
   */
  public function generateRoutine(string $tableName, string $operation, string $routineName): string
  {
    $schema = $this->settings->manString('database.database');

    $this->connect();
    switch ($operation)
    {
      case 'update':
        $routine = new UpdateRoutine($tableName, $operation, $routineName, $schema);
        break;

      case 'delete':
        $routine = new DeleteRoutine($tableName, $operation, $routineName, $schema);
        break;

      case 'select':
        $routine = new SelectRoutine($tableName, $operation, $routineName, $schema);
        break;

      case 'insert':
        $routine = new InsertRoutine($tableName, $operation, $routineName, $schema);
        break;

      default:
        throw new FallenException('operation', $operation);
    }
    $this->disconnect();

    return $routine->getCode();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a list of all supported operations by the worker.
   *
   * @return string[]
   */
  public function operations(): array
  {
    return ['insert', 'update', 'delete', 'select'];
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns a list of all tables in de database of the backend.
   *
   * @return array
   */
  public function tables(): array
  {
    $this->connect();
    $schema = $this->settings->manString('database.database');
    $rows   = $this->dl->allTablesNames($schema);
    $this->disconnect();

    $tables = [];
    foreach ($rows as $row)
    {
      $tables[] = $row['table_name'];
    }

    return $tables;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

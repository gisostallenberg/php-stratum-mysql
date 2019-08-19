<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Backend;

use SetBased\Stratum\Backend;
use SetBased\Stratum\Config;
use SetBased\Stratum\ConstantWorker;
use SetBased\Stratum\CrudWorker;
use SetBased\Stratum\RoutineLoaderWorker;
use SetBased\Stratum\RoutineWrapperGeneratorWorker;
use SetBased\Stratum\StratumStyle;

/**
 * The PhpStratum's backend for MySQL and MariadDB using mysqli.
 */
class MysqlBackend extends Backend
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritDoc
   */
  public function createConstantWorker(Config $settings, StratumStyle $io): ?ConstantWorker
  {
    return new MysqlConstantWorker($settings, $io);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritDoc
   */
  public function createCrudWorker(Config $settings, StratumStyle $io): ?CrudWorker
  {
    return new MySqlCrudWorker($settings, $io);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritDoc
   */
  public function createRoutineLoaderWorker(Config $settings, StratumStyle $io): ?RoutineLoaderWorker
  {
    return new MySqlRoutineLoaderWorker($settings, $io);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * @inheritDoc
   */
  public function createRoutineWrapperGeneratorWorker(Config $settings,
                                                      StratumStyle $io): ?RoutineWrapperGeneratorWorker
  {
    return new MySqlRoutineWrapperGeneratorWorker($settings, $io);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

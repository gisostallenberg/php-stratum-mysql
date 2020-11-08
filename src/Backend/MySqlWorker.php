<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Backend;

use SetBased\Stratum\Backend\Config;
use SetBased\Stratum\Backend\StratumStyle;
use SetBased\Stratum\MySql\Exception\MySqlConnectFailedException;
use SetBased\Stratum\MySql\Exception\MySqlDataLayerException;
use SetBased\Stratum\MySql\MySqlDataLayer;
use SetBased\Stratum\MySql\MySqlDefaultConnector;
use SetBased\Stratum\MySql\MySqlMetaDataLayer;
use Symfony\Component\Console\Formatter\OutputFormatter;

/**
 * Base class for commands which needs a connection to a MySQL instance.
 */
class MySqlWorker
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The meta data layer.
   *
   * @var MySqlMetaDataLayer
   */
  protected $dl;

  /**
   * The output object.
   *
   * @var StratumStyle
   */
  protected $io;

  /**
   * The settings from the PhpStratum configuration file.
   *
   * @var Config
   */
  protected $settings;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param Config       $settings The settings from the PhpStratum configuration file.
   * @param StratumStyle $io       The output object.
   */
  public function __construct(Config $settings, StratumStyle $io)
  {
    $this->settings = $settings;
    $this->io       = $io;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Disconnects from MySQL instance.
   */
  public function disconnect()
  {
    if ($this->dl!==null)
    {
      $this->dl->disconnect();
      $this->dl = null;
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Connects to a MySQL instance.
   *
   * @throws MySqlConnectFailedException
   * @throws MySqlDataLayerException
   */
  protected function connect(): void
  {
    $host     = $this->settings->manString('database.host');
    $user     = $this->settings->manString('database.user');
    $password = $this->settings->manString('database.password');
    $database = $this->settings->manString('database.database');
    $port     = $this->settings->manInt('database.port', 3306);

    $connector = new MySqlDefaultConnector($host, $user, $password, $database, $port);
    $dataLayer = new MySqlDataLayer($connector);
    $dataLayer->connect();

    $this->dl = new MySqlMetaDataLayer($dataLayer, $this->io);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Writes a file in two phase to the filesystem.
   *
   * First write the data to a temporary file (in the same directory) and than renames the temporary file. If the file
   * already exists and its content is equal to the data that must be written no action  is taken. This has the
   * following advantages:
   * * In case of some write error (e.g. disk full) the original file is kept in tact and no file with partially data
   * is written.
   * * Renaming a file is atomic. So, running processes will never read a partially written data.
   *
   * @param string $filename The name of the file were the data must be stored.
   * @param string $data     The data that must be written.
   */
  protected function writeTwoPhases(string $filename, string $data): void
  {
    $write = true;
    if (file_exists($filename))
    {
      $oldData = file_get_contents($filename);
      if ($data==$oldData) $write = false;
    }

    if ($write)
    {
      $tmpFilename = $filename.'.tmp';
      file_put_contents($tmpFilename, $data);
      rename($tmpFilename, $filename);

      $this->io->text(sprintf('Wrote <fso>%s</fso>', OutputFormatter::escape($filename)));
    }
    else
    {
      $this->io->text(sprintf('File <fso>%s</fso> is up to date', OutputFormatter::escape($filename)));
    }
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

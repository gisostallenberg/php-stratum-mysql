<?php
declare(strict_types=1);

namespace SetBased\Stratum\MySql\Test;

use PHPUnit\Framework\TestCase;
use SetBased\Stratum\MySql\Exception\MySqlConnectFailedException;
use SetBased\Stratum\MySql\MySqlDefaultConnector;

/**
 * Test cases class MySqlDefaultConnector.
 */
class MySqlDefaultConnectorTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test connection to a non-existing server.
   */
  public function testConnectFailed()
  {
    $connector = new MySqlDefaultConnector('localhost', 'no-such-user', 'test', 'test');

    $this->expectException(MySqlConnectFailedException::class);
    $connector->connect();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test disconnect when connect to a server failed.
   */
  public function testDisconnectConnectFailed()
  {
    $connector = new MySqlDefaultConnector('localhost', 'no-such-user', 'test', 'test');
    try
    {
      $connector->connect();
    }
    catch (MySqlConnectFailedException $exception)
    {
      // Ignore error.
    }

    $connector->disconnect();
    self::assertTrue(true);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test disconnect when connected.
   */
  public function testDisconnectConnected()
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');
    $connector->connect();
    $connector->disconnect();
    self::assertTrue(true);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test disconnect when server has gone.
   */
  public function testDisconnectNoServer()
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');
    $connector->connect();

    exec('sudo systemctl stop mysql || sudo service mysql stop');

    $connector->disconnect();
    self::assertTrue(true);

    exec('sudo systemctl start mysql || sudo service mysql start');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test disconnect when never connected to a server.
   */
  public function testDisconnectNotConnected()
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');
    $connector->disconnect();
    self::assertTrue(true);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test isAlive when never disconnected.
   */
  public function testIsAliveDisconnected()
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');
    $connector->connect();
    $connector->disconnect();

    $isAlive = $connector->isAlive();
    self::assertFalse($isAlive);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test isAlive with alive connection.
   */
  public function testIsAliveIsAlive()
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');

    $connector->connect();
    $isAlive = $connector->isAlive();
    self::assertTrue($isAlive);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test isAlive when server has gone.
   */
  public function testIsAliveNoServer()
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');
    $connector->connect();

    exec('sudo systemctl stop mysql || sudo service mysql stop');

    $isAlive = $connector->isAlive();
    self::assertFalse($isAlive);

    exec('sudo systemctl start mysql || sudo service mysql start');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test isAlive when never connected.
   */
  public function testIsAliveNotConnected()
  {
    $connector = new MySqlDefaultConnector('localhost', 'test', 'test', 'test');

    $isAlive = $connector->isAlive();
    self::assertFalse($isAlive);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------

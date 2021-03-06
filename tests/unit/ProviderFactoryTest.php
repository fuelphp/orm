<?php
/**
 * @package   Fuel\Orm
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2014 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Orm;

use Codeception\TestCase\Test;

/**
 * Tests for ProviderFactory
 *
 * @package Fuel\Orm
 * @author  Fuel Development Team
 */
class ProviderFactoryTest extends Test
{

	/**
	 * @var ProviderFactory
	 */
	protected $factory;

	protected function _before()
	{
		$this->factory = new ProviderFactory;
	}

	public function testAddHasGet()
	{
		$name = 'provider';

		$this->assertFalse(
			$this->factory->has($name)
		);

		$this->factory->add($name, []);

		$this->assertTrue(
			$this->factory->has($name)
		);

		$this->factory->remove($name);

		$this->assertFalse(
			$this->factory->has($name)
		);
	}

	public function testGet()
	{
		$name = 'test';
		$properties = ['id', 'name', 'created_at'];
		$tableName = 'oak_table';

		$this->factory->add($name, $properties, $tableName);

		$provider = $this->factory->get($name);

		$this->assertInstanceOf(
			'Fuel\Orm\Provider',
			$provider
		);

		$this->assertEquals(
			$tableName,
			$provider->getTableName()
		);

		$this->assertEquals(
			$properties,
			$provider->getProperties()
		);
	}

}

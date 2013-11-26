<?php
/**
 * @package   Fuel\Orm
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Orm;

use Fuel\Common\DataContainer;

/**
 * Defines common functionality for a data model
 *
 * @package Fuel\Orm
 * @author  Fuel Development Team
 * @since   2.0
 */
class Model extends DataContainer
{

	/**
	 * @var DataContainer
	 */
	protected $originalData;

	/**
	 * @var bool
	 */
	protected $isNew = true;

	public function __construct(array $data = [], $readOnly = false)
	{
		parent::__construct($data, $readOnly);

		// Make sure we are keeping track of our original data to be able to do diffs later.
		$this->setOriginalData($data);
	}

	/**
	 * Sets the original data for this model
	 *
	 * @param array|DataContainer $data
	 *
	 * @throws \InvalidArgumentException
	 *
	 * @since 2.0
	 */
	protected function setOriginalData($data)
	{
		if (is_array($data))
		{
			$data = new DataContainer($data);
		}

		if ( ! $data instanceof DataContainer)
		{
			// TODO: Add translatable stuff here
			throw new \InvalidArgumentException('The data must be an array or a DataContainer');
		}

		// Make sure the original data can't be changed
		$data->setReadOnly(true);

		$this->originalData = $data;
	}

	/**
	 * Sets the isNew status
	 *
	 * @param bool $status
	 *
	 * @return $this
	 *
	 * @since 2.0
	 */
	public function setIsNew($status)
	{
		if ( ! is_bool($status))
		{
			// TODO: Make this translatable
			throw new \InvalidArgumentException('The isNew status must be boolean');
		}

		$this->isNew = $status;

		return $this;
	}

	/**
	 * Returns true if this model is new
	 *
	 * @return bool
	 *
	 * @since 2.0
	 */
	public function isNew()
	{
		return $this->isNew();
	}

	/**
	 * Gets the original data assigned to this model
	 *
	 * @return DataContainer
	 *
	 * @since 2.0
	 */
	public function getOriginalData()
	{
		return $this->originalData;
	}

}

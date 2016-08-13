<?php namespace App\API\src\Database\MySql\Traits;

use PDO;

trait ParameterInsertable {
	/**
	 * The max number of records to be inserted at once
	 *
	 * @var int
	 */
	protected $parameterInsertableChunkSize = 2000;
	/**
	 * The empty value representation
	 *
	 * @var string
	 */
	protected $parameterInsertableEmptyValue = 'mongerSqlEmptyValue';
	/**
	 * The primary key
	 *
	 * @var string
	 */
	protected $parameterInsertablePrimaryKey;
	/**
	 * Create safe insert query and executes using the given pdo
	 *
	 * @param PDO		$pdo
	 * @param array		$parameters
	 * @param string	$table
	 *
	 * @return array
	 */
	protected function insertFromParameters(PDO $pdo, $parameters, $table)
	{
		return $this->insertInChunks($pdo, $parameters, $table);
	}
	/**
	 * Create safe insert on duplicate key update query and executes using the given pdo
	 *
	 * @param PDO		$pdo
	 * @param array		$parameters
	 * @param string	$table
	 * @param string	$primaryKey
	 * @param array		$updateColumns
	 *
	 * @return array
	 */
	protected function insertFromParametersOnDuplicateKeyUpdate(PDO $pdo, $parameters, $table, $primaryKey, $updateColumns)
	{
		return $this->insertInChunks($pdo, $parameters, $table, $primaryKey, $updateColumns);
	}
	/**
	 * Updates using insert on duplicate key update
	 * only updates values that are not equal to the $parameterInsertableEmptyValue
	 *
	 * @param PDO		$pdo
	 * @param array		$parameters
	 * @param string	$table
	 * @param string	$primaryKey
	 * @param bool      $hasSkippableFields
	 */
	protected function updateFromParameters(PDO $pdo, $parameters, $table, $primaryKey, $hasSkippableFields = false)
	{
		if (!$chunks = array_chunk($parameters, $this->parameterInsertableChunkSize))
			return;
		$parameter = current($parameters);
		$columns = $this->createColumnInsertStringFromParameter($parameter);
		$onDuplicateKeyUpdate = $this->createOnDuplicateKeyUpdateExisting(array_keys($parameter), $primaryKey, $hasSkippableFields);
		foreach ($chunks as $chunk)
		{
			$insertValueString = $this->createInsertValueStringFromParameters($pdo, $chunk);
			$pdo->exec("INSERT INTO {$table} {$columns} VALUES {$insertValueString} {$onDuplicateKeyUpdate};");
		}
	}
	/**
	 * Create safe insert query and execute insert using the given pdo in chunks
	 *
	 * @param PDO		$pdo
	 * @param array		$parameters
	 * @param string	$table
	 * @param string	$primaryKey
	 * @param array		$updateColumns
	 *
	 * @return array
	 * @throws \InvalidArgumentException
	 */
	protected function insertInChunks(PDO $pdo, $parameters, $table, $primaryKey = null, $updateColumns = [])
	{
		if (!$chunks = array_chunk($parameters, $this->parameterInsertableChunkSize))
			return [];
		$insertIds = [];
		$onDuplicateKeyUpdate = '';
		$this->parameterInsertablePrimaryKey = null;
		$parameter = current($parameters);
		$columns = $this->createColumnInsertStringFromParameter($parameter);
		if ($primaryKey)
		{
			$onDuplicateKeyUpdate = $this->createOnDuplicateKeyUpdateStringFromParameter($updateColumns);
			$this->setInsertFromParameterPrimaryKey($parameter, $primaryKey);
		}
		foreach ($chunks as $chunk)
		{
			$insertValueString = $this->createInsertValueStringFromParameters($pdo, $chunk);
			$pdo->exec("INSERT INTO {$table} {$columns} VALUES {$insertValueString} {$onDuplicateKeyUpdate};");
			$insertIds = array_merge($insertIds, $this->buildInsertIdList($pdo->lastInsertId(), $chunk, $primaryKey));
		}
		return $insertIds;
	}
	/**
	 * Create insert id list
	 *
	 * @param array		$parameter
	 * @param string	$primaryKey
	 *
	 * @return array
	 */
	protected function setInsertFromParameterPrimaryKey($parameter, $primaryKey)
	{
		foreach ($parameter as $key => $value)
		{
			if (strtolower($primaryKey) == strtolower($key))
				$this->parameterInsertablePrimaryKey = $key;
		}
		if (!$this->parameterInsertablePrimaryKey)
		{
			$columns = implode(', ', array_keys($parameter));
			throw new \InvalidArgumentException("Primary key '{$primaryKey}' not found in '{$columns}'");
		}
	}
	/**
	 * Create insert id list
	 *
	 * @param int		$lastInsertId
	 * @param array		$insertedRecords
	 *
	 * @return array
	 */
	protected function buildInsertIdList($lastInsertId, $insertedRecords)
	{
		$inserIdList = [];
		foreach ($insertedRecords as $insertedRecord)
		{
			if ($this->parameterInsertablePrimaryKey && ($insertedRecord[$this->parameterInsertablePrimaryKey] > 0))
				continue;
			$inserIdList[] = $lastInsertId++;
		}
		return $inserIdList;
	}
	/**
	 * Create insert column string
	 *
	 * @param array		$parameter
	 *
	 * @return string
	 */
	protected function createColumnInsertStringFromParameter($parameter)
	{
		return '(`' . implode("`,`", array_keys($parameter)) . '`)';
	}
	/**
	 * Create on duplicate key update string
	 *
	 * @param array		$updateColumns
	 *
	 * @return string
	 */
	protected function createOnDuplicateKeyUpdateStringFromParameter($updateColumns)
	{
		if (empty($updateColumns))
			return;
		$updateString = [];
		foreach ($updateColumns as $column)
		{
			$updateString[] = "`{$column}` = VALUES({$column})";
		}
		return 'ON DUPLICATE KEY UPDATE ' . implode(',', $updateString);
	}
	/**
	 * Create on duplicate key update, only updating existing values in the param
	 *
	 * @param array		$columns
	 * @param string	$primaryKey
	 * @param bool      $hasSkippableFields
	 *
	 * @return string
	 */
	protected function createOnDuplicateKeyUpdateExisting($columns, $primaryKey, $hasSkippableFields = false)
	{
		$updateString = [];
		foreach ($columns as $column)
		{
			if ($column == $primaryKey)
				continue;
			if ($hasSkippableFields)
				$updateString[] = "`{$column}` = IF(VALUES({$column}) = '{$this->parameterInsertableEmptyValue}', {$column}, VALUES({$column}))";
			else
				$updateString[] = "`{$column}` = VALUES({$column})";
		}
		return 'ON DUPLICATE KEY UPDATE ' . implode(',', $updateString);
	}
	/**
	 * Create safe parameters
	 *
	 * @param PDO		$pdo
	 * @param array		$parameter
	 *
	 * @return array
	 */
	protected function createSafeParameters(PDO $pdo, $parameters)
	{
		$safeParameters = [];
		foreach ($parameters as $parameter)
		{
			$safeParameter = [];
			foreach ($parameter as $key => $unsafeParameter)
			{
				$unsafeParameter = is_a($unsafeParameter, 'DateTime') ? $unsafeParameter->format('Y-m-d H:i:s') : $unsafeParameter;
				$safeParameter[$key] = is_string($unsafeParameter) || is_bool($unsafeParameter) ?  $pdo->quote($unsafeParameter) : $unsafeParameter;
			}
			$safeParameters[] = $safeParameter;
		}
		return $safeParameters;
	}
	/**
	 * Create insert values string from safe parameters
	 *
	 * @param PDO		$pdo
	 * @param array		$parameters
	 *
	 * @return string
	 */
	protected function createInsertValueStringFromParameters(PDO $pdo, $parameters)
	{
		$safeParameters = $this->createSafeParameters($pdo, $parameters);
		$insertValues = [];
		foreach ($safeParameters as $safeParameter)
		{
			$insertValues[]  = '(' . $this->implodeWithNull(',', $safeParameter) . ')';
		}
		return implode(',', $insertValues);
	}
	/**
	 * mimics php implode but converts nulls to string 'null'
	 *
	 * @param string    $glue
	 * @param array     $pieces
	 *
	 * @return string
	 */
	protected function implodeWithNull($glue, $pieces)
	{
		$str = '';
		foreach ($pieces as $piece)
		{
			$str .= (is_null($piece) ? 'NULL' : $piece) . $glue;
		}
		if ($length = strlen($str))
			$str = substr($str, 0, $length - strlen($glue));
		return $str;
	}
}
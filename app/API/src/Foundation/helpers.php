<?php

if ( ! function_exists('array_index'))
{
	/**
	 * Indexes an array based on the given index value.
	 * If the index does not exits in an element, the array element will be lost.
	 * Flatten flag is used to create an array of index as values
	 * Index prefix is used for adding a prefix to the index key in order to turn it into a string.
	 *
	 * @param	array	$array
	 * @param	string	$index
	 * @param	bool	$flattenFlag
	 * @param	string	$indexPrefix
	 *
	 * @return	array
	 */
	function array_index($array, $index = '', $flattenFlag = false, $indexPrefix = '')
	{
		$return = [];

		foreach ($array as $key => $value)
		{
			if (is_array($value))
			{
				if ($indexPrefix)
					$new_key = $indexPrefix . STRING_DELIMITER . $value[$index];
				else
					$new_key = $value[$index];
				if (isset($value[$index]))
				{
					if ($flattenFlag)
						$return[$new_key] = $value[$index];
					else
						$return[$new_key] = $value;
				}
			}
			else
			{
				$return[$value] = $value;
			}
		}

		return $return;
	}
}

if ( ! function_exists('debug_object'))
{
	/**
	* A debuging function that outputs a dump of any variable, array or object value passed to it.
	*
	* @param mixed 		$object
	* @param string 	$exit		//if set to true, the script will halt after dumping the object
	*
	* @return void
	*/
	function debug_object($object, $exit=false)
	{
		if(is_object($object) || is_array($object))
		{
			echo '<pre>'.print_r($object, true).'</pre>';
		}
		else
		{
			var_dump($object);
		}
		if($exit)
		{
			exit();
		}
	}
}

if ( ! function_exists('dob'))
{
	/**
	 * Alias for debug_object that doesn't involve writing a novel every time you want to print something out
	 *
	 * Inherets doc from above
	 */
	function dob()
	{
		return call_user_func_array("debug_object", func_get_args());
	}
}
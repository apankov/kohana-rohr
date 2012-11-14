<?php

class Resource {

	public static function list_url($name, $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		return Route::url($prefix . $name . '_resource_router');
	}

	public static function create_url($name, $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		return Route::url($prefix . $name . '_resource_router');
	}

	public static function update_url($name, $model, $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		return Route::url($prefix . $name . '_resource_router_obj',
			array(
				'id' => $model->id,
			));
	}

	public static function url($name, $model, $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		return Route::url($prefix . $name . '_resource_router_obj',
			array(
				'id' => $model->id,
			));
	}

	public static function edit_url($name, $model, $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		return Route::url($prefix . $name . '_resource_edit',
			array(
				'id' => $model->id,
			));
	}

	public static function new_url($name, $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		return Route::url($prefix . $name . '_resource_new');
	}
}

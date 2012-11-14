<?php

class Route extends Kohana_Route {

	/**
	 * Ruby on Rails
	 *
	 * | Verb   | Path             | action  | used for                                     |
	 * |--------+------------------+---------+----------------------------------------------|
	 * | GET    | /photos          | index   | display a list of all photos                 |
	 * | GET    | /photos/new      | new     | return an HTML form for creating a new photo |
	 * | POST   | /photos          | create  | create a new photo                           |
	 * | GET    | /photos/:id      | show    | display a specific photo                     |
	 * | GET    | /photos/:id/edit | edit    | return an HTML form for editing a photo      |
	 * | PUT    | /photos/:id      | update  | update a specific photo                      |
	 * | PATCH  | /photos/:id      | patch   | partially update a specific photo            |
	 * | DELETE | /photos/:id      | destroy | delete a specific photo                      |
	 *
	 */
	// @todo: need response format
	public static function resource($name, $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		$directory = Arr::get($options, 'directory', '');
		// 1. GET - index
		// 3. POST - create
		Route::set($prefix . $name . "_resource_router", $prefix . $name)
			->defaults(
				array(
					'controller' => $name,
					'action'     => 'resource_router',
					'routing'    => 'wo_id',
					'directory'  => $directory,
				)
			);

		// 2. GET - new
		Route::set($prefix . $name . "_resource_new", $prefix . $name . '/new')
			->defaults(
				array(
					'controller' => $name,
					'action'     => 'resource_router',
					'routing'    => 'new',
					'directory'  => $directory,
				)
			);

		// 5. GET - edit
		Route::set($prefix . $name . "_resource_edit", $prefix . $name . '/<id>/edit', array('id' => '\d+'))
			->defaults(
				array(
					'controller' => $name,
					'action'     => 'resource_router',
					'routing'    => 'edit',
					'directory'  => $directory,
				)
			);

		// 4. GET - show
		// 6. PUT - update
		// 7. PATCH - patch
		// 8. DELETE - destroy
		Route::set($prefix . $name . "_resource_router_obj", $prefix . $name . '/<id>', array('id' => '\d+'))
			->defaults(
				array(
					'controller' => $name,
					'action'     => 'resource_router',
					'routing'    => 'with_id',
					'directory'  => $directory,
				)
			);
	}

	/**
	 * Creates routes of extended actions
	 *
	 *     Route::extend_resource('groups',
	 *       array(
	 *         'campaigns',
	 *         'upload_img',
	 *       ));
	 *
	 * This will create routes:       
	 *
	 *     groups/<id>/campaigns
	 *     groups/<id>/upload_img
	 *
	 * @param   string   $name of the resource
	 * @param   array    list of defined actions
	 * @return  void
	 */
	public static function extend_resource($name, $actions = array(), $options = array())
	{
		$prefix = Arr::get($options, 'prefix', '');
		$directory = Arr::get($options, 'directory', '');

		foreach ($actions as $action)
		{
			// 4. GET - show
			// 6. PUT - update
			// 7. PATCH - patch
			// 8. DELETE - destroy
			Route::set($prefix . $name . '_resource_router_obj_' . $action, $prefix . $name . '/<id>/' . $action, array('id' => '\d+'))
				->defaults(
					array(
						'controller' => $name,
						'action'     => 'resource_router',
						'routing'    => 'with_id',
						'ext_action' => $action,
						'directory'  => $directory,
					)
				);
		}
	}

}

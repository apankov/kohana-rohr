<?php

class Controller_Common_Resources extends Controller_Template {

	public function before()
	{
		parent::before();
		if ( $this->request->method() == HTTP_Request::PUT
			|| $this->request->method() == HTTP_Request::DELETE )
		{
			parse_str($this->request->body(), $output);
			$this->request->post($output);
		}
	}

	protected function action_index()
	{
		throw new HTTP_Exception_404();
	}

	protected function action_new($errors = null)
	{
		throw new HTTP_Exception_404();
	}

	protected function action_create()
	{
		throw new HTTP_Exception_404();
	}

	protected function action_edit($errors = null)
	{
		throw new HTTP_Exception_404();
	}

	protected function action_show($id = null)
	{
		throw new HTTP_Exception_404();
	}

	protected function action_update()
	{
		throw new HTTP_Exception_404();
	}

	protected function action_patch()
	{
		throw new HTTP_Exception_404();
	}

	protected function action_destroy($id = null)
	{
		throw new HTTP_Exception_404();
	}

	public function action_resource_router()
	{
		$routing_map = array(
			'wo_id' => array(
				HTTP_Request::GET  => 'action_index',
				HTTP_Request::POST => 'action_create',
			),
			'with_id' => array(
				HTTP_Request::GET => 'action_show',
				HTTP_Request::PUT => 'action_update',
				'PATCH' => 'action_patch',
				HTTP_Request::DELETE => 'action_destroy',
			),
			'edit' => array(
				HTTP_Request::GET => 'action_edit',
			),
			'new' => array(
				HTTP_Request::GET => 'action_new',
			),
		);

		$routing = $this->request->param('routing');
		$action = Arr::path($routing_map, $routing . '.' . $this->http_method());

		if ($action)
		{
			if ($ext_action = $this->request->param('ext_action'))
			{
				$action .= '_' . $ext_action;
			}
			$args = func_get_args();
			return call_user_func_array(array($this, $action), $args);
		}
		else
		{
			// @todo
			die('Wrong routing/method.');
		}
	}

	private function check_method($allowed_method)
	{
		if (Request::current()->method() != $allowed_method)
		{
			// @todo
			die('Wrong method. ' . Request::current()->method() . ' / ' . var_dump($allowed_method));
		}
	}

	protected function http_method()
	{
		$method = Arr::get($this->request->headers(), 'x-request-method', '');
		if ($method == HTTP_Request::PUT)
		{
			return HTTP_Request::PUT;
		}
		else if ($method == HTTP_Request::DELETE)
		{
			return HTTP_Request::DELETE;
		}
		$method = strtoupper(Arr::get($_POST, '_method', ''));
		if ($method == HTTP_Request::PUT)
		{
			return HTTP_Request::PUT;
		}
		else if ($method == HTTP_Request::DELETE)
		{
			return HTTP_Request::DELETE;
		}
		return Request::current()->method();
	}
}

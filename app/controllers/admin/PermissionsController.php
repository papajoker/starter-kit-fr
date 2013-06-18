<?php namespace Controllers\Admin;

use AdminController;
use Sentry;
use Input;
use Lang;
use Permission;
use Redirect;
use Str;
use Validator;
use View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class PermissionsController extends AdminController {

	/**
	 * Show a list of all the permissions.
	 *
	 * @return View
	 */
	public function getIndex()
	{
    // Check if the user has access to this page
    if ( ! Sentry::getUser()->hasAccess('site.permissions.view'))
    {
      // Show the insufficient permissions page
      return Redirect::route('groups')->with('error', Lang::get('backend/messages.error.acces_deny'));
    }

		// Grab all the permissions
		$permissions = DB::table('permissions')->paginate();

		// Show the page
		return View::make('backend/permissions/index', compact('permissions'));
	}

	/**
	 * Permission create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
    // Check if the user has access to this page
    if ( ! Sentry::getUser()->hasAccess('site.permissions.create'))
    {
      // Show the insufficient permissions page
      return Redirect::route('groups')->with('error', Lang::get('backend/messages.error.acces_deny'));
    }

		// Show the page
		return View::make('backend/permissions/create');
	}

	/**
	 * Permission create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'name' => 'required|unique:permissions|regex:#^[a-zA-Z]+\.[a-zA-Z]+\.[a-zA-Z]+$#',
			'description' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

    $permission = new Permission;

    // Create the permission data
    $name = strtolower(Input::get('name'));
    $permission->description = Input::get('description');

    // Was the permission created?
    if ($permission = $permission->save())
    {
      // Get all the available permissions and cache query
      $allPermissions = DB::table('permissions')->remember(30)->lists('name');

      // Redirect to the permission management page
      return Redirect::route('permissions')->with('success', Lang::get('backend/permissions/messages.success.created'));
    }

    // Redirect to the permission management page
    return Redirect::route('permissions')->with('error', Lang::get('backend/permissions/messages.error.created'));
	}

	/**
	 * Permission update.
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function getEdit($id = null)
	{
    // Check if the user has access to this page
    if ( ! Sentry::getUser()->hasAccess('site.permissions.edit'))
    {
      // Show the insufficient permissions page
      return Redirect::route('groups')->with('error', Lang::get('backend/messages.error.acces_deny'));
    }
		try
		{
			// Get the permission information
			$permission = Permission::findOrFail($id);
		}
		catch (ModelNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('backend/permissions/messages.permission_not_found', compact('id'));

			// Redirect to the permission management page
			return Redirect::route('permissions')->with('error', $error);
		}

		// Show the page
		return View::make('backend/permissions/edit', compact('permission'));
	}

	/**
	 * Permission update form processing page.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function postEdit($id = null)
	{
		// Declare the rules for the form validation
		$rules = array(
			'name' => 'required|regex:#^[a-zA-Z]+\.[a-zA-Z]+\.[a-zA-Z]+$#',
			'description' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try
		{
			// Get the permission information
			$permission = Permission::findOrFail($id);

      // Create the permission data
      $name = strtolower(Input::get('name'));
      $permission->description = Input::get('description');

      // Was the permission updated?
      if ($permission = $permission->save())
      {
        // Get all the available permissions and cache query
        $allPermissions = DB::table('permissions')->remember(30)->lists('name');

        // Redirect to the permission management page
        return Redirect::route('permissions')->with('success', Lang::get('backend/permissions/messages.success.updated'));
      }

      // Redirect to the permission management page
      return Redirect::route('permissions')->with('error', Lang::get('backend/permissions/messages.error.updated'));
		}
		catch (ModelNotFoundException $e)
		{
			// Redirect to the permission management page
			return Redirect::route('permissions')->with('error', Lang::get('backend/permissions/messages.permission_not_found', compact('id')));
		}
	}

	/**
	 * Delete the given permission.
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function getDelete($id = null)
	{
    // Check if the user has access to this page
    if ( ! Sentry::getUser()->hasAccess('site.permissions.delete'))
    {
      // Show the insufficient permissions page
      return Redirect::route('groups')->with('error', Lang::get('backend/messages.error.acces_deny'));
    }
		try
		{
			// Get permission information
			$permission = Permission::findOrFail($id);

			// Delete the permission
			$permission->delete();

      // Get all the available permissions and cache query
      $allPermissions = DB::table('permissions')->remember(30)->lists('name');

			// Redirect to the permission management page
			return Redirect::route('permissions')->with('success', Lang::get('backend/permissions/messages.success.deleted'));
		}
		catch (ModelNotFoundException $e)
		{
			// Redirect to the permission management page
			return Redirect::route('permissions')->with('error', Lang::get('backend/permissions/messages.permission_not_found', compact('id')));
		}
	}

}

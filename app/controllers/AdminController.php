<?php

class AdminController extends AuthorizedController {

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Apply the admin auth filter
		$this->beforeFilter('admin-auth');
	}

	/**
	 * Prepare all the available permissions depend on domains so that they are form friendly.
	 *
	 * @param  array  $domains
	 * @param  array  $permissions
	 * @return void
	 */
	protected function preparePermissionsAndDomains(array &$permissions, array &$domains)
	{
      // Get all the available permissions with cached query
      $allPermissions = DB::table('permissions')->remember(30)->lists('name');

      foreach ($allPermissions as $key => $value)
      {
        $permissions[$value] = 0;
        list($domain, $name, $action) = explode('.', $value);

        // Add it to our domains if it's not already there.
        if (!empty($domain) && !array_key_exists($domain, $domains))
        {
          $domains[$domain] = array();
        }

        $domains[$domain][$name][] = $action;

        // Store the actions separately for building the table header
        if (!isset($domains[$domain]['actions']))
        {
          $domains[$domain]['actions'] = array();
        }

        if (!in_array($action, $domains[$domain]['actions']))
        {
          $domains[$domain]['actions'][] = $action;
        }

      }
  }

}

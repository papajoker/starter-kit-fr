<?php

class permissionsSeeder extends Seeder {

	public function run()
	{

		// Initialize empty array
		$permissions = array();

		$permissions[] = array(
			'name' => 'site.admin.view',
			'description' => 'Permet aux utilisateurs d\'accéder à l\'administration'
    );

		$permissions[] = array(
			'name' => 'site.users.view',
			'description' => 'Permet aux utilisateurs d\'accéder à la liste des utilisateurs',
    );

		$permissions[] = array(
			'name' => 'site.users.create',
			'description' => 'Permet aux utilisateurs d\'ajouter des utilisateurs',
    );

		$permissions[] = array(
			'name' => 'site.users.edit',
			'description' => 'Permet aux utilisateurs de modifier des utilisateurs',
    );

		$permissions[] = array(
			'name' => 'site.users.delete',
			'description' => 'Permet aux utilisateurs de supprimer des utilisateurs',
    );

		$permissions[] = array(
			'name' => 'site.groups.view',
			'description' => 'Permet aux utilisateurs d\'accéder à la liste des groupes',
    );

		$permissions[] = array(
			'name' => 'site.groups.create',
			'description' => 'Permet aux utilisateurs d\'ajouter des groupes',
    );

		$permissions[] = array(
			'name' => 'site.groups.edit',
			'description' => 'Permet aux utilisateurs de modifier des groupes',
    );

		$permissions[] = array(
			'name' => 'site.groups.delete',
			'description' => 'Permet aux utilisateurs de supprimer des groupes',
    );

		$permissions[] = array(
			'name' => 'site.permissions.view',
			'description' => 'Permet aux utilisateurs d\'accéder à la liste des permissions',
    );

		$permissions[] = array(
			'name' => 'site.permissions.create',
			'description' => 'Permet aux utilisateurs d\'ajouter des permissions',
    );

		$permissions[] = array(
			'name' => 'site.permissions.edit',
			'description' => 'Permet aux utilisateurs de modifier des permissions',
    );

		$permissions[] = array(
			'name' => 'site.permissions.delete',
			'description' => 'Permet aux utilisateurs de supprimer des permissions',
    );

		// delete all the permissions
		DB::table('permissions')->truncate();

		// Insert the permissions
		DB::table('permissions')->insert($permissions);
	}

}

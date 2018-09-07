<?php

namespace App\Http\Managers;

use App\Http\Packages\Object\ObjectParser;

class Navigation
{

	private static $home = [
		'url' => '/',
		'name' => 'Home',
		'hasSubNavigation' => false,
	];

	private static $ticketing = [
		'url' => 'ticket',
		'name' => 'Ticket',
		'hasSubNavigation' => false,
	];

	private static $maintenance = [
		'url' => '#',
		'name' => 'Maintenance',
		'hasSubNavigation' => true,
		'subNavigation' =>  [
			[
				'url' => 'user',
				'name' => 'User',
			],
			[
				'url' => 'category',
				'name' => 'Category',
			],
			[
				'url' => 'organization',
				'name' => 'Organization',
			],
			[
				'url' => 'level',
				'name' => 'Level',
			],
			[
				'url' => 'tag',
				'name' => 'Tag',
			],
		],
	];

	private static $reports = [
		'url' => 'reports',
		'name' => 'Reports',
		'hasSubNavigation' => false,
	];

	/**
	 * Returns all the navigation listed
	 *
	 * @return object navigation
	 */
	public static function all()
	{
		$navigation = new Navigation;
		$navigationList = ObjectParser::make($navigation->getAll());
		
        return $navigationList;
	}
	
	/**
	 * Returns the list of navigation to be placed on header
	 *
	 * @return array navigation
	 */
	public function getAll()
	{
		return [
			self::$home,
			self::$ticketing,
			self::$maintenance,
			self::$reports,
		];
	}

	/**
	 * Returns list of navigation used in maintenance
	 *
	 * @return object maintenance list 
	 */
	protected function getMaintenanceOnly()
	{
		return ObjectParser::make(self::$maintenance);
	}
}
<?php

namespace App\Http\Resources\User;

use League\Fractal\Manager;
use App\Models\User\Organization;
use League\Fractal\Resource\Collection;
use App\Transformers\User\OrganizationTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class OrganizationResource
{

	private $organization;
	private $hasPaginator = false;
	private $organizationCollection;

	/**
	 * Constructor class
	 */
	public function __construct()
	{
		$this->manager = new Manager;
		$this->organization = new Organization;
	}

	/**
	 * Fetch only root organizations
	 * 
	 * @return mixed
	 */
	public function onlyRoot()
	{
		$this->organization = $this->organization
			->whereNull('parent_id');

		return $this;
	}

	/**
	 * Fetch the child of the parent id arg passed
	 * 
	 * @param  int $id
	 * @return mixed
	 */
	public function childOf($id)
	{
		$this->organization = $this->organization
			->where('parent_id', '=', (int) $id);

		return $this;
	}

	/**
	 * Paginate the output of organization
	 *
	 * @param  $count
	 * @return mixed
	 */
	public function paginate($count = 10)
	{
		$this->organization = $this->organization->paginate($count);
		$this->hasPaginator = true;

		return $this;
	}

	/**
	 * Create a new  collection
	 * 
	 * @return mixed
	 */
	public function createCollection()
	{
		$organization = $this->organization;

		if ($this->hasPaginator) {
			$organization = $this->organization->getCollection();
		}

		$this->organizationCollection = new Collection(
			$organization, 
			new OrganizationTransformer
		);

		return $this;
	}

	/**
	 * Return the output as API
	 * 
	 * @return object
	 */
	public function transform()
	{
		$this->createCollection();

		if($this->hasPaginator) {
			$output = $this->organizationCollection
				->setPaginator(
					new IlluminatePaginatorAdapter($this->organization)
				);
		}

		$output = $this->manager
			->createData($output)
			->toJson();

		return $output;
	}
}

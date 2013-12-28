<?php 
/**
 * @file
 * Requested Data Interface.
 *
 * All LaravelJqGrid code is copyright by the original authors and released under the MIT License.
 * See LICENSE.
 */

namespace Mgallegos\LaravelJqgrid\Encoders;

use Mgallegos\LaravelJqgrid\Repositories\RepositoryInterface;

interface RequestedDataInterface {
	
	/**
	 * Echo the data requested by a grid data in a jqGrid compatible format.
	 *
	 * @param RepositoryInterface $dataRepository
	 *	An implementation of the RepositoryInterface
	 * @param  array $postedData
	 *	All jqGrid posted data
	 * @return void
	 */
	public function encodeRequestedData(RepositoryInterface $Repository,  $postedData);
	
}


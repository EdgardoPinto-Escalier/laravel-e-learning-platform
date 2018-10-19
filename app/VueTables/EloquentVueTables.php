<?php
// This class will allow us to work with Eloquent and return the data filtered and paginated from the database. https://github.com/matfish2/vue-tables-2/blob/master/server/PHP/EloquentVueTables.php


namespace App\VueTables;

// We start by creating the class EloquentVueTables implementing the interface VueTablesInterface.
Class EloquentVueTables implements VueTablesInterface {
	// Here first we obtain all the data, we make a select of the fields and its relationships.
	public function get( $model, Array $fields, Array $relations = []) {
		$byColumn  = request( 'byColumn' );
		$orderBy  = request( 'orderBy' );
		$limit     = request( 'limit' );
		$page      = request( 'page' );
		$ascending = request( 'ascending' );
		$query     = json_decode( request( 'query' ), true );
		$data      = $model->select( $fields )->with($relations);

		// Next we do a small check to see if we are sending from the VueTables the request status,
		if(request('status')) {
			$data->where('status', request('status'));
		}
		// If we are sending that request we'll do a filter by column (filterByColumn) a function we'll use below.
		if ( isset( $query ) && $query ) {
			$data = $byColumn == 1 ? $this->filterByColumn( $data, $query ) : $this->filter( $data, $query, $fields );
		}

		// Next we do a count to know the total and the results. We will just get the data we need (from and to).
		// Then we do a small check to see if we are sending the $orderBy, if we do we do it in the right order.
		$count = $data->count();
		$data->limit( $limit )->skip( $limit * ( $page - 1 ) );
		if ( isset( $orderBy )) {
			$direction = $ascending == 1 ? "ASC" : "DESC";
			$data->orderBy( $orderBy, $direction );
		}

		// Next we convert the data into an array using the get() and toArray() methods.
		$results = $data->get()->toArray();
		// Then, we return the data that VueTables needs (data and count).
		return [ //
			'data'  => $results,
			'count' => $count
		];
	}

	// filterByColumn() will look for the information we write for example if the user look for laravel
	// this will look for "name LIKE laravel".
	protected function filterByColumn( $data, $query ) {
		foreach ( $query as $field => $query ) {
			if ( ! $query ) {
				continue;
			}
			if ( is_string( $query ) && $field !== "status" ) {
				$data->where( $field, 'LIKE', "%{$query}%" );
			}
		}
		return $data;
	}
	protected function filter( $data, $query, $fields ) {
		foreach ( $fields as $index => $field ) {
			$method = $index ? "orWhere" : "where";
			$data->{$method}( $field, 'LIKE', "%{$query}%" );
		}
		return $data;
	}
}

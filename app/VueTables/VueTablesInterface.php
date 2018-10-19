<?php
namespace App\VueTables;
//
//This is the interface that has the table (Model) the columns we are going to use and the relationships.
interface VueTablesInterface {
	// This interface has the table or model, the columns we need and the relationships.
	public function get($model, Array $fields, Array $relations = []);
}

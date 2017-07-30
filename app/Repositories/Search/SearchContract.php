<?php
	namespace App\Repositories\Search;
	interface SearchContract{
		public function findByColumn($search_item1, $column1, $search_item2, $column2);
	}
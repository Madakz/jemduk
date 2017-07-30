<?php
namespace App\Repositories\Search;
use App\Repositories\Search\SearchContract;
use App\Property;
use App\Photo;

class EloquentSearchRepository implements SearchContract{
	public function findByColumn($search_item1, $column1, $search_item2, $column2){
		// $property = Property::where($column, 'like', "%$search_item%")->get();
		// dd($property);
		// return $property;

		// $property = Property::where($column1, 'LIKE', "%$search_item1%")
  //                 ->orWhere($column2, 'LIKE', "%$search_item2%")
  //                 ->get();
// $column2, '=', "%$search_item2%"
        $property = Property::where($column2, '=', "%$search_item2%")
                  ->orWhere($column1, 'LIKE', "%$search_item1%")
                  ->get();
        // dd($property);
        return $property;
	}
}

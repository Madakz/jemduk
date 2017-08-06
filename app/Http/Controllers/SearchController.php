<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Search\SearchContract;
use App\Http\Controllers\DB;
use App\Property;
use Sentinel;

class SearchController extends Controller
{
	private $repo;

	public function __construct(SearchContract $SearchContract) {
			$this->repo = $SearchContract;
		}

        public function index(){
            return view('index');
        }

    public function searchResults(Request $request){
    	// dd($request);
        $this->validate($request, [
                'category' => 'required',
                'scope' => 'required',
                'search_item' => 'required',       
            ]);
    	$column1=$request->category;
    	$column2 = 'scope';
    	$search_item1 = $request->search_item;
    	$search_item2 = $request->scope;    	
    	$results=$this->repo->findByColumn($search_item1, $column1 , $search_item2, $column2);
    	// dd($results);
    	
    	 return view('search', ['results' => $results]);
	    
    }

    public function getColumndata(Request $request){
        $column = $request->category;
        if(!empty($request->category)) 
        {
            $properties = Property::select($column)->get();
            // dd($properties);
            return view('autosuggest', ['properties' => $properties]);
            
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Event;

class SearchController extends Controller
{
    /**
     * Display a listing of found persons based on the search query.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function person(Request $request)
    {
        $found = Person::search($request->input('q'))->paginate(15);

        return $found;
    }
}

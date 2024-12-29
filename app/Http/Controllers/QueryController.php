<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    //Display Query List Page
    public function QueryListPage()
    {
        $queries=Query::OrderBy('sent_at','DESC')->get();
        //Redirect to query list page
        return view('backend.queries',compact('queries'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Category;
use App\Country;
use App\State;
use App\City;


class CommonController extends Controller
{

    function getCategory(Request $request){

        $categories = Category::where('parent_id', $request->parent_id)->orderby('title','ASC')->get();
        return $categories;
    }

    function getCountry(){

        $country = Country::where('status', 1)->orderby('title','ASC')->get();
        return $country;
    }

    function getState(Request $request){

        $state = State::where('country_id', $request->country_id)->orderby('name','ASC')->get();
        return $state;
    }

    function getCity(Request $request){

        $city = City::where('state_id', $request->state_id)->orderby('name','ASC')->get();
        return $city;
    }

}

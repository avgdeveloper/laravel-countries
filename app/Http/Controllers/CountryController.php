<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Http\Requests\CountryRequest;


class CountryController extends Controller
{

    public function index()
    {
        $countries = Country::all();
        $user_id = Auth::id();
        return view('dashboard', compact('countries', 'user_id'));
    }


    public function store(CountryRequest $request)
    {
        if (Auth::check()) {
            $request->request->add(['user_id' => Auth::id()]);
            Country::create($request->post());
            return redirect()->route('dashboard')->with('success','Country has been created successfully.');
        } 
        return redirect()->route('dashboard')->with('failed','Missing user ID.');
    }

    public function update(Request $request)
    {

        if ( $request->input('user_id') && $request->input('user_id') == Auth::id() ) {

           if( !$request->input("id") ) {
                return redirect()->route('dashboard')->with('failed','Post ID is missing.');
           }
            
            $country = Country::findOrFail($request->input("id"));
            $country->name = $request->input('name');
            $country->iso = $request->input('iso');

            $country->save();
            return redirect()->route('dashboard')->with('success','Country Has Been updated successfully');
        }
        else {

            return redirect()->route('dashboard')->with('failed','You cannot update a country you did not create.');
        }
    }


    public function destroy($id)
    {
        $country = Country::findOrFail($id);

        if($country->user_id == Auth::id()) {
            $country->delete();
            return redirect()->route('dashboard')->with('success','Country has been deleted successfully');
        }
        else {
            return redirect()->route('dashboard')->with('failed','You cannot delete a country you did not create');

        }
    }


}




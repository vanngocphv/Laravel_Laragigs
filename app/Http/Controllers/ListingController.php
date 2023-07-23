<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listing data in "/"
    public function index(){
        return view('listings.index', [
            // 'listings' => Listing::all()
            'listings' => Listing::latest()->filter(['tag' => request('tag'), 'search' => request('search')])->paginate(6)
        ]);
    }

    //show detail of a job post
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //show create form, create website
    public function create(){
        return view('listings.create');
    }


    //store data from form data when submit
    public function store(Request $request){
        $formValues = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('Listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //check if request has file include
        if($request->has('logo')){
            //set file name with path is /public/logos/filename.png
            $formValues['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $formValues['user_id'] = auth()->id();


        session('message', 'Create Successfully');
        Listing::create($formValues);
        
        return redirect('/')->with('message', 'Created Successfully');
    }

    //get request, send back a form
    public function edit(Listing $listing){

        //return view form
        return view('listings.edit', [ 'listing' => $listing ]);
    }

    //post request, send to database
    public function update(Request $request, Listing $listing){

        if($listing->user_id != auth()->id()){
            abort(403, "Unauthorized Action!");
        }

        $formValues = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //check if request has file include
        if($request->has('logo')){
            //set file name with path is /public/logos/filename.png
            $formValues['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formValues);

        
        return back()->with('message', 'Update Successfully');
    }

    //DELETE request, send request to delete record
    public function delete(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, "Unauthorized Action!");
        }

        $listing->delete();

        return redirect('/')->with('message', 'Deleted Successfully');
    }
}

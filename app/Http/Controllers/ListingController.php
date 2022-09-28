<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //
    public function index()
    {  
        // $listing = [];
        // if(request('tag')) {
        //      global $listing;
        //     $listing = Listing::where('tags', 'like', '%' . request('tag') . '%')
        //     // dd($listing);
        //     ->orderBy('created_at', 'desc')    
        //     ->paginate(2);
        // } else {
        //     global $listing;
        //     $listing = Listing::all();
        // }

        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }
    public function show(Listing $listing)
    {
 
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
    // public function example()
    // {
    //     $ans = Listing::all()->sortBy('-id');
    //     dd($ans);
    //     return view('test', [
    //         'listing' => $ans
    //     ]);
    // }

    // Show Create Form
    public function create() {
        return view('listings.create');
    }
   public function edit (Listing $listing) {

    return view('listings.edit', [
        'listing' => $listing
    ]);
   }
   public function update(Request $request, Listing $listing) {
    // Make sure logged in user is owner
    // if($listing->user_id != auth()->id()) {
    //     abort(403, 'Unauthorized Action');
    // }
    
    $formFields = $request->validate([
        'title' => 'required',
        'company' => ['required'],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required'
    ]);

    if($request->hasFile('logo')) {
        $formFields['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $listing->update($formFields);

    return back()->with('message', 'Listing updated successfully!');
}
    // Store Listing Data
    public function store(Request $request) {
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
      // dd($formFields);
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

public function destroy(Listing $listing) {
    // Make sure logged in user is owner
    if($listing->user_id != auth()->id()) {
        abort(403, 'Unauthorized Action');
    }
    
    $listing->delete();
    return redirect('/')->with('message', 'Listing deleted successfully');
}

    // Manage Listings
    public function manage() {
        $user = User::where('id',auth()->id())->first();
        $listings = $user->listings()
        ->orderBy('created_at',   'desc')
        ->get();
        return view('listings.manage', ['listings' => $listings]);
    }
}
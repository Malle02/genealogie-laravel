<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; 

class PersonController extends Controller 
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        $people = Person::with('createdBy')->paginate(10);
        return view('people.index', compact('people'));
    }

    public function show($id)
    {
        $person = Person::with(['parents', 'children'])->findOrFail($id);
        return view('people.show', compact('person'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);
    
        //  Formatage des noms 
        $firstName = ucfirst(strtolower($request->first_name));
        $middleNames = $request->middle_names ? implode(', ', array_map('ucfirst', explode(',', strtolower($request->middle_names)))) : null;
        $lastName = strtoupper($request->last_name);
        $birthName = $request->birth_name ? strtoupper($request->birth_name) : $lastName;
    
        Person::create([
            'created_by' => Auth::id(),
            'first_name' => $firstName,
            'middle_names' => $middleNames,
            'last_name' => $lastName,
            'birth_name' => $birthName,
            'date_of_birth' => $request->date_of_birth
        ]);
    
        return redirect()->route('people.index')->with('success', 'Personne ajoutée avec succès.');
    }
    
}
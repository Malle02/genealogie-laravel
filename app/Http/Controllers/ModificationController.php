<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modification;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class ModificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Proposition de modification
    public function propose(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:ajout_relation,modification_person',
            'person_id' => 'required|exists:people,id',
            'data' => 'required|array'
        ]);

        Modification::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'person_id' => $request->person_id,
            'data' => json_encode($request->data),
        ]);

        return redirect()->back()->with('success', 'Proposition soumise avec succès.');
    }

    // Vote pour une modification
    public function vote($id, $vote)
    {
        $modification = Modification::findOrFail($id);

        if ($modification->status !== 'pending') {
            return redirect()->back()->with('error', 'Cette modification a déjà été traitée.');
        }

        if ($vote == 'for') {
            $modification->votes_for++;
        } else {
            $modification->votes_against++;
        }

        //  Vérifier si 3 votes positifs ou négatifs 
        if ($modification->votes_for >= 3) {
            $modification->status = 'accepted';
            $this->applyModification($modification);
        } elseif ($modification->votes_against >= 3) {
            $modification->status = 'rejected';
        }

        $modification->save();
        return redirect()->back()->with('success', 'Votre vote a été pris en compte.');
    }

    //  modification acceptée
    private function applyModification(Modification $modification)
    {
        if ($modification->type == 'ajout_relation') {
            $data = json_decode($modification->data, true);
            DB::table('relationships')->insert([
                'created_by' => $modification->user_id,
                'parent_id' => $data['parent_id'],
                'child_id' => $data['child_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } elseif ($modification->type == 'modification_person') {
            Person::where('id', $modification->person_id)->update(json_decode($modification->data, true));
        }
    }
}
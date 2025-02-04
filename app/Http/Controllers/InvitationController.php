<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Invitation;
use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class InvitationController extends Controller
{
    public function invite(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'person_id' => 'required|exists:people,id'
        ]);

        Invitation::create([
            'inviter_id' => Auth::id(),
            'person_id' => $request->person_id,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Invitation envoyée avec succès.');
    }

    public function accept($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->update(['status' => 'accepted']);

        $user = Auth::user();
        $user->update(['person_id' => $invitation->person_id]);

        return redirect()->route('people.index')->with('success', 'Invitation acceptée.');
    }

    public function reject($id)
    {
        Invitation::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('error', 'Invitation refusée.');
    }

    public function index()
{
    $invitations = Invitation::where('email', Auth::user()->email)->where('status', 'pending')->get();
    return view('invitations.index', compact('invitations'));
}

}


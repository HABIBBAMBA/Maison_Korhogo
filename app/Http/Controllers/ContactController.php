<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // ── Formulaire de contact sur une annonce ──
    public function create($annonceId)
    {
        return view('pages.contact.create', [
            'annonceId' => $annonceId,
        ]);
    }

    // ── Enregistrer le message ──
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
            'id_bien' => 'required|exists:biens,id',
        ]);

        Contact::create($validated);

        return redirect()
            ->route('annonces.show', $validated['id_bien'])
            ->with('success', 'Votre message a bien été envoyé.');
    }

    // ── Dashboard : tous les contacts (protégé) ──
    public function index()
    {
        $contacts = Contact::with('bien')
            ->latest()
            ->paginate(15);

        return view('pages.contact.index', compact('contacts'));
    }

    // ── Dashboard : supprimer un contact ──
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact supprimé.');
    }
}

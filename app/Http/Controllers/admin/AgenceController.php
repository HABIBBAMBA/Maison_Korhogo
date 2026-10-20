<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agence;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    public function index(Request $request)
    {
        $query = Agence::withCount('biens');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom_agence', 'like', "%{$search}%")
                    ->orWhere('nom_responsable', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        $agences = $query->latest()->paginate(15)->withQueryString();

        return view('admin.agences.index', compact('agences'));
    }

    public function create()
    {
        return view('admin.agences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_agence' => 'required|string|max:255|unique:agences,nom_agence',
            'nom_responsable' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
        ]);

        $validated['id_user'] = auth()->id();

        Agence::create($validated);

        return redirect()->route('admin.agences.index')
            ->with('success', 'Agence créée avec succès.');
    }

    public function show(Agence $agence)
    {
        $agence->load('biens');

        return view('admin.agences.show', compact('agence'));
    }

    public function edit(Agence $agence)
    {
        return view('admin.agences.edit', compact('agence'));
    }

    public function update(Request $request, Agence $agence)
    {
        $validated = $request->validate([
            'nom_agence' => 'required|string|max:255|unique:agences,nom_agence,'.$agence->id,
            'nom_responsable' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
        ]);

        $agence->update($validated);

        return redirect()->route('admin.agences.index')
            ->with('success', 'Agence mise à jour.');
    }

    public function destroy(Agence $agence)
    {
        if ($agence->biens()->count() > 0) {
            return back()->with('error', "Impossible de supprimer « {$agence->nom_agence} » car elle contient encore des biens.");
        }

        $agence->delete();

        return redirect()->route('admin.agences.index')
            ->with('success', 'Agence supprimée.');
    }
}

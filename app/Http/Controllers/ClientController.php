<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $clients = Client::query()
            ->when($q, function ($query) use ($q) {
                $query->where('full_name', 'like', "%{$q}%")
                      ->orWhere('phone', 'like', "%{$q}%");
            })
            ->orderBy('full_name')
            ->paginate(15)
            ->withQueryString();

        return view('clients.index', compact('clients', 'q'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone'     => ['nullable', 'string', 'max:30'],
            'email'     => ['nullable', 'email', 'max:255'],
            'notes'     => ['nullable', 'string'],

            // ficha (opcional al crear cliente)
            'profile.base_level'               => ['nullable', 'integer', 'min:1', 'max:10'],
            'profile.goal_tone'                => ['nullable', 'string', 'max:255'],
            'profile.brand'                    => ['nullable', 'string', 'max:255'],
            'profile.color_code'               => ['nullable', 'string', 'max:50'],
            'profile.formula'                  => ['nullable', 'string'],
            'profile.developer_volume'         => ['nullable', 'integer', 'min:1', 'max:60'],
            'profile.ratio'                    => ['nullable', 'string', 'max:20'],
            'profile.processing_time_minutes'  => ['nullable', 'integer', 'min:1', 'max:600'],
            'profile.technique'                => ['nullable', 'string', 'max:255'],
            'profile.warnings'                 => ['nullable', 'string'],
            'profile.notes'                    => ['nullable', 'string'],
        ]);

        $client = Client::create($data);

        if ($request->filled('profile') && is_array($request->input('profile'))) {
            $profile = array_filter($request->input('profile'), fn($v) => $v !== null && $v !== '');
            if (!empty($profile)) {
                $client->coloProfile()->create($profile);
            }
        }

        return redirect()->route('clients.show', $client)->with('success', 'Cliente creado.');
    }

    public function show(Client $client)
    {
        $client->load('coloProfile');

        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $client->load('coloProfile');

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone'     => ['nullable', 'string', 'max:30'],
            'email'     => ['nullable', 'email', 'max:255'],
            'notes'     => ['nullable', 'string'],

            'profile.base_level'               => ['nullable', 'integer', 'min:1', 'max:10'],
            'profile.goal_tone'                => ['nullable', 'string', 'max:255'],
            'profile.brand'                    => ['nullable', 'string', 'max:255'],
            'profile.color_code'               => ['nullable', 'string', 'max:50'],
            'profile.formula'                  => ['nullable', 'string'],
            'profile.developer_volume'         => ['nullable', 'integer', 'min:1', 'max:60'],
            'profile.ratio'                    => ['nullable', 'string', 'max:20'],
            'profile.processing_time_minutes'  => ['nullable', 'integer', 'min:1', 'max:600'],
            'profile.technique'                => ['nullable', 'string', 'max:255'],
            'profile.warnings'                 => ['nullable', 'string'],
            'profile.notes'                    => ['nullable', 'string'],
        ]);

        $client->update($data);

        $profileInput = $request->input('profile', []);
        $profileClean = array_filter($profileInput, fn($v) => $v !== null && $v !== '');

        if (!empty($profileClean)) {
            $client->coloProfile()->updateOrCreate(
                ['client_id' => $client->id],
                $profileClean
            );
        }

        return redirect()->route('clients.show', $client)->with('success', 'Cliente actualizado.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Cliente eliminado.');
    }


    public function helper()
    {
        return view('help.index', [
            'title' => 'Ayuda'
        ]);
    }




}
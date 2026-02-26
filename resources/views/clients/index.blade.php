@extends('layouts.app')

@section('content')
<style>
    /* Importante para evitar “corridas” por overflow */
    html, body { overflow-x: hidden; }

    .wrap { max-width: 1100px; margin: 0 auto; padding: 18px 14px; width: 100%; }

    .topbar { display:flex; align-items:flex-end; justify-content:space-between; gap:12px; flex-wrap:wrap; }
    .title { margin:0; font-size: 26px; }
    .subtitle { color:#6b7280; font-size: 13px; margin-top:6px; }

    .searchbar{
    display:flex;
    gap:10px;
    align-items:center;
    flex-wrap:wrap;
    margin-top:14px;
    width:100%;
    }

    .search-input{
        flex: 1 1 auto;   /* <-- en vez de 520px */
        width: 100%;
        min-width: 0;
        height: 44px;
        min-height: 44px;
        padding: 0 12px;
        border:1px solid #d1d5db;
        border-radius:10px;
        outline:none;
        background:#fff;
        line-height: 44px;
        box-sizing: border-box; /* buena práctica */
    }

    .btn {
        display:inline-flex; align-items:center; justify-content:center;
        padding:10px 14px; border-radius:10px; text-decoration:none; font-weight:800;
        border:1px solid transparent; cursor:pointer;
        white-space: nowrap;
    }
    .btn-primary { background:#111827; color:#fff; }
    .btn-ghost { background:#fff; color:#111827; border-color:#e5e7eb; }
    .btn-soft { background:#f3f4f6; color:#111827; border-color:#e5e7eb; }
    .btn-sm { padding:8px 12px; border-radius:12px; font-size: 13px; }

    .grid {
        margin-top: 18px;
        display:grid;
        grid-template-columns: 1fr;
        gap: 14px;
        width: 100%;
    }
    @media(min-width: 680px){ .grid { grid-template-columns: 1fr 1fr; } }
    @media(min-width: 980px){ .grid { grid-template-columns: 1fr 1fr 1fr; } }

    @media (max-width: 520px){
        .searchbar { flex-direction: column; align-items: stretch; }

        .search-input{
            flex: 0 0 auto;  /* evita que crezca en altura */
        }

        .searchbar .btn { width: 100%; }
    }

    .card {
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:16px;
        padding:14px;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
        display:flex;
        flex-direction:column;
        gap:12px;
        min-height: 132px;
        width: 100%;
        min-width: 0;
    }

    .head { display:flex; align-items:flex-start; justify-content:space-between; gap:10px; }
    .who { display:flex; gap:10px; align-items:center; min-width: 0; }

    .avatar{
        width:42px; height:42px; border-radius:999px;
        display:flex; align-items:center; justify-content:center;
        background:#111827; color:#fff; font-weight:900;
        flex: 0 0 auto;
    }

    /* Aquí está el cambio clave: no uses max-width fijo en móvil */
    .name {
        margin:0;
        font-size: 16px;
        font-weight:900;
        color:#111827;
        line-height:1.2;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
        max-width: 100%;
    }

    .meta { color:#6b7280; font-size: 13px; margin-top:4px; display:flex; gap:10px; align-items:center; flex-wrap:wrap; }

    .badge{
        display:inline-flex; align-items:center;
        padding:6px 10px; border-radius:999px;
        font-size: 12px; font-weight:900;
        border:1px solid transparent;
        white-space: nowrap;
        flex: 0 0 auto;
    }
    .badge-ok{ background:#ecfdf5; border-color:#a7f3d0; color:#065f46; }
    .badge-no{ background:#fff7ed; border-color:#fed7aa; color:#9a3412; }

    .actions { margin-top:auto; display:flex; gap:10px; flex-wrap:wrap; align-items:center; }

    .empty {
        background:#fff;
        border:1px dashed #d1d5db;
        border-radius:16px;
        padding:18px;
        color:#6b7280;
        width: 100%;
    }

    /* MOBILE: usa todo el ancho y apila todo */
    @media (max-width: 520px){
        .wrap { padding: 14px 10px; max-width: 100%; }

        .topbar { flex-direction: column; align-items: stretch; }
        .topbar .btn-primary { width: 100%; }

        .searchbar { flex-direction: column; align-items: stretch; }
        .searchbar .btn { width: 100%; }

        .actions { flex-direction: row; }
        .actions .btn { flex: 1 1 auto; }
    }
</style>

<div class="wrap">
    <div class="topbar">
        <div>
            <h1 class="title">Clientes</h1>
            <div class="subtitle">Listado rápido para entrar a la ficha técnica.</div>
        </div>

        <a class="btn btn-primary" href="{{ route('clients.create') }}">+ Nuevo Cliente</a>
    </div>

    <form method="GET" action="{{ route('clients.index') }}" class="searchbar">
        <input class="search-input" type="text" name="q" value="{{ $q ?? '' }}" placeholder="Buscar por nombre o teléfono">
        <button class="btn btn-soft" type="submit">Buscar</button>
        @if(!empty($q))
            <a class="btn btn-ghost" href="{{ route('clients.index') }}">Limpiar</a>
        @endif
    </form>

    <div class="grid">
        @forelse($clients as $client)
            @php
                $p = $client->coloProfile ?? null;

                $parts = preg_split('/\s+/', trim($client->full_name ?? ''));
                $ini = '';
                if (!empty($parts[0])) $ini .= mb_substr($parts[0], 0, 1);
                if (!empty($parts[1])) $ini .= mb_substr($parts[1], 0, 1);
                $ini = mb_strtoupper($ini ?: 'C');
            @endphp

            <div class="card">
                <div class="head">
                    <div class="who">
                        <div class="avatar">{{ $ini }}</div>
                        <div style="min-width:0; width:100%;">
                            <p class="name" title="{{ $client->full_name }}">{{ $client->full_name }}</p>
                            <div class="meta">
                                <span>{{ $client->phone ?: 'Sin teléfono' }}</span>
                            </div>
                        </div>
                    </div>

                    <span class="badge {{ $p ? 'badge-ok' : 'badge-no' }}">
                        Ficha: {{ $p ? 'Sí' : 'No' }}
                    </span>
                </div>

                <div class="actions">
                    <a class="btn btn-ghost btn-sm" href="{{ route('clients.show', $client) }}">Ver ficha</a>
                    <a class="btn btn-soft btn-sm" href="{{ route('clients.edit', $client) }}">Editar</a>
                </div>
            </div>
        @empty
            <div class="empty">No hay clientes registrados.</div>
        @endforelse
    </div>

    <div style="margin-top:18px;">
        {{ $clients->links() }}
    </div>
</div>
@endsection
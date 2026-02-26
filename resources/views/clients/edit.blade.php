@extends('layouts.app')

@section('content')
<style>
    .page-title { margin:0 0 12px; font-size: 24px; }
    .form-actions{
        margin-top: 14px;
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        align-items:center;
        justify-content:flex-end;
    }
    .btn {
        display:inline-flex; align-items:center; justify-content:center;
        padding:10px 14px; border-radius:12px; text-decoration:none; font-weight:900;
        border:1px solid transparent; cursor:pointer;
    }
    .btn-primary { background:#2563eb; color:white; }
    .btn-ghost { background:#fff; color:#111827; border-color:#e5e7eb; }
    .btn-primary:hover { filter: brightness(.95); }
    .btn-ghost:hover { background:#f3f4f6; }
</style>

<div>
    <h1 class="page-title">Editar Cliente</h1>

    <form action="{{ route('clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')

        @include('clients.form', ['client' => $client])

        <div class="form-actions">
            <a class="btn btn-ghost" href="{{ route('clients.show', $client) }}">Volver</a>
            <button class="btn btn-primary" type="submit">Actualizar</button>
        </div>
    </form>
</div>
@endsection
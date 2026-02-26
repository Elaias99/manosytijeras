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
    <h1 class="page-title">Crear Cliente</h1>

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        @include('clients.form', ['client' => null])

        <div class="form-actions">
            <a class="btn btn-ghost" href="{{ route('clients.index') }}">Volver</a>
            <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </form>
</div>
@endsection
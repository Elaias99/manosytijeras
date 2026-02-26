@extends('layouts.app')

@section('content')
@php
    $p = $client->coloProfile;
@endphp

<style>
    .wrap { max-width: 980px; margin: 0 auto; }
    .header {
        display:flex; align-items:center; justify-content:space-between; gap:12px;
        margin-bottom: 14px;
    }
    .title { margin:0; font-size: 22px; }
    .btn {
        display:inline-flex; align-items:center; justify-content:center;
        padding:10px 14px; border-radius:10px; text-decoration:none; font-weight:600;
        border:1px solid transparent;
    }
    .btn-primary { background:#2563eb; color:white; }
    .btn-ghost { background:#ffffff; color:#111827; border-color:#e5e7eb; }
    .btn-warn { background:#f97316; color:white; }

    .grid {
        display:grid; grid-template-columns:1fr; gap:12px;
    }
    @media(min-width: 900px){
        .grid { grid-template-columns: 1.2fr 0.8fr; }
    }

    .card {
        background:white; border:1px solid #e5e7eb; border-radius:14px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        padding:16px;
    }
    .section-title {
        margin:0 0 10px; font-size: 16px; color:#111827;
        display:flex; align-items:center; gap:8px;
    }
    .muted { color:#6b7280; font-size: 13px; margin-top:6px; }
    .chips { display:flex; flex-wrap:wrap; gap:8px; margin-top:8px; }
    .chip {
        background:#f3f4f6; border:1px solid #e5e7eb; color:#111827;
        padding:6px 10px; border-radius:999px; font-size: 13px; font-weight:600;
    }
    .chip-strong { background:#eef2ff; border-color:#c7d2fe; color:#1e3a8a; }
    .chip-warn { background:#fff7ed; border-color:#fed7aa; color:#9a3412; }
    .kv { display:grid; grid-template-columns: 140px 1fr; gap:8px 12px; }
    @media(min-width: 520px){ .kv { grid-template-columns: 160px 1fr; } }
    .k { color:#6b7280; font-size: 13px; }
    .v { color:#111827; font-weight:600; font-size: 14px; }
    .divider { height:1px; background:#e5e7eb; margin:14px 0; }

    .formula-box {
        background:#0b1220; color:#f9fafb; border-radius:14px;
        padding:14px; border:1px solid #111827;
    }
    .formula-label { font-size: 12px; color:#cbd5e1; margin-bottom:6px; }
    .formula-text { white-space: pre-wrap; font-size: 15px; line-height: 1.4; font-weight:700; }

    .row-actions { display:flex; gap:10px; flex-wrap:wrap; margin-top:12px; }

    .toast {
        position: fixed; left: 50%; transform: translateX(-50%);
        bottom: 18px; background:#111827; color:#fff; padding:10px 12px;
        border-radius:12px; font-size: 13px; display:none;
        box-shadow: 0 8px 20px rgba(0,0,0,0.18);
    }

    /* Notes */
    .note-grid { display:grid; grid-template-columns: 1fr; gap: 12px; }
    @media(min-width: 900px){
        .note-grid { grid-template-columns: 1fr 1fr; }
    }
    .note-span { grid-column: 1 / -1; }

    .note-box {
        border-radius: 14px;
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        background: #fff;
    }
    .note-box.warn { background:#fff7ed; border-color:#fed7aa; }
    .note-box.tech { background:#f8fafc; border-color:#e5e7eb; }

    .note-title {
        margin:0 0 8px;
        font-size: 14px;
        font-weight: 800;
        display:flex;
        align-items:center;
        gap:8px;
        color:#0f172a;
    }
    .note-title.warn { color:#9a3412; }

    .note-text {
        margin:0;
        white-space: pre-wrap;
        color:#111827;
        line-height: 1.5;
        font-size: 14px;
    }
</style>

<div class="wrap">
    <div class="header">
        <div>
            <h1 class="title">Ficha de Cliente</h1>
            <div class="muted">{{ $client->full_name }}</div>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a class="btn btn-ghost" href="{{ route('clients.index') }}">Volver</a>
            <a class="btn btn-primary" href="{{ route('clients.edit', $client) }}">Editar</a>
        </div>
    </div>

    <div class="grid">
        {{-- Columna izquierda: RECETA --}}
        <div class="card">
            <h2 class="section-title">Receta / Ficha Técnica</h2>

            @if($p)
                <div class="chips">
                    <span class="chip chip-strong">Oxidante: {{ $p->developer_volume ? $p->developer_volume.' vol' : '—' }}</span>
                    <span class="chip chip-strong">Proporción: {{ $p->ratio ?? '—' }}</span>
                    <span class="chip chip-strong">Tiempo: {{ $p->processing_time_minutes ? $p->processing_time_minutes.' min' : '—' }}</span>
                    @if($p->base_level)
                        <span class="chip">Nivel base: {{ $p->base_level }}</span>
                    @endif
                    @if($p->color_code)
                        <span class="chip">Código: {{ $p->color_code }}</span>
                    @endif
                </div>

                <div class="divider"></div>

                <div class="formula-box">
                    <div class="formula-label">FÓRMULA / MEZCLA</div>
                    <div class="formula-text" id="formulaText">{{ $p->formula ?? '—' }}</div>
                </div>

                <div class="row-actions">
                    <button type="button" class="btn btn-ghost" id="copyFormulaBtn">Copiar fórmula</button>
                </div>

                <div class="divider"></div>

                <div class="kv">
                    <div class="k">Tono objetivo</div>
                    <div class="v">{{ $p->goal_tone ?? '—' }}</div>

                    <div class="k">Marca / Línea</div>
                    <div class="v">{{ $p->brand ?? '—' }}</div>

                    <div class="k">Código de color</div>
                    <div class="v">{{ $p->color_code ?? '—' }}</div>

                    <div class="k">Aplicación / Técnica</div>
                    <div class="v">{{ $p->technique ?? '—' }}</div>
                </div>

                {{-- Notas/Advertencias + Notas técnicas + Notas generales (lado a lado) --}}
                @if(!blank($p->warnings) || !blank($p->notes) || !blank($client->notes))
                    <div class="divider"></div>

                    <div class="note-grid">
                        @if(!blank($p->warnings))
                            <div class="note-box warn note-span">
                                <h3 class="note-title warn">⚠️ Advertencias</h3>
                                <p class="note-text">{{ trim($p->warnings) }}</p>
                            </div>
                        @endif

                        @if(!blank($p->notes))
                            <div class="note-box tech">
                                <h3 class="note-title">📝 Notas técnicas</h3>
                                <p class="note-text">{{ trim($p->notes) }}</p>
                            </div>
                        @endif

                        @if(!blank($client->notes))
                            <div class="note-box tech">
                                <h3 class="note-title">🗒️ Notas generales</h3>
                                <p class="note-text">{{ trim($client->notes) }}</p>
                            </div>
                        @endif
                    </div>
                @endif

            @else
                <div style="background:#fff7ed; border:1px solid #fed7aa; padding:14px; border-radius:12px;">
                    <div style="font-weight:700; color:#9a3412; margin-bottom:6px;">Sin ficha técnica</div>
                    <div style="color:#9a3412;">Este cliente aún no tiene receta registrada.</div>

                    <div class="row-actions">
                        <a class="btn btn-warn" href="{{ route('clients.edit', $client) }}">Crear ficha</a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Columna derecha: Datos del cliente --}}
        <div class="card">
            <h2 class="section-title">Datos del cliente</h2>

            <div class="kv">
                <div class="k">Nombre</div>
                <div class="v">{{ $client->full_name }}</div>

                <div class="k">Teléfono</div>
                <div class="v">
                    {{ $client->phone ?? '—' }}
                    @if($client->phone)
                        <div class="muted">Tip: úsalo para buscar rápido.</div>
                    @endif
                </div>

                <div class="k">Email</div>
                <div class="v">{{ $client->email ?? '—' }}</div>
            </div>

            {{-- Ya no se muestra "Notas generales" aquí, porque ahora queda al lado de "Notas técnicas" --}}
        </div>
    </div>
</div>

<div class="toast" id="toast">Copiado ✅</div>

<script>
(function(){
    const btn = document.getElementById('copyFormulaBtn');
    const textEl = document.getElementById('formulaText');
    const toast = document.getElementById('toast');

    function showToast(msg){
        if(!toast) return;
        toast.textContent = msg || 'Listo ✅';
        toast.style.display = 'block';
        setTimeout(() => toast.style.display = 'none', 1400);
    }

    btn?.addEventListener('click', async () => {
        const txt = textEl?.innerText?.trim();
        if(!txt || txt === '—') return showToast('No hay fórmula para copiar');
        try{
            await navigator.clipboard.writeText(txt);
            showToast('Copiado ✅');
        }catch(e){
            const ta = document.createElement('textarea');
            ta.value = txt;
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            document.body.removeChild(ta);
            showToast('Copiado ✅');
        }
    });
})();
</script>
@endsection
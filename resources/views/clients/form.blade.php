@php
    $profile = $client?->coloProfile;
@endphp

<style>
    .grid2 { display:grid; grid-template-columns:1fr; gap:12px; }
    @media(min-width: 768px){ .grid2 { grid-template-columns:1fr 1fr; } }
    .card { background:#fff; border:1px solid #e5e7eb; border-radius:10px; padding:16px; }
    label { display:block; font-weight:600; margin-bottom:6px; }
    input, select, textarea { width:100%; padding:10px; border:1px solid #d1d5db; border-radius:8px; }
    textarea { min-height: 90px; }
    .hint { font-size:12px; color:#6b7280; margin-top:6px; }
</style>

<div class="card" style="margin-bottom:14px;">
    <h3 style="margin:0 0 12px;">Datos del Cliente</h3>

    <div class="grid2">
        <div>
            <label>Nombre</label>
            <input type="text" name="full_name" placeholder="Ej: Camila Rojas"
                   value="{{ old('full_name', $client->full_name ?? '') }}">
        </div>

        <div>
            <label>Teléfono</label>
            <input type="text" name="phone" placeholder="+569..."
                   value="{{ old('phone', $client->phone ?? '') }}">
            <div class="hint">Recomendado para búsqueda rápida.</div>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" placeholder="opcional"
                   value="{{ old('email', $client->email ?? '') }}">
        </div>

        <div>
            <label>Notas generales</label>
            <textarea name="notes" placeholder="Preferencias, sensibilidad, alergias, observaciones...">{{ old('notes', $client->notes ?? '') }}</textarea>
        </div>
    </div>
</div>

<div class="card">
    <h3 style="margin:0 0 6px;">Ficha Técnica de Color</h3>
    <div class="hint" style="margin-bottom:12px;">
        Receta base del cliente: códigos, fórmula, oxidante, tiempos y observaciones.
    </div>

    <div class="grid2">
        <div>
            <label>Nivel base (1–10)</label>
            <select name="profile[base_level]" id="base_level">
                <option value="">—</option>
                @for($i=1;$i<=10;$i++)
                    <option value="{{ $i }}"
                        @selected(old('profile.base_level', $profile->base_level ?? '') == $i)>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            <div class="hint">referencia de altura de tono.</div>
        </div>

        <div>
            <label>Tono objetivo</label>
            <input type="text" name="profile[goal_tone]" id="goal_tone"
                   placeholder="Ej: Rubio dorado, Ceniza, Cobre, Chocolate..."
                   value="{{ old('profile.goal_tone', $profile->goal_tone ?? '') }}">
        </div>

        <div>
            <label>Marca / Línea </label>
            <input list="brandList" name="profile[brand]" id="brand"
                   placeholder="Ej: (marca/línea utilizada)"
                   value="{{ old('profile.brand', $profile->brand ?? '') }}">
            <datalist id="brandList">
                {{-- Sugerencias (se pueden ajustar más adelante según el salón) --}}
                <option value="Wella Koleston Perfect">
                <option value="Wella Color Touch">
                <option value="L'Oréal Professionnel Majirel">
                <option value="L'Oréal Dia Light">
                <option value="Schwarzkopf Igora Royal">
                <option value="Alfaparf Evolution of the Color">
                <option value="Pichara (línea utilizada)">
            </datalist>
            <div class="hint">Registrar la marca o línea profesional utilizada en la fórmula.</div>
        </div>

        <div>
            <label>Código de color (opcional)</label>
            <input type="text" name="profile[color_code]" id="color_code"
                   placeholder="Ej: 9/3, 7.43, 6-88, 10/81"
                   value="{{ old('profile.color_code', $profile->color_code ?? '') }}">
        </div>

        <div style="grid-column: 1 / -1;">
            <label>Fórmula (mezcla)</label>
            <textarea name="profile[formula]" id="formula"
                      placeholder="Ej: 30g X + 30g Y; detallar por zonas si aplica.">{{ old('profile.formula', $profile->formula ?? '') }}</textarea>
            <div class="hint">Puedes detallar por zonas: “Raíz: … / Medios: … / Puntas: …”.</div>
        </div>

        <div>
            <label>Volumen oxidante</label>

            <input type="text"
                name="profile[developer_volume]"
                placeholder="Ej: 20%, 12%, 3%, 1.9%"
                value="{{ old('profile.developer_volume', $profile->developer_volume ?? '') }}">

            <div class="hint">
                Puedes indicar volumen o porcentaje según la línea utilizada.
            </div>
        </div>

        <div>
            <label>Proporción</label>

            <input type="text"
                name="profile[ratio]"
                placeholder="Ej: 1:1, 1:1.5, 1:2"
                value="{{ old('profile.ratio', $profile->ratio ?? '') }}">

            <div class="hint">
                Relación color/oxidante según especificación del fabricante.
            </div>
        </div>

        <div>
            <label>Tiempo de exposición (minutos)</label>

            <input type="number"
                name="profile[processing_time_minutes]"
                min="0"
                placeholder="Ej: 35"
                value="{{ old('profile.processing_time_minutes', $profile->processing_time_minutes ?? '') }}">

            <div class="hint">
                Tiempo recomendado según diagnóstico y línea utilizada.
            </div>
        </div>

        <div>
            <label>Aplicación / Técnica</label>
            <input type="text" name="profile[technique]" id="technique"
                   placeholder="Ej: raíz, global, matiz, seccionado, etc."
                   value="{{ old('profile.technique', $profile->technique ?? '') }}">
            <div class="hint">Describe la forma de aplicación utilizada en este cliente</div>
        </div>

        <div style="grid-column: 1 / -1;">
            <label>Advertencias</label>
            <textarea name="profile[warnings]" placeholder="Ej: cuero cabelludo sensible / porosidad alta / evitar X vol...">{{ old('profile.warnings', $profile->warnings ?? '') }}</textarea>
        </div>

        <div style="grid-column: 1 / -1;">
            <label>Notas técnicas</label>
            <textarea name="profile[notes]" placeholder="Observaciones, ajustes recomendados, mantenimiento, etc.">{{ old('profile.notes', $profile->notes ?? '') }}</textarea>
        </div>
    </div>
</div>

<script>
    function bindSelectToInput(selectId, inputId) {
        const select = document.getElementById(selectId);
        const input = document.getElementById(inputId);

        if (!select || !input) return;

        select.addEventListener('change', function () {
            if (this.value && this.value !== 'custom') {
                input.value = this.value;
            }
        });
    }

    bindSelectToInput('developer_volume_select', 'developer_volume_input');
    bindSelectToInput('ratio_select', 'ratio_input');
    bindSelectToInput('time_select', 'time_input');
</script>
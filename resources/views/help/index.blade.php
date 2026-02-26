@extends('layouts.app')

@section('content')
<style>
  .help-wrap{ max-width: 980px; margin: 0 auto; }
  .help-shell{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:18px;
    box-shadow: 0 2px 10px rgba(0,0,0,.04);
    overflow:hidden;
  }
  .help-head{
    padding:18px 18px 14px;
    border-bottom:1px solid #e5e7eb;
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:12px;
    flex-wrap:wrap;
  }
  .help-title{ margin:0; font-size: 22px; letter-spacing:.2px; }
  .help-sub{ margin:6px 0 0; color:#6b7280; font-size: 14px; line-height:1.5; max-width: 680px; }

  .help-actions{ display:flex; gap:10px; flex-wrap:wrap; }
  .btn{
    display:inline-flex; align-items:center; justify-content:center;
    padding:10px 14px; border-radius:12px; text-decoration:none; font-weight:900;
    border:1px solid #e5e7eb; background:#fff; color:#111827;
    cursor:pointer;
  }
  .btn:hover{ background:#f3f4f6; }
  .btn-primary{ background:#111827; border-color:#111827; color:#fff; }
  .btn-primary:hover{ filter: brightness(.95); }

  .help-body{ padding: 14px 14px 18px; }

  /* Cards/Accordion */
  .acc{
    display:flex; flex-direction:column; gap:10px;
  }
  .acc-item{
    border:1px solid #e5e7eb;
    border-radius:16px;
    overflow:hidden;
    background:#fff;
  }
  .acc-btn{
    width:100%;
    background:#fff;
    border:0;
    padding:14px 14px;
    text-align:left;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
  }
  .acc-btn:focus{ outline: 3px solid rgba(37,99,235,.18); outline-offset: 0; }
  .acc-left{
    display:flex; align-items:flex-start; gap:12px; min-width:0;
  }
  .acc-num{
    width:34px; height:34px;
    border-radius:12px;
    background:#f3f4f6;
    border:1px solid #e5e7eb;
    display:flex; align-items:center; justify-content:center;
    font-weight:900;
    color:#111827;
    flex: 0 0 auto;
  }
  .acc-titlewrap{ min-width:0; }
  .acc-title{
    margin:0;
    font-size: 15px;
    font-weight: 900;
    color:#111827;
  }
  .acc-mini{
    margin-top:4px;
    color:#6b7280;
    font-size: 13px;
    line-height:1.4;
  }
  .acc-icon{
    width: 34px; height: 34px;
    border-radius: 12px;
    border:1px solid #e5e7eb;
    background:#fff;
    display:flex; align-items:center; justify-content:center;
    font-weight:900;
    color:#111827;
    flex: 0 0 auto;
    user-select:none;
    transition: transform .18s ease;
  }

  .acc-panel{
    display:none;
    padding: 0 14px 14px;
  }
  .acc-item[data-open="true"] .acc-panel{ display:block; }
  .acc-item[data-open="true"] .acc-icon{ transform: rotate(45deg); }

  .help-list{ margin:10px 0 0; padding-left:18px; line-height:1.7; }
  .help-list li{ margin: 4px 0; }

  .callout{
    margin-top:12px;
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:12px 14px;
    color:#111827;
    line-height:1.6;
  }
  .callout strong{ font-weight:900; }

  /* Quick strip */
  .quick{
    margin: 14px 0 10px;
    display:grid;
    grid-template-columns: 1fr;
    gap:10px;
  }
  @media(min-width: 860px){
    .quick{ grid-template-columns: 1fr 1fr 1fr; }
  }
  .quick-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:16px;
    padding:12px 14px;
  }
  .quick-h{ margin:0; font-weight:900; font-size: 14px; }
  .quick-p{ margin:6px 0 0; color:#6b7280; font-size: 13px; line-height:1.5; }

  /* Mobile spacing */
  @media(max-width: 520px){
    .help-head{ padding:16px 14px 12px; }
    .help-body{ padding: 12px 12px 16px; }
    .acc-btn{ padding: 12px; }
    .acc-panel{ padding: 0 12px 12px; }
  }
</style>

<div class="help-wrap">
  <div class="help-shell">
    <div class="help-head">
      <div>
        <h1 class="help-title">Cómo usar el sistema</h1>
        <p class="help-sub">
          Esta herramienta guarda la ficha técnica de color de cada clienta para repetir resultados con consistencia.
          Sirve para atender correctamente incluso cuando el dueño no está.
        </p>
      </div>

      <div class="help-actions">
        <a class="btn" href="{{ route('clients.index') }}">Ir a clientes</a>
        <button class="btn btn-primary" type="button" id="expandAllBtn">Expandir todo</button>
      </div>
    </div>

    <div class="help-body">

      <div class="quick">
        <div class="quick-card">
          <p class="quick-h">Objetivo</p>
          <p class="quick-p">Encontrar a la clienta y seguir la receta registrada sin improvisar.</p>
        </div>
        <div class="quick-card">
          <p class="quick-h">Dónde mirar primero</p>
          <p class="quick-p">Fórmula, oxidante, proporción, tiempo y advertencias.</p>
        </div>
        <div class="quick-card">
          <p class="quick-h">Si falta información</p>
          <p class="quick-p">No inventar. Registrar nota y consultar al dueño.</p>
        </div>
      </div>

      <div class="acc" id="helpAcc">

        <div class="acc-item" data-open="true">
          <button class="acc-btn" type="button">
            <div class="acc-left">
              <div class="acc-num">1</div>
              <div class="acc-titlewrap">
                <p class="acc-title">Buscar una clienta</p>
                <div class="acc-mini">Cómo encontrar rápido por nombre o teléfono.</div>
              </div>
            </div>
            <div class="acc-icon">+</div>
          </button>
          <div class="acc-panel">
            <ol class="help-list">
              <li>Entra a “Clientes”.</li>
              <li>Escribe el nombre o el teléfono en la búsqueda.</li>
              <li>Presiona “Buscar”.</li>
              <li>Abre “Ver ficha”.</li>
            </ol>
            <div class="callout"><strong>Consejo:</strong> el teléfono suele ser la forma más rápida de encontrar a alguien.</div>
          </div>
        </div>

        <div class="acc-item" data-open="false">
          <button class="acc-btn" type="button">
            <div class="acc-left">
              <div class="acc-num">2</div>
              <div class="acc-titlewrap">
                <p class="acc-title">Leer la ficha técnica</p>
                <div class="acc-mini">Qué datos revisar para evitar errores.</div>
              </div>
            </div>
            <div class="acc-icon">+</div>
          </button>
          <div class="acc-panel">
            <ul class="help-list">
              <li>La fórmula es lo principal. Seguir exactamente lo escrito.</li>
              <li>Revisar oxidante, proporción y tiempo antes de aplicar.</li>
              <li>Leer “Advertencias” para evitar errores o daños.</li>
              <li>Leer “Notas técnicas” si hay ajustes por zonas o recomendaciones.</li>
              <li>Leer “Notas generales” si hay preferencias de la clienta.</li>
            </ul>
          </div>
        </div>

        <div class="acc-item" data-open="false">
          <button class="acc-btn" type="button">
            <div class="acc-left">
              <div class="acc-num">3</div>
              <div class="acc-titlewrap">
                <p class="acc-title">Crear una ficha para una clienta nueva</p>
                <div class="acc-mini">Registrar datos básicos y, si existe, la receta.</div>
              </div>
            </div>
            <div class="acc-icon">+</div>
          </button>
          <div class="acc-panel">
            <ol class="help-list">
              <li>Entra a “Nuevo Cliente”.</li>
              <li>Completa nombre y teléfono (lo demás es opcional).</li>
              <li>Si se conoce la receta, completa la ficha técnica.</li>
              <li>Presiona “Guardar”.</li>
            </ol>
            <div class="callout"><strong>Importante:</strong> si no se conoce la receta, se puede guardar la clienta sin ficha y completarla después.</div>
          </div>
        </div>

        <div class="acc-item" data-open="false">
          <button class="acc-btn" type="button">
            <div class="acc-left">
              <div class="acc-num">4</div>
              <div class="acc-titlewrap">
                <p class="acc-title">Editar una ficha existente</p>
                <div class="acc-mini">Actualizar información sin borrar lo útil.</div>
              </div>
            </div>
            <div class="acc-icon">+</div>
          </button>
          <div class="acc-panel">
            <ol class="help-list">
              <li>Abre la clienta y entra a “Editar”.</li>
              <li>Actualiza solo lo que cambió.</li>
              <li>Presiona “Actualizar”.</li>
            </ol>
            <div class="callout"><strong>Regla:</strong> si hay dudas, dejar una nota y consultar al dueño.</div>
          </div>
        </div>

        <div class="acc-item" data-open="false">
          <button class="acc-btn" type="button">
            <div class="acc-left">
              <div class="acc-num">5</div>
              <div class="acc-titlewrap">
                <p class="acc-title">Qué hacer si falta información</p>
                <div class="acc-mini">Cómo actuar si la receta no está completa.</div>
              </div>
            </div>
            <div class="acc-icon">+</div>
          </button>
          <div class="acc-panel">
            <ul class="help-list">
              <li>Si la receta no está clara, no improvisar.</li>
              <li>Registrar lo que se observó en “Notas técnicas” o “Notas generales”.</li>
              <li>Consultar al dueño antes de tomar una decisión técnica.</li>
            </ul>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<script>
(function(){
  const acc = document.getElementById('helpAcc');
  const expandAllBtn = document.getElementById('expandAllBtn');
  if(!acc) return;

  const items = Array.from(acc.querySelectorAll('.acc-item'));

  function setOpen(item, open){
    item.setAttribute('data-open', open ? 'true' : 'false');
  }

  // Toggle por click (solo uno a la vez en móvil ayuda a no saturar)
  acc.addEventListener('click', (e) => {
    const btn = e.target.closest('.acc-btn');
    if(!btn) return;
    const item = btn.closest('.acc-item');
    if(!item) return;

    const isOpen = item.getAttribute('data-open') === 'true';

    // En pantallas pequeñas, cerramos los otros para reducir ruido visual
    if (window.matchMedia('(max-width: 720px)').matches) {
      items.forEach(it => setOpen(it, false));
      setOpen(item, !isOpen);
    } else {
      setOpen(item, !isOpen);
    }

    updateExpandAllText();
  });

  function updateExpandAllText(){
    const openCount = items.filter(it => it.getAttribute('data-open') === 'true').length;
    if(expandAllBtn){
      expandAllBtn.textContent = (openCount === items.length) ? 'Colapsar todo' : 'Expandir todo';
    }
  }

  // Expandir / colapsar todo
  expandAllBtn?.addEventListener('click', () => {
    const allOpen = items.every(it => it.getAttribute('data-open') === 'true');
    items.forEach(it => setOpen(it, !allOpen));
    updateExpandAllText();
  });

  updateExpandAllText();
})();
</script>
@endsection
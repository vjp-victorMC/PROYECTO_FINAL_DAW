@extends('layouts.app')

@section('content')
<style>
    .dash { display: grid; grid-template-columns: 220px 1fr; min-height: 700px; border: 1px solid #1f2937; border-radius: 12px; overflow: hidden; background: #111827; }
    .sidebar { background: #0f172a; border-right: 1px solid #1f2937; padding: 1rem 0; display: flex; flex-direction: column; gap: 2px; }
    .sidebar-brand { padding: 0 1rem 1rem; border-bottom: 1px solid #1f2937; margin-bottom: 0.5rem; }
    .sidebar-brand h2 { font-size: 14px; font-weight: 600; color: #f9fafb; line-height: 1.3; }
    .sidebar-brand p { font-size: 11px; color: #6b7280; }
    .nav-item { display: flex; align-items: center; gap: 10px; padding: 8px 1rem; font-size: 13px; color: #9ca3af; cursor: pointer; border-radius: 0; transition: background .15s; position: relative; text-decoration: none; }
    .nav-item:hover { background: #1f2937; color: #f9fafb; }
    .nav-item.active { background: #1f2937; color: #3b82f6; font-weight: 600; }
    .nav-item.active::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background: #3b82f6; border-radius: 0 2px 2px 0; }
    .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }
    .nav-badge { margin-left: auto; background: #ef4444; color: #fff; font-size: 10px; font-weight: 600; padding: 1px 6px; border-radius: 20px; }
    .nav-section { font-size: 10px; font-weight: 600; color: #4b5563; padding: 8px 1rem 4px; text-transform: uppercase; letter-spacing: .08em; margin-top: 6px; }
    .main { display: flex; flex-direction: column; overflow: hidden; }
    .topbar { display: flex; align-items: center; justify-content: space-between; padding: 12px 1.5rem; border-bottom: 1px solid #1f2937; }
    .topbar h1 { font-size: 16px; font-weight: 600; color: #f9fafb; }
    .topbar-actions { display: flex; align-items: center; gap: 8px; }
    .btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; font-size: 13px; border-radius: 8px; border: 1px solid #374151; background: transparent; color: #d1d5db; cursor: pointer; transition: background .15s; }
    .btn:hover { background: #1f2937; }
    .btn-primary { background: #1d4ed8; color: #fff; border-color: #1d4ed8; }
    .btn-primary:hover { background: #1e40af; border-color: #1e40af; }
    .btn-sm { padding: 4px 10px; font-size: 12px; }
    .btn-danger { background: #7f1d1d; color: #fca5a5; border-color: #7f1d1d; }
    .content { flex: 1; overflow-y: auto; padding: 1.5rem; }
    .panel { display: none; }
    .panel.active { display: block; }
    .kpi-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 1.5rem; }
    .kpi { background: #1f2937; border-radius: 8px; padding: 1rem; display: flex; flex-direction: column; gap: 4px; }
    .kpi-label { font-size: 12px; color: #6b7280; }
    .kpi-value { font-size: 22px; font-weight: 600; color: #f9fafb; }
    .kpi-delta { font-size: 12px; }
    .kpi-delta.up { color: #4ade80; }
    .kpi-delta.warn { color: #fbbf24; }
    .kpi-delta.down { color: #f87171; }
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .card { background: #1f2937; border: 1px solid #374151; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1rem; }
    .card-last { margin-bottom: 0; }
    .card-title { font-size: 13px; font-weight: 600; color: #9ca3af; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .card-title svg { width: 16px; height: 16px; }
    .cal-header { display: grid; grid-template-columns: repeat(5, 1fr); gap: 4px; margin-bottom: 6px; }
    .cal-day-label { font-size: 11px; color: #6b7280; text-align: center; padding: 4px; }
    .cal-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 4px; }
    .cal-slot { min-height: 64px; border-radius: 8px; border: 1px solid #374151; padding: 4px; display: flex; flex-direction: column; gap: 3px; cursor: pointer; }
    .cal-slot:hover { border-color: #3b82f6; }
    .appt { border-radius: 4px; padding: 3px 5px; font-size: 10px; font-weight: 600; line-height: 1.3; cursor: grab; }
    .appt.mecanica-rapida { background: #1e3a5f; color: #93c5fd; }
    .appt.mecanica-compleja { background: #4c1d1d; color: #fca5a5; }
    .appt.diagnostico { background: #14532d; color: #86efac; }
    .appt.recogida { background: #451a03; color: #fcd34d; }
    .appt-empty { border: 1px dashed #374151; background: transparent; color: #4b5563; font-size: 10px; text-align: center; padding: 6px 4px; border-radius: 4px; min-height: 28px; }
    .box-badges { display: flex; gap: 4px; flex-wrap: wrap; margin-bottom: 8px; }
    .box-badge { padding: 2px 8px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .box-free { background: #14532d; color: #4ade80; }
    .box-busy { background: #4c1d1d; color: #f87171; }
    .box-partial { background: #451a03; color: #fbbf24; }
    .or-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .or-table th { font-size: 11px; font-weight: 600; color: #6b7280; padding: 6px 8px; border-bottom: 1px solid #374151; text-align: left; }
    .or-table td { padding: 8px; border-bottom: 1px solid #1f2937; color: #d1d5db; }
    .or-table tr:last-child td { border-bottom: none; }
    .status-pill { display: inline-flex; align-items: center; gap: 4px; padding: 2px 8px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .s-espera { background: #451a03; color: #fbbf24; }
    .s-reparando { background: #1e3a5f; color: #93c5fd; }
    .s-prueba { background: #14532d; color: #4ade80; }
    .s-entrega { background: #2e1065; color: #c4b5fd; }
    .notif-list { display: flex; flex-direction: column; gap: 0; }
    .notif { display: flex; align-items: flex-start; gap: 10px; padding: 10px 0; border-bottom: 1px solid #374151; }
    .notif:last-child { border-bottom: none; }
    .notif-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .notif-icon svg { width: 16px; height: 16px; }
    .notif-icon.warn { background: #451a03; color: #fbbf24; }
    .notif-icon.info { background: #1e3a5f; color: #93c5fd; }
    .notif-icon.promo { background: #2e1065; color: #c4b5fd; }
    .notif-icon.ok { background: #14532d; color: #4ade80; }
    .notif-body p { font-size: 13px; color: #d1d5db; line-height: 1.4; }
    .notif-body p strong { color: #f9fafb; }
    .notif-body span { font-size: 11px; color: #6b7280; }
    .notif-actions { margin-left: auto; display: flex; gap: 6px; align-items: center; flex-shrink: 0; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .form-field { display: flex; flex-direction: column; gap: 4px; }
    .form-field label { font-size: 12px; color: #9ca3af; }
    .form-field input, .form-field select { padding: 7px 10px; border-radius: 8px; border: 1px solid #374151; background: #111827; color: #f9fafb; font-size: 13px; font-family: inherit; }
    .form-field input:focus, .form-field select:focus { outline: none; border-color: #3b82f6; }
    .form-field select option { background: #1f2937; }
    .presup-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 1rem; }
    .presup-table th { font-size: 11px; font-weight: 600; color: #6b7280; padding: 6px 8px; border-bottom: 1px solid #374151; text-align: left; }
    .presup-table td { padding: 8px; border-bottom: 1px solid #374151; color: #d1d5db; }
    .presup-table input { width: 100%; border: none; background: transparent; font-size: 13px; color: #f9fafb; font-family: inherit; }
    .presup-total { display: flex; justify-content: flex-end; gap: 2rem; align-items: center; padding: 12px 0; color: #9ca3af; font-size: 14px; }
    .presup-total-value { font-size: 20px; font-weight: 700; color: #f9fafb; }
    .factura-row { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 1px solid #374151; font-size: 13px; }
    .factura-row:last-child { border-bottom: none; }
    .factura-id { font-weight: 600; color: #f9fafb; width: 90px; }
    .factura-cliente { flex: 1; color: #9ca3af; }
    .factura-importe { font-weight: 600; color: #f9fafb; width: 80px; text-align: right; }
    .factura-estado { width: 110px; text-align: right; font-size: 12px; font-weight: 600; }
    .impagado { color: #f87171; }
    .cobrado { color: #4ade80; }
    .pendiente { color: #fbbf24; }
    .tab-bar { display: flex; gap: 4px; margin-bottom: 1rem; border-bottom: 1px solid #374151; padding-bottom: 0; }
    .tab { padding: 6px 14px; font-size: 13px; color: #9ca3af; cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -1px; transition: color .15s; }
    .tab.active { color: #3b82f6; border-bottom-color: #3b82f6; }
    .tab:hover:not(.active) { color: #f9fafb; }
    .foto-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-top: 8px; }
    .foto-slot { aspect-ratio: 1; border-radius: 8px; border: 1px dashed #374151; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 11px; color: #6b7280; flex-direction: column; gap: 4px; background: #111827; transition: border-color .15s, color .15s; }
    .foto-slot:hover { border-color: #3b82f6; color: #3b82f6; }
    .foto-slot svg { width: 20px; height: 20px; }
    .foto-filled { background: #374151; border-style: solid; border-color: #4b5563; color: #9ca3af; }
    .baremo-row { display: flex; align-items: center; gap: 10px; padding: 8px; border: 1px solid #374151; border-radius: 8px; margin-bottom: 6px; cursor: pointer; transition: background .15s; }
    .baremo-row:hover { background: #1e3a5f; }
    .baremo-op { flex: 1; font-size: 13px; color: #d1d5db; }
    .baremo-tiempo { font-size: 12px; color: #9ca3af; width: 60px; text-align: right; }
    .baremo-precio { font-size: 13px; font-weight: 600; color: #60a5fa; width: 70px; text-align: right; }
    .baremo-add { font-size: 12px; color: #60a5fa; padding: 4px 10px; border: 1px solid #1d4ed8; border-radius: 8px; background: transparent; cursor: pointer; white-space: nowrap; transition: background .15s; }
    .baremo-add:hover { background: #1e3a5f; }
    .pieza-row { display: flex; align-items: center; gap: 10px; padding: 8px; border-bottom: 1px solid #374151; font-size: 13px; }
    .pieza-row:last-child { border-bottom: none; }
    .pieza-ref { color: #6b7280; font-size: 11px; font-family: monospace; }
    .pieza-precio { font-weight: 600; color: #f9fafb; margin-left: auto; }
    .pieza-stock { font-size: 11px; color: #4ade80; }
    .pieza-pedido { font-size: 11px; color: #fbbf24; }
    .firma-section { margin-top: 1rem; display: flex; gap: 8px; align-items: center; padding: 10px; border-radius: 8px; background: #111827; border: 1px solid #1d4ed8; }
    .firma-section svg { width: 20px; height: 20px; color: #60a5fa; flex-shrink: 0; }
    .firma-text { flex: 1; font-size: 12px; color: #9ca3af; line-height: 1.4; }
    .firma-text strong { color: #d1d5db; }
    .avatar { width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; flex-shrink: 0; }
    .av-blue { background: #1e3a5f; color: #93c5fd; }
    .av-green { background: #14532d; color: #86efac; }
    .av-amber { background: #451a03; color: #fcd34d; }
    .av-coral { background: #4c1d1d; color: #fca5a5; }
    .modal-overlay { display: none; position: fixed; inset: 0; z-index: 100; background: rgba(0,0,0,.7); align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal-box { background: #1f2937; border-radius: 12px; border: 1px solid #374151; padding: 1.5rem; width: 440px; max-width: 95vw; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
    .modal-header span { font-size: 15px; font-weight: 600; color: #f9fafb; }
    .modal-header button { background: none; border: none; color: #9ca3af; cursor: pointer; line-height: 1; }
    .modal-header button:hover { color: #f9fafb; }
    .modal-header button svg { width: 18px; height: 18px; }
    .search-input { width: 100%; padding: 7px 10px; border-radius: 8px; border: 1px solid #374151; background: #111827; color: #f9fafb; font-size: 13px; font-family: inherit; margin-bottom: 10px; }
    .search-input:focus { outline: none; border-color: #3b82f6; }
    .card-danger .card-title { color: #f87171; }
    @media (max-width: 768px) {
        .dash { grid-template-columns: 1fr; }
        .sidebar { flex-direction: row; flex-wrap: wrap; padding: 0.5rem; gap: 4px; }
        .kpi-row { grid-template-columns: repeat(2, 1fr); }
        .grid-2 { grid-template-columns: 1fr; }
        .form-grid { grid-template-columns: 1fr; }
        .foto-grid { grid-template-columns: repeat(3, 1fr); }
    }
</style>

<section class="py-8 container mx-auto px-6">

    {{-- DASHBOARD SHELL --}}
    <div class="dash">

        {{-- SIDEBAR --}}
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h2>Rápidos y Curiosos</h2>
                <p>Panel administrativo</p>
            </div>

            <span class="nav-section">Principal</span>
            <a href="#" class="nav-item active" onclick="showPanel('agenda'); return false;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Agenda
            </a>
            <a href="#" class="nav-item" onclick="showPanel('expediente'); return false;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Expedientes
            </a>

            <span class="nav-section">Gestión</span>
            <a href="#" class="nav-item" onclick="showPanel('presupuestos'); return false;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                Presupuestos
            </a>
            <a href="#" class="nav-item" onclick="showPanel('facturacion'); return false;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Facturación
            </a>

            <span class="nav-section">Alertas</span>
            <a href="#" class="nav-item" onclick="showPanel('notificaciones'); return false;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                Notificaciones
                <span class="nav-badge">5</span>
            </a>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="main">

            {{-- TOP BAR --}}
            <div class="topbar">
                <h1 id="panel-title">Planificador central · Semana 20</h1>
                <div class="topbar-actions">
                    <button class="btn" onclick="showModal()">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Nueva cita
                    </button>
                    <button class="btn btn-primary" id="topbar-cta">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Presupuesto rápido
                    </button>
                </div>
            </div>

            <div class="content">

                {{-- ==================== PANEL: AGENDA ==================== --}}
                <div class="panel active" id="panel-agenda">

                    {{-- KPIs --}}
                    <div class="kpi-row">
                        <div class="kpi">
                            <span class="kpi-label">Citas hoy</span>
                            <span class="kpi-value">8</span>
                            <span class="kpi-delta up">↑ 2 más que ayer</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Boxes libres</span>
                            <span class="kpi-value">2/5</span>
                            <span class="kpi-delta warn">3 ocupados</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Operarios</span>
                            <span class="kpi-value">4/4</span>
                            <span class="kpi-delta up">Plantilla completa</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">OR en curso</span>
                            <span class="kpi-value">6</span>
                            <span class="kpi-delta">2 en espera pieza</span>
                        </div>
                    </div>

                    {{-- CALENDARIO --}}
                    <div class="card">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            Disponibilidad de boxes · Esta semana
                        </div>
                        <div class="box-badges">
                            <span class="box-badge box-free">Box 1 · Libre</span>
                            <span class="box-badge box-busy">Box 2 · Ocupado</span>
                            <span class="box-badge box-busy">Box 3 · Ocupado</span>
                            <span class="box-badge box-partial">Box 4 · Tarde libre</span>
                            <span class="box-badge box-busy">Box 5 · Ocupado</span>
                        </div>
                        <div class="cal-header">
                            <div class="cal-day-label">Lun 12</div>
                            <div class="cal-day-label">Mar 13</div>
                            <div class="cal-day-label">Mié 14</div>
                            <div class="cal-day-label">Jue 15</div>
                            <div class="cal-day-label">Vie 16</div>
                        </div>
                        <div class="cal-grid" id="calGrid">
                            <div class="cal-slot" ondragover="event.preventDefault();this.style.borderColor='#3b82f6'" ondragleave="this.style.borderColor=''" ondrop="dropAppt(event,this)">
                                <div class="appt mecanica-rapida" draggable="true" ondragstart="dragAppt(event,this)" ondragend="this.style.opacity='1'">Cambio aceite<br>García · 9h</div>
                                <div class="appt mecanica-rapida" draggable="true" ondragstart="dragAppt(event,this)" ondragend="this.style.opacity='1'">Pastillas freno<br>López · 11h</div>
                            </div>
                            <div class="cal-slot" ondragover="event.preventDefault();this.style.borderColor='#3b82f6'" ondragleave="this.style.borderColor=''" ondrop="dropAppt(event,this)">
                                <div class="appt mecanica-compleja" draggable="true" ondragstart="dragAppt(event,this)" ondragend="this.style.opacity='1'">Caja cambios<br>Martín · 9h</div>
                            </div>
                            <div class="cal-slot" ondragover="event.preventDefault();this.style.borderColor='#3b82f6'" ondragleave="this.style.borderColor=''" ondrop="dropAppt(event,this)">
                                <div class="appt diagnostico" draggable="true" ondragstart="dragAppt(event,this)" ondragend="this.style.opacity='1'">Diagnosis avanzada<br>Ruiz · 10h</div>
                                <div class="appt-empty">+ Añadir cita</div>
                            </div>
                            <div class="cal-slot" ondragover="event.preventDefault();this.style.borderColor='#3b82f6'" ondragleave="this.style.borderColor=''" ondrop="dropAppt(event,this)">
                                <div class="appt recogida" draggable="true" ondragstart="dragAppt(event,this)" ondragend="this.style.opacity='1'">Distribución<br>Sánchez · 9h</div>
                                <div class="appt mecanica-rapida" draggable="true" ondragstart="dragAppt(event,this)" ondragend="this.style.opacity='1'">ITV<br>Díaz · 11h</div>
                            </div>
                            <div class="cal-slot" ondragover="event.preventDefault();this.style.borderColor='#3b82f6'" ondragleave="this.style.borderColor=''" ondrop="dropAppt(event,this)">
                                <div class="appt diagnostico" draggable="true" ondragstart="dragAppt(event,this)" ondragend="this.style.opacity='1'">Embrague<br>Fernández · 10h</div>
                            </div>
                        </div>
                    </div>

                    {{-- CAPTURA RÁPIDA POR MATRÍCULA --}}
                    <div class="card card-last">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Captura rápida por matrícula
                        </div>
                        <div class="form-grid" style="align-items:end">
                            <div class="form-field" style="grid-column:span 2">
                                <label>Matrícula</label>
                                <div style="display:flex;gap:8px">
                                    <input type="text" id="matriculaInput" placeholder="Ej: 1234 ABC" style="flex:1;text-transform:uppercase;font-weight:600;letter-spacing:.05em" oninput="autofillMatricula(this.value)">
                                    <button class="btn btn-primary" onclick="autofillMatricula(document.getElementById('matriculaInput').value)">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                        Buscar
                                    </button>
                                </div>
                            </div>
                            <div class="form-field"><label>Titular</label><input type="text" id="f-titular" placeholder="—"></div>
                            <div class="form-field"><label>Teléfono</label><input type="text" id="f-tel" placeholder="—"></div>
                            <div class="form-field"><label>Marca / Modelo</label><input type="text" id="f-modelo" placeholder="—"></div>
                            <div class="form-field"><label>Motor / Año</label><input type="text" id="f-motor" placeholder="—"></div>
                            <div class="form-field">
                                <label>Tipo de servicio</label>
                                <select>
                                    <option>Mecánica rápida</option>
                                    <option>Mecánica compleja</option>
                                    <option>Diagnóstico</option>
                                    <option>ITV</option>
                                </select>
                            </div>
                            <div class="form-field"><label>Fecha y hora</label><input type="datetime-local"></div>
                        </div>
                        <div style="margin-top:12px;text-align:right">
                            <button class="btn btn-primary">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Confirmar cita
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ==================== PANEL: EXPEDIENTE ==================== --}}
                <div class="panel" id="panel-expediente">
                    <div class="tab-bar">
                        <div class="tab active" onclick="switchTab(this,'tab-or')">Órdenes activas</div>
                        <div class="tab" onclick="switchTab(this,'tab-fotos')">Galería de daños</div>
                    </div>

                    <div id="tab-or">
                        <div class="card">
                            <table class="or-table">
                                <thead>
                                    <tr>
                                        <th>OR</th>
                                        <th>Matrícula</th>
                                        <th>Vehículo</th>
                                        <th>Operario</th>
                                        <th>Estado</th>
                                        <th>Actualización</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-weight:600">#0248</td>
                                        <td>4521 KMV</td>
                                        <td>VW Golf VII 1.6TDI</td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:6px">
                                                <span class="avatar av-blue">JM</span> Juan M.
                                            </div>
                                        </td>
                                        <td><span class="status-pill s-reparando">🔧 En reparación</span></td>
                                        <td style="font-size:12px;color:#6b7280">Hace 15 min</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:600">#0247</td>
                                        <td>3012 BCA</td>
                                        <td>Seat Ibiza 1.0 TSI</td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:6px">
                                                <span class="avatar av-green">AL</span> Ana L.
                                            </div>
                                        </td>
                                        <td><span class="status-pill s-espera">📦 Espera pieza</span></td>
                                        <td style="font-size:12px;color:#6b7280">Hace 2 h</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:600">#0246</td>
                                        <td>9087 HJT</td>
                                        <td>Ford Focus 2.0 TDCI</td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:6px">
                                                <span class="avatar av-amber">PR</span> Pablo R.
                                            </div>
                                        </td>
                                        <td><span class="status-pill s-prueba">🛣️ Prueba carretera</span></td>
                                        <td style="font-size:12px;color:#6b7280">Hace 45 min</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:600">#0245</td>
                                        <td>6634 MNP</td>
                                        <td>Renault Clio 0.9 TCe</td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:6px">
                                                <span class="avatar av-coral">SG</span> Sofía G.
                                            </div>
                                        </td>
                                        <td><span class="status-pill s-entrega">✅ Lista entrega</span></td>
                                        <td style="font-size:12px;color:#6b7280">Hace 1 h</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="tab-fotos" style="display:none">
                        <div class="card">
                            <div style="font-size:13px;color:#9ca3af;margin-bottom:8px">
                                Vehículo: <strong style="color:#f9fafb">4521 KMV · VW Golf VII</strong> · OR #0248 · Entrada 12/05/2026
                            </div>
                            <div class="foto-grid">
                                <div class="foto-slot foto-filled">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>Frontal</span>
                                </div>
                                <div class="foto-slot foto-filled">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>Lateral izq</span>
                                </div>
                                <div class="foto-slot foto-filled">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span>Maletero</span>
                                </div>
                                @foreach(range(1,5) as $i)
                                <div class="foto-slot">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    <span>Añadir foto</span>
                                </div>
                                @endforeach
                            </div>
                            <div style="margin-top:12px;text-align:right">
                                <button class="btn btn-primary">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                    Subir fotos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ==================== PANEL: PRESUPUESTOS ==================== --}}
                <div class="panel" id="panel-presupuestos">
                    <div class="grid-2">
                        <div>
                            {{-- BAREMO --}}
                            <div class="card">
                                <div class="card-title">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Buscador de baremo
                                </div>
                                <input class="search-input" type="text" placeholder="Ej: embrague Seat Ibiza 1.0 TSI...">
                                <div class="baremo-row">
                                    <span class="baremo-op">Embrague Seat Ibiza 1.0 TSI (2018–23)</span>
                                    <span class="baremo-tiempo">3.5 h</span>
                                    <span class="baremo-precio">€280</span>
                                    <button class="baremo-add" onclick="addBaremo('M.O. Embrague Seat Ibiza 1.0 (3.5h)','280.00')">+ Añadir</button>
                                </div>
                                <div class="baremo-row">
                                    <span class="baremo-op">Embrague Seat Ibiza 1.4 TDI (2015–17)</span>
                                    <span class="baremo-tiempo">4 h</span>
                                    <span class="baremo-precio">€320</span>
                                    <button class="baremo-add" onclick="addBaremo('M.O. Embrague Seat Ibiza 1.4 (4h)','320.00')">+ Añadir</button>
                                </div>
                                <div class="baremo-row">
                                    <span class="baremo-op">Embrague Seat Ibiza FR 1.5 TSI (2021–)</span>
                                    <span class="baremo-tiempo">3 h</span>
                                    <span class="baremo-precio">€240</span>
                                    <button class="baremo-add" onclick="addBaremo('M.O. Embrague Ibiza FR 1.5 (3h)','240.00')">+ Añadir</button>
                                </div>
                            </div>

                            {{-- RECAMBISTAS --}}
                            <div class="card card-last">
                                <div class="card-title">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    Precios en tiempo real · Recambistas
                                </div>
                                <div class="pieza-row">
                                    <div>
                                        <div style="font-size:13px;color:#d1d5db">Kit embrague LuK · Seat Ibiza 1.0</div>
                                        <div class="pieza-ref">REF: 624 3397 09</div>
                                    </div>
                                    <span class="pieza-stock">En stock</span>
                                    <span class="pieza-precio">€89.40</span>
                                    <button class="baremo-add" onclick="addBaremo('Kit embrague LuK Ibiza 1.0','89.40')">+ Añadir</button>
                                </div>
                                <div class="pieza-row">
                                    <div>
                                        <div style="font-size:13px;color:#d1d5db">Kit embrague Valeo · Seat Ibiza 1.0</div>
                                        <div class="pieza-ref">REF: 826 522</div>
                                    </div>
                                    <span class="pieza-stock">En stock</span>
                                    <span class="pieza-precio">€76.20</span>
                                    <button class="baremo-add" onclick="addBaremo('Kit embrague Valeo Ibiza 1.0','76.20')">+ Añadir</button>
                                </div>
                                <div class="pieza-row">
                                    <div>
                                        <div style="font-size:13px;color:#d1d5db">Volante motor bimasa · Seat Ibiza</div>
                                        <div class="pieza-ref">REF: 0 232 231 014</div>
                                    </div>
                                    <span class="pieza-pedido">Bajo pedido</span>
                                    <span class="pieza-precio">€142.00</span>
                                    <button class="baremo-add" onclick="addBaremo('Volante motor bimasa Ibiza','142.00')">+ Añadir</button>
                                </div>
                            </div>
                        </div>

                        {{-- CONSTRUCTOR DE PRESUPUESTO --}}
                        <div class="card" style="display:flex;flex-direction:column">
                            <div class="card-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                Presupuesto #PRE-0312
                            </div>
                            <div style="font-size:12px;color:#6b7280;margin-bottom:10px">
                                Cliente: <strong style="color:#f9fafb">Ana López Martínez</strong> · 4521 KMV · Golf VII
                            </div>
                            <table class="presup-table">
                                <thead>
                                    <tr>
                                        <th>Concepto</th>
                                        <th>Uds</th>
                                        <th>P.Unit</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="presupBody">
                                    <tr>
                                        <td><input type="text" value="M.O. Embrague (3.5h)"></td>
                                        <td><input type="number" value="1" style="width:40px" oninput="recalcTotal()"></td>
                                        <td><input type="number" value="280.00" style="width:65px" oninput="recalcTotal()"></td>
                                        <td class="linea-total" style="font-weight:600">€280.00</td>
                                        <td><button onclick="removeRow(this)" style="background:none;border:none;cursor:pointer;color:#6b7280">✕</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" value="Kit embrague LuK"></td>
                                        <td><input type="number" value="1" style="width:40px" oninput="recalcTotal()"></td>
                                        <td><input type="number" value="89.40" style="width:65px" oninput="recalcTotal()"></td>
                                        <td class="linea-total" style="font-weight:600">€89.40</td>
                                        <td><button onclick="removeRow(this)" style="background:none;border:none;cursor:pointer;color:#6b7280">✕</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-sm" style="align-self:flex-start;margin-bottom:auto" onclick="addBlankRow()">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Añadir línea
                            </button>
                            <div class="presup-total" id="presupTotals">
                                <span style="color:#9ca3af">Subtotal</span><span id="total-sub">€369.40</span>
                                <span style="color:#9ca3af">IVA 21%</span><span id="total-iva">€77.57</span>
                                <span style="color:#9ca3af">Total</span><span class="presup-total-value" id="total-final">€446.97</span>
                            </div>
                            <div class="firma-section">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                <div class="firma-text">Enviar para <strong>firma digital</strong> · El cliente acepta desde su móvil y queda registrado legalmente.</div>
                                <div style="display:flex;gap:6px">
                                    <button class="btn btn-sm">📱 WhatsApp</button>
                                    <button class="btn btn-sm">✉️ Email</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ==================== PANEL: FACTURACIÓN ==================== --}}
                <div class="panel" id="panel-facturacion">
                    <div class="kpi-row">
                        <div class="kpi">
                            <span class="kpi-label">Facturado mes</span>
                            <span class="kpi-value">€12.840</span>
                            <span class="kpi-delta up">+8% vs abril</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Cobrado</span>
                            <span class="kpi-value">€10.320</span>
                            <span class="kpi-delta up">80.4%</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Impagados</span>
                            <span class="kpi-value">€2.520</span>
                            <span class="kpi-delta down">3 facturas vencidas</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Exportar trimestre</span>
                            <span class="kpi-value" style="font-size:14px;margin-top:4px">
                                <button class="btn btn-sm">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                    Excel · PDF
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="card card-danger">
                        <div class="card-title" style="color:#f87171">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Control de impagados
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0301</span>
                            <span class="factura-cliente">Roberto Núñez · Golf VII</span>
                            <span class="factura-importe">€890.00</span>
                            <span class="factura-estado impagado">Vencida 30d</span>
                            <button class="baremo-add" style="margin-left:auto">Recordatorio</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0298</span>
                            <span class="factura-cliente">Carmen Vidal · Ibiza</span>
                            <span class="factura-importe">€245.50</span>
                            <span class="factura-estado impagado">Vencida 15d</span>
                            <button class="baremo-add" style="margin-left:auto">Recordatorio</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0294</span>
                            <span class="factura-cliente">Luis Mora · Focus</span>
                            <span class="factura-importe">€1.384.20</span>
                            <span class="factura-estado impagado">Vencida 45d</span>
                            <button class="baremo-add" style="margin-left:auto">Recordatorio</button>
                        </div>
                    </div>

                    <div class="card card-last">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Historial de facturas
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0311</span>
                            <span class="factura-cliente">Ana López · Golf VII</span>
                            <span class="factura-importe">€446.97</span>
                            <span class="factura-estado pendiente">Pendiente firma</span>
                            <button class="baremo-add" style="margin-left:auto">Convertir a factura</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0310</span>
                            <span class="factura-cliente">Pedro Ruiz · Clio</span>
                            <span class="factura-importe">€182.30</span>
                            <span class="factura-estado cobrado">✓ Cobrada</span>
                            <button class="baremo-add" style="margin-left:auto">Descargar</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0309</span>
                            <span class="factura-cliente">Marta Jiménez · Polo</span>
                            <span class="factura-importe">€635.00</span>
                            <span class="factura-estado cobrado">✓ Cobrada</span>
                            <button class="baremo-add" style="margin-left:auto">Descargar</button>
                        </div>
                    </div>
                </div>

                {{-- ==================== PANEL: NOTIFICACIONES ==================== --}}
                <div class="panel" id="panel-notificaciones">
                    <div class="card card-last">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            Centro de alertas activas
                        </div>
                        <div class="notif-list">
                            <div class="notif" id="notif-1">
                                <div class="notif-icon ok">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                </div>
                                <div class="notif-body">
                                    <p>Pedido de <strong>filtros de aceite (×12)</strong> recibido en almacén. Avisar a Juan Martínez.</p>
                                    <span>Hace 5 min · Almacén</span>
                                </div>
                                <div class="notif-actions">
                                    <button class="btn btn-sm">Avisar mecánico</button>
                                    <button onclick="dismissNotif('notif-1')" style="background:none;border:none;cursor:pointer;color:#6b7280;font-size:16px" title="Descartar">✕</button>
                                </div>
                            </div>
                            <div class="notif" id="notif-2">
                                <div class="notif-icon warn">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="notif-body">
                                    <p>OR #0247 lleva <strong>2 horas esperando pieza</strong> del recambista. Confirmar plazo.</p>
                                    <span>Hace 2 h · Mecánica compleja</span>
                                </div>
                                <div class="notif-actions">
                                    <button class="btn btn-sm">Llamar recambista</button>
                                    <button onclick="dismissNotif('notif-2')" style="background:none;border:none;cursor:pointer;color:#6b7280;font-size:16px">✕</button>
                                </div>
                            </div>
                            <div class="notif" id="notif-3">
                                <div class="notif-icon promo">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </div>
                                <div class="notif-body">
                                    <p><strong>Roberto Núñez</strong> no viene hace <strong>14 meses</strong>. Ofrecer revisión + cambio de aceite a precio especial.</p>
                                    <span>Hoy · Fidelización</span>
                                </div>
                                <div class="notif-actions">
                                    <button class="btn btn-sm">📱 Enviar oferta</button>
                                    <button onclick="dismissNotif('notif-3')" style="background:none;border:none;cursor:pointer;color:#6b7280;font-size:16px">✕</button>
                                </div>
                            </div>
                            <div class="notif" id="notif-4">
                                <div class="notif-icon promo">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </div>
                                <div class="notif-body">
                                    <p><strong>Carmen Vidal</strong> no viene hace <strong>11 meses</strong>. Kilometraje estimado: 9.000 km. Recordar mantenimiento.</p>
                                    <span>Hoy · Fidelización</span>
                                </div>
                                <div class="notif-actions">
                                    <button class="btn btn-sm">📱 Enviar oferta</button>
                                    <button onclick="dismissNotif('notif-4')" style="background:none;border:none;cursor:pointer;color:#6b7280;font-size:16px">✕</button>
                                </div>
                            </div>
                            <div class="notif" id="notif-5">
                                <div class="notif-icon info">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <div class="notif-body">
                                    <p>Factura <strong>#FAC-0294</strong> lleva <strong>45 días vencida</strong>. Considerar acción de cobro.</p>
                                    <span>Hoy · Finanzas</span>
                                </div>
                                <div class="notif-actions">
                                    <button class="btn btn-sm" onclick="showPanel('facturacion')">Ver factura</button>
                                    <button onclick="dismissNotif('notif-5')" style="background:none;border:none;cursor:pointer;color:#6b7280;font-size:16px">✕</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- /content --}}
        </div>{{-- /main --}}
    </div>{{-- /dash --}}

</section>

{{-- MODAL NUEVA CITA --}}
<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this)hideModal()">
    <div class="modal-box">
        <div class="modal-header">
            <span>Nueva cita</span>
            <button onclick="hideModal()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="form-grid">
            <div class="form-field"><label>Matrícula</label><input type="text" placeholder="1234 ABC"></div>
            <div class="form-field"><label>Teléfono</label><input type="text" placeholder="600 000 000"></div>
            <div class="form-field">
                <label>Servicio</label>
                <select>
                    <option>Mecánica rápida</option>
                    <option>Mecánica compleja</option>
                    <option>Diagnóstico</option>
                    <option>ITV</option>
                </select>
            </div>
            <div class="form-field">
                <label>Operario</label>
                <select>
                    <option>Juan M.</option>
                    <option>Ana L.</option>
                    <option>Pablo R.</option>
                    <option>Sofía G.</option>
                </select>
            </div>
            <div class="form-field"><label>Fecha</label><input type="date"></div>
            <div class="form-field"><label>Hora</label><input type="time" value="09:00"></div>
        </div>
        <div style="text-align:right;margin-top:14px">
            <button class="btn btn-primary" onclick="hideModal()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Confirmar cita
            </button>
        </div>
    </div>
</div>

<script>
// ---------- NAVEGACIÓN ----------
const panelTitles = {
    agenda: 'Planificador central · Semana 20',
    expediente: 'Expedientes digitales 360°',
    presupuestos: 'Constructor de presupuestos',
    facturacion: 'Facturación y cobro',
    notificaciones: 'Notificaciones activas'
};

function showPanel(id) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    const panel = document.getElementById('panel-' + id);
    if (panel) panel.classList.add('active');
    document.querySelectorAll('.nav-item').forEach(n => {
        if (n.getAttribute('onclick') && n.getAttribute('onclick').includes("'" + id + "'")) {
            n.classList.add('active');
        }
    });
    document.getElementById('panel-title').textContent = panelTitles[id] || '';
}

// ---------- TABS EXPEDIENTE ----------
function switchTab(el, tabId) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    ['tab-or', 'tab-fotos'].forEach(id => {
        const el2 = document.getElementById(id);
        if (el2) el2.style.display = id === tabId ? 'block' : 'none';
    });
}

// ---------- AUTOFILL MATRÍCULA ----------
const vehicleDB = {
    '1234 ABC': { titular: 'Ana López Martínez', tel: '628 441 920', modelo: 'VW Golf VII 1.6 TDI', motor: '1.6 TDI / 2019' },
    '4521 KMV': { titular: 'Roberto Núñez Pardo', tel: '612 334 779', modelo: 'Seat Ibiza 1.0 TSI', motor: '1.0 TSI / 2021' },
    '3012 BCA': { titular: 'Carmen Vidal Serra', tel: '677 002 341', modelo: 'Ford Focus 2.0 TDCI', motor: '2.0 TDCI / 2018' },
    '9087 HJT': { titular: 'Pedro Ruiz Olmedo', tel: '655 112 930', modelo: 'Ford Focus 2.0 TDCI', motor: '2.0 TDCI / 2017' },
};

function autofillMatricula(val) {
    const key = val.toUpperCase().trim();
    const entry = vehicleDB[key];
    if (entry) {
        document.getElementById('f-titular').value = entry.titular;
        document.getElementById('f-tel').value = entry.tel;
        document.getElementById('f-modelo').value = entry.modelo;
        document.getElementById('f-motor').value = entry.motor;
    }
}

// ---------- PRESUPUESTO ----------
function addBaremo(concepto, precio) {
    const tbody = document.getElementById('presupBody');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><input type="text" value="${concepto}"></td>
        <td><input type="number" value="1" style="width:40px" oninput="recalcTotal()"></td>
        <td><input type="number" value="${precio}" style="width:65px" oninput="recalcTotal()"></td>
        <td class="linea-total" style="font-weight:600">€${parseFloat(precio).toFixed(2)}</td>
        <td><button onclick="removeRow(this)" style="background:none;border:none;cursor:pointer;color:#6b7280">✕</button></td>
    `;
    tbody.appendChild(tr);
    recalcTotal();
}

function addBlankRow() {
    addBaremo('Concepto', '0.00');
}

function removeRow(btn) {
    btn.closest('tr').remove();
    recalcTotal();
}

function recalcTotal() {
    const rows = document.querySelectorAll('#presupBody tr');
    let sub = 0;
    rows.forEach(row => {
        const uds = parseFloat(row.querySelectorAll('input')[1]?.value) || 0;
        const pu  = parseFloat(row.querySelectorAll('input')[2]?.value) || 0;
        const linea = uds * pu;
        const totalCell = row.querySelector('.linea-total');
        if (totalCell) totalCell.textContent = '€' + linea.toFixed(2);
        sub += linea;
    });
    const iva = sub * 0.21;
    const total = sub + iva;
    document.getElementById('total-sub').textContent   = '€' + sub.toFixed(2);
    document.getElementById('total-iva').textContent   = '€' + iva.toFixed(2);
    document.getElementById('total-final').textContent = '€' + total.toFixed(2);
}

// ---------- DRAG & DROP CITAS ----------
let draggedAppt = null;

function dragAppt(event, el) {
    draggedAppt = el;
    el.style.opacity = '0.4';
}

function dropAppt(event, slot) {
    event.preventDefault();
    if (draggedAppt) {
        slot.appendChild(draggedAppt);
        draggedAppt.style.opacity = '1';
        draggedAppt = null;
    }
    slot.style.borderColor = '';
}

// ---------- MODAL ----------
function showModal() { document.getElementById('modalOverlay').classList.add('open'); }
function hideModal() { document.getElementById('modalOverlay').classList.remove('open'); }

// ---------- NOTIFICACIONES ----------
function dismissNotif(id) {
    const el = document.getElementById(id);
    if (el) {
        el.style.transition = 'opacity .3s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 300);
    }
}
</script>
@endsection
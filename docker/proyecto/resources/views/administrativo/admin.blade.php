@extends('layouts.app')
@vite(['resources/css/admin/admin.css'])

@section('content')

<div class="admin-subtitle">Panel de administrador</div>

<section class="py-8 px-6">
    <div class="dash" style="grid-template-columns:1fr;">
        <div class="main">

            <div class="topbar">
                <h1 id="panel-title">Gestión · Estadísticas</h1>
                <div class="topbar-actions" id="topbarActions"></div>
            </div>

            <div class="content">
                @include('administrativo.estadisticas')
                @include('administrativo.usuarios')
                @include('administrativo.reparacion')
                @include('administrativo.vehiculos2')
                @include('administrativo.piezas')
            </div>{{-- /content --}}

        </div>{{-- /main --}}
    </div>{{-- /dash --}}
</section>

{{-- ===== MODAL UNIVERSAL ===== --}}
<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this)hideModal()">
    <div class="modal-box" style="width:520px;max-width:95vw">
        <div class="modal-header">
            <span id="modal-title">Modal</span>
            <button onclick="hideModal()" style="background:none;border:none;color:#7a9ec5;cursor:pointer;font-size:18px">✕</button>
        </div>
        <div id="modal-body" style="margin:10px 0 4px"></div>
        <div style="text-align:right;margin-top:14px;display:flex;gap:8px;justify-content:flex-end">
            <button class="btn" onclick="hideModal()">Cancelar</button>
            <button class="btn btn-primary" id="modal-confirm">Confirmar</button>
        </div>
    </div>
</div>

{{-- ===== MODAL DETALLE VEHÍCULO ===== --}}
<div class="modal-overlay" id="vehModal" onclick="if(event.target===this)closeVehModal()">
    <div class="modal-box" style="width:600px;max-width:95vw">
        <div class="modal-header">
            <span id="veh-modal-title">Vehículo</span>
            <button onclick="closeVehModal()" style="background:none;border:none;color:#7a9ec5;cursor:pointer;font-size:18px">✕</button>
        </div>
        <div id="veh-modal-body"></div>
    </div>
</div>

@include('administrativo.admin-scripts')

@endsection

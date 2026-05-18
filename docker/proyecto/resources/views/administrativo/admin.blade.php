@extends('layouts.app')
@vite(['resources/css/admin/admin.css'])

@section('content')
@include('components.header-admin')

<section class="py-8 px-6">

    <div class="dash" style="grid-template-columns:1fr;">

        {{-- MAIN --}}
        <div class="main">
            <div class="topbar">
                <h1 id="panel-title">Revisar solicitudes</h1>
                <div class="topbar-actions">
                    <button class="btn" onclick="showModal('nueva-sol')">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nueva solicitud
                    </button>
                    <button class="btn btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Presupuesto rápido
                    </button>
                </div>
            </div>

            <div class="content">

                {{-- ========== PASO 1: REVISAR SOLICITUD ========== --}}
                <div class="panel active" id="panel-solicitudes">

                    {{-- PIPELINE DE ESTADOS --}}
                    <div class="pipeline">
                        <div class="pipe-step pipe-active">
                            <div class="pipe-inner">
                                <span class="pipe-num">PASO 1</span>
                                <span class="pipe-label">Revisar</span>
                                <span class="pipe-count">4</span>
                            </div>
                        </div>
                        <div class="pipe-step">
                            <div class="pipe-inner">
                                <span class="pipe-num">PASO 2</span>
                                <span class="pipe-label">Sin mecánico</span>
                                <span class="pipe-count">2</span>
                            </div>
                        </div>
                        <div class="pipe-step">
                            <div class="pipe-inner">
                                <span class="pipe-num">PASO 3</span>
                                <span class="pipe-label">Sin fecha</span>
                                <span class="pipe-count">1</span>
                            </div>
                        </div>
                        <div class="pipe-step">
                            <div class="pipe-inner">
                                <span class="pipe-num">PASO 4</span>
                                <span class="pipe-label">Piezas</span>
                                <span class="pipe-count">3</span>
                            </div>
                        </div>
                        <div class="pipe-step">
                            <div class="pipe-inner">
                                <span class="pipe-num">PASO 5</span>
                                <span class="pipe-label">Cobro pend.</span>
                                <span class="pipe-count">1</span>
                            </div>
                        </div>
                        <div class="pipe-step">
                            <div class="pipe-inner">
                                <span class="pipe-num">PASO 6</span>
                                <span class="pipe-label">Entrega lista</span>
                                <span class="pipe-count">2</span>
                            </div>
                        </div>
                    </div>

                    {{-- KPIs --}}
                    <div class="kpi-row">
                        <div class="kpi">
                            <span class="kpi-label">Solicitudes pendientes</span>
                            <span class="kpi-value">4</span>
                            <span class="kpi-delta warn">↑ 2 nuevas hoy</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">OR activas</span>
                            <span class="kpi-value">9</span>
                            <span class="kpi-delta">3 en reparación</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Tiempo medio revisión</span>
                            <span class="kpi-value">18 min</span>
                            <span class="kpi-delta up">↓ 5 min esta semana</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Tasa aceptación</span>
                            <span class="kpi-value">94%</span>
                            <span class="kpi-delta up">↑ 2% vs mes anterior</span>
                        </div>
                    </div>

                    {{-- LISTADO SOLICITUDES PENDIENTES --}}
                    <div class="card">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Solicitudes sin revisar
                        </div>

                        <div class="sol-row">
                            <span class="sol-id">SOL-0041</span>
                            <div class="sol-info">
                                <strong>Ana López · 4521 KMV</strong>
                                <span>VW Golf VII 1.6 TDI · Recibida hace 12 min</span>
                                <div class="sol-desc">Ruido extraño al frenar, posible disco y pastillas desgastados</div>
                            </div>
                            <span class="sol-urgency urg-alta">Urgente</span>
                            <span class="status-pill s-nueva">● Nueva</span>
                            <div class="sol-actions">
                                <button class="btn btn-sm btn-success" onclick="showPanel('mecanico')">✓ Aceptar</button>
                                <button class="btn btn-sm btn-danger">✕ Rechazar</button>
                            </div>
                        </div>

                        <div class="sol-row">
                            <span class="sol-id">SOL-0040</span>
                            <div class="sol-info">
                                <strong>Roberto Núñez · 3012 BCA</strong>
                                <span>Seat Ibiza 1.0 TSI · Recibida hace 45 min</span>
                                <div class="sol-desc">Revisión general + cambio de aceite y filtros</div>
                            </div>
                            <span class="sol-urgency urg-media">Media</span>
                            <span class="status-pill s-nueva">● Nueva</span>
                            <div class="sol-actions">
                                <button class="btn btn-sm btn-success" onclick="showPanel('mecanico')">✓ Aceptar</button>
                                <button class="btn btn-sm btn-danger">✕ Rechazar</button>
                            </div>
                        </div>

                        <div class="sol-row">
                            <span class="sol-id">SOL-0039</span>
                            <div class="sol-info">
                                <strong>Carmen Vidal · 9087 HJT</strong>
                                <span>Ford Focus 2.0 TDCI · Recibida hace 2 h</span>
                                <div class="sol-desc">Motor tira humo blanco al arrancar en frío, posible junta culata</div>
                            </div>
                            <span class="sol-urgency urg-alta">Urgente</span>
                            <span class="status-pill s-nueva">● Nueva</span>
                            <div class="sol-actions">
                                <button class="btn btn-sm btn-success" onclick="showPanel('mecanico')">✓ Aceptar</button>
                                <button class="btn btn-sm btn-danger">✕ Rechazar</button>
                            </div>
                        </div>

                        <div class="sol-row">
                            <span class="sol-id">SOL-0038</span>
                            <div class="sol-info">
                                <strong>Pedro Ruiz · 6634 MNP</strong>
                                <span>Renault Clio 0.9 TCe · Recibida hace 3 h</span>
                                <div class="sol-desc">Testigo ABS encendido, revisión de sensores</div>
                            </div>
                            <span class="sol-urgency urg-baja">Normal</span>
                            <span class="status-pill s-nueva">● Nueva</span>
                            <div class="sol-actions">
                                <button class="btn btn-sm btn-success" onclick="showPanel('mecanico')">✓ Aceptar</button>
                                <button class="btn btn-sm btn-danger">✕ Rechazar</button>
                            </div>
                        </div>
                    </div>

                    {{-- ESTADO GLOBAL DE REPARACIONES --}}
                    <div class="card card-last">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            Estado actual de todas las reparaciones
                        </div>
                        <table class="or-table">
                            <thead>
                                <tr>
                                    <th>OR</th>
                                    <th>Matrícula</th>
                                    <th>Vehículo</th>
                                    <th>Mecánico</th>
                                    <th>Estado de reparación</th>
                                    <th>Actualización</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight:600">#0248</td>
                                    <td>4521 KMV</td>
                                    <td>VW Golf VII</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:6px"><span class="avatar av-blue">JM</span> Juan M.</div>
                                    </td>
                                    <td><span class="status-pill s-reparando">🔧 En reparación</span></td>
                                    <td class="text-muted">Hace 15 min</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600">#0247</td>
                                    <td>3012 BCA</td>
                                    <td>Seat Ibiza 1.0</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:6px"><span class="avatar av-green">AL</span> Ana L.</div>
                                    </td>
                                    <td><span class="status-pill s-piezas">📦 Esperando piezas</span></td>
                                    <td class="text-muted">Hace 2 h</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600">#0246</td>
                                    <td>9087 HJT</td>
                                    <td>Ford Focus 2.0</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:6px"><span class="avatar av-amber">PR</span> Pablo R.</div>
                                    </td>
                                    <td><span class="status-pill s-prueba">🛣️ Prueba carretera</span></td>
                                    <td class="text-muted">Hace 45 min</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600">#0245</td>
                                    <td>6634 MNP</td>
                                    <td>Renault Clio 0.9</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:6px"><span class="avatar av-coral">SG</span> Sofía G.</div>
                                    </td>
                                    <td><span class="status-pill s-pago">💳 Pendiente pago</span></td>
                                    <td class="text-muted">Hace 1 h</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600">#0244</td>
                                    <td>1234 ABC</td>
                                    <td>Peugeot 308</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:6px"><span class="avatar av-purple">LG</span> Luis G.</div>
                                    </td>
                                    <td><span class="status-pill s-entregado">✅ Entregado</span></td>
                                    <td class="text-muted">Hace 3 h</td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600">#0243</td>
                                    <td>7823 RTY</td>
                                    <td>Toyota Yaris</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:6px"><span class="avatar av-blue">JM</span> Juan M.</div>
                                    </td>
                                    <td><span class="status-pill s-asignado">👤 Mecánico asignado</span></td>
                                    <td class="text-muted">Hace 4 h</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ========== PASO 2: ASIGNAR MECÁNICO ========== --}}
                <div class="panel" id="panel-mecanico">
                    <div class="kpi-row">
                        <div class="kpi">
                            <span class="kpi-label">Mecánicos disponibles</span>
                            <span class="kpi-value">3/5</span>
                            <span class="kpi-delta up">2 con carga baja</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">OR sin asignar</span>
                            <span class="kpi-value">2</span>
                            <span class="kpi-delta warn">Pendientes ahora</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Horas libres hoy</span>
                            <span class="kpi-value">11 h</span>
                            <span class="kpi-delta">Entre todos los talleres</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Especialidad requerida</span>
                            <span class="kpi-value" style="font-size:14px;padding-top:4px">Mecánica compleja</span>
                            <span class="kpi-delta">OR #0248 · Golf VII</span>
                        </div>
                    </div>

                    <div class="card" style="margin-bottom:1rem">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Solicitud activa a asignar
                        </div>
                        <div style="display:flex;align-items:center;gap:12px;padding:8px;background:#111827;border-radius:8px;border:1px solid #374151">
                            <span class="badge-new">SOL-0041</span>
                            <div>
                                <div style="font-size:13px;color:#f9fafb;font-weight:600">Ana López · 4521 KMV · VW Golf VII 1.6 TDI</div>
                                <div style="font-size:12px;color:#6b7280">Ruido al frenar — discos y pastillas. Urgente.</div>
                            </div>
                            <span class="status-pill s-asignado" style="margin-left:auto">Asignando…</span>
                        </div>
                    </div>

                    <div class="card card-last">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Selecciona mecánico responsable
                        </div>
                        <div class="mec-grid">
                            <div class="mec-card selected" onclick="selectMec(this)">
                                <div class="mec-header">
                                    <span class="avatar av-blue">JM</span>
                                    <div>
                                        <div class="mec-name">Juan Martínez</div>
                                        <div class="mec-spec">Mecánica compleja · Motor</div>
                                    </div>
                                </div>
                                <div class="mec-load">
                                    <div class="mec-load-bar load-mid" style="width:60%"></div>
                                </div>
                                <div class="mec-stats">Carga: <strong>60%</strong> &nbsp;·&nbsp; OR activas: <strong>2</strong> &nbsp;·&nbsp; Libera: <strong>15:00</strong></div>
                            </div>
                            <div class="mec-card" onclick="selectMec(this)">
                                <div class="mec-header">
                                    <span class="avatar av-green">AL</span>
                                    <div>
                                        <div class="mec-name">Ana López</div>
                                        <div class="mec-spec">Mecánica rápida · ITV</div>
                                    </div>
                                </div>
                                <div class="mec-load">
                                    <div class="mec-load-bar load-low" style="width:30%"></div>
                                </div>
                                <div class="mec-stats">Carga: <strong>30%</strong> &nbsp;·&nbsp; OR activas: <strong>1</strong> &nbsp;·&nbsp; Libera: <strong>12:30</strong></div>
                            </div>
                            <div class="mec-card" onclick="selectMec(this)">
                                <div class="mec-header">
                                    <span class="avatar av-amber">PR</span>
                                    <div>
                                        <div class="mec-name">Pablo Ruiz</div>
                                        <div class="mec-spec">Electricidad · Diagnosis</div>
                                    </div>
                                </div>
                                <div class="mec-load">
                                    <div class="mec-load-bar load-high" style="width:90%"></div>
                                </div>
                                <div class="mec-stats">Carga: <strong>90%</strong> &nbsp;·&nbsp; OR activas: <strong>3</strong> &nbsp;·&nbsp; Libera: <strong>18:00</strong></div>
                            </div>
                            <div class="mec-card" onclick="selectMec(this)">
                                <div class="mec-header">
                                    <span class="avatar av-coral">SG</span>
                                    <div>
                                        <div class="mec-name">Sofía García</div>
                                        <div class="mec-spec">Chapa · Pintura</div>
                                    </div>
                                </div>
                                <div class="mec-load">
                                    <div class="mec-load-bar load-low" style="width:25%"></div>
                                </div>
                                <div class="mec-stats">Carga: <strong>25%</strong> &nbsp;·&nbsp; OR activas: <strong>1</strong> &nbsp;·&nbsp; Libera: <strong>11:00</strong></div>
                            </div>
                        </div>
                        <div style="text-align:right;margin-top:12px">
                            <button class="btn" style="margin-right:8px">Cancelar</button>
                            <button class="btn btn-primary" onclick="showPanel('programar')">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Confirmar asignación → Paso 3
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ========== PASO 3: PROGRAMAR FECHA ========== --}}
                <div class="panel" id="panel-programar">
                    <div class="grid-2">
                        <div>
                            <div class="card">
                                <div class="card-title">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Semana 20 · Disponibilidad Juan Martínez
                                </div>

                                <div class="week-grid">
                                    <div class="wg-header"></div>
                                    <div class="wg-header">Lun 12</div>
                                    <div class="wg-header">Mar 13</div>
                                    <div class="wg-header">Mié 14</div>
                                    <div class="wg-header">Jue 15</div>
                                    <div class="wg-header">Vie 16</div>

                                    <div class="wg-time">09:00</div>
                                    <div class="wg-cell wg-busy">
                                        <div class="wg-appt">OR #0246</div><span class="wg-slot-label">3 h</span>
                                    </div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell wg-busy">
                                        <div class="wg-appt">OR #0248</div><span class="wg-slot-label">2 h</span>
                                    </div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>

                                    <div class="wg-time">11:00</div>
                                    <div class="wg-cell wg-busy">
                                        <div class="wg-appt">OR #0246</div>
                                    </div>
                                    <div class="wg-cell wg-selected" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell wg-busy">
                                        <div class="wg-appt">Revis. rápida</div>
                                    </div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>

                                    <div class="wg-time">13:00</div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell wg-busy">
                                        <div class="wg-appt">OR #0247</div>
                                    </div>

                                    <div class="wg-time">15:00</div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell wg-busy">
                                        <div class="wg-appt">Embrague</div><span class="wg-slot-label">3.5 h</span>
                                    </div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                    <div class="wg-cell" onclick="selectSlot(this)"></div>
                                </div>

                                <div style="margin-top:10px;font-size:11px;color:#6b7280;display:flex;gap:12px">
                                    <span style="display:flex;align-items:center;gap:4px"><span style="width:10px;height:10px;border-radius:2px;background:#1e3a5f;display:inline-block"></span> Ocupado</span>
                                    <span style="display:flex;align-items:center;gap:4px"><span style="width:10px;height:10px;border-radius:2px;background:#1d4ed8;display:inline-block"></span> Seleccionado</span>
                                    <span style="display:flex;align-items:center;gap:4px"><span style="width:10px;height:10px;border-radius:2px;background:#1f2937;border:1px solid #374151;display:inline-block"></span> Libre</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="card">
                                <div class="card-title">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Detalles de la cita
                                </div>
                                <div class="form-grid" style="margin-bottom:12px">
                                    <div class="form-field" style="grid-column:span 2">
                                        <label>Vehículo</label>
                                        <input type="text" value="4521 KMV · VW Golf VII 1.6 TDI" readonly style="color:#9ca3af">
                                    </div>
                                    <div class="form-field">
                                        <label>Mecánico asignado</label>
                                        <input type="text" value="Juan Martínez" readonly style="color:#9ca3af">
                                    </div>
                                    <div class="form-field">
                                        <label>Duración estimada</label>
                                        <select>
                                            <option>1 hora</option>
                                            <option>2 horas</option>
                                            <option selected>3 horas</option>
                                            <option>4 horas</option>
                                            <option>Todo el día</option>
                                        </select>
                                    </div>
                                    <div class="form-field">
                                        <label>Fecha</label>
                                        <input type="date" value="2026-05-13">
                                    </div>
                                    <div class="form-field">
                                        <label>Hora de inicio</label>
                                        <input type="time" value="11:00">
                                    </div>
                                    <div class="form-field" style="grid-column:span 2">
                                        <label>Notas para el mecánico</label>
                                        <textarea>Cliente indica ruido metálico al frenar entre 60-80 km/h. Revisar discos y pastillas traseros principalmente.</textarea>
                                    </div>
                                </div>
                                <div style="padding:10px;background:#111827;border-radius:8px;border:1px solid #374151;font-size:12px;color:#6b7280;margin-bottom:12px">
                                    📱 Se enviará confirmación al cliente por WhatsApp/SMS al guardar.
                                </div>
                                <div style="display:flex;gap:8px;justify-content:flex-end">
                                    <button class="btn">Guardar sin notificar</button>
                                    <button class="btn btn-primary" onclick="showPanel('piezas')">
                                        Confirmar y notificar → Paso 4
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== PASO 4: APROBAR COMPRA DE PIEZAS ========== --}}
                <div class="panel" id="panel-piezas">
                    <div class="kpi-row">
                        <div class="kpi">
                            <span class="kpi-label">Piezas pendientes aprobación</span>
                            <span class="kpi-value">3</span>
                            <span class="kpi-delta warn">En 2 OR distintas</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Importe total pedido</span>
                            <span class="kpi-value">€487</span>
                            <span class="kpi-delta">Sin IVA</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Plazo entrega estimado</span>
                            <span class="kpi-value">24 h</span>
                            <span class="kpi-delta up">Proveedor en stock</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">OR bloqueadas por piezas</span>
                            <span class="kpi-value">2</span>
                            <span class="kpi-delta down">Esperando aprobación</span>
                        </div>
                    </div>

                    {{-- OR #0247 --}}
                    <div class="card">
                        <div class="card-title" style="justify-content:space-between">
                            <span style="display:flex;align-items:center;gap:8px">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                OR #0247 · Seat Ibiza 1.0 TSI · Ana López — Recambista: AutoPiezas Sur
                            </span>
                            <span class="status-pill s-piezas">📦 En espera</span>
                        </div>

                        <div class="pieza-row">
                            <div style="flex:1">
                                <div style="font-size:13px;color:#d1d5db;font-weight:600">Kit embrague LuK · Seat Ibiza 1.0</div>
                                <div class="pieza-ref">REF: 624 3397 09</div>
                            </div>
                            <span class="pieza-stock">✓ En stock</span>
                            <span class="pieza-precio">€89.40</span>
                            <button class="approve-toggle on" onclick="toggleApprove(this)" title="Aprobado"></button>
                        </div>
                        <div class="pieza-row">
                            <div style="flex:1">
                                <div style="font-size:13px;color:#d1d5db;font-weight:600">Volante motor bimasa · Seat Ibiza</div>
                                <div class="pieza-ref">REF: 0 232 231 014</div>
                            </div>
                            <span class="pieza-pedido">⏳ Bajo pedido · 24 h</span>
                            <span class="pieza-precio">€142.00</span>
                            <button class="approve-toggle" onclick="toggleApprove(this)" title="Pendiente aprobación"></button>
                        </div>
                        <div style="text-align:right;margin-top:10px;display:flex;gap:8px;justify-content:flex-end;align-items:center">
                            <span style="font-size:12px;color:#6b7280">Total OR #0247: <strong style="color:#f9fafb">€231.40</strong></span>
                            <button class="btn btn-sm btn-primary">Aprobar todas y pedir</button>
                        </div>
                    </div>

                    {{-- OR #0248 --}}
                    <div class="card card-last">
                        <div class="card-title" style="justify-content:space-between">
                            <span style="display:flex;align-items:center;gap:8px">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                OR #0248 · VW Golf VII · Juan Martínez — Recambista: RecambiosFast
                            </span>
                            <span class="status-pill s-piezas">📦 En espera</span>
                        </div>

                        <div class="pieza-row">
                            <div style="flex:1">
                                <div style="font-size:13px;color:#d1d5db;font-weight:600">Juego discos freno delanteros · Golf VII</div>
                                <div class="pieza-ref">REF: TRW DF6116S</div>
                            </div>
                            <span class="pieza-stock">✓ En stock</span>
                            <span class="pieza-precio">€95.80</span>
                            <button class="approve-toggle on" onclick="toggleApprove(this)" title="Aprobado"></button>
                        </div>
                        <div class="pieza-row">
                            <div style="flex:1">
                                <div style="font-size:13px;color:#d1d5db;font-weight:600">Pastillas freno delanteras · Golf VII 1.6 TDI</div>
                                <div class="pieza-ref">REF: BREMBO P85 075</div>
                            </div>
                            <span class="pieza-stock">✓ En stock</span>
                            <span class="pieza-precio">€42.60</span>
                            <button class="approve-toggle on" onclick="toggleApprove(this)" title="Aprobado"></button>
                        </div>
                        <div style="text-align:right;margin-top:10px;display:flex;gap:8px;justify-content:flex-end;align-items:center">
                            <span style="font-size:12px;color:#6b7280">Total OR #0248: <strong style="color:#f9fafb">€138.40</strong></span>
                            <button class="btn btn-sm btn-success" onclick="showPanel('pago')">✓ Aprobado → Paso 5</button>
                        </div>
                    </div>
                </div>

                {{-- ========== PASO 5: CONFIRMAR PAGO ========== --}}
                <div class="panel" id="panel-pago">
                    <div class="kpi-row">
                        <div class="kpi">
                            <span class="kpi-label">Cobros pendientes</span>
                            <span class="kpi-value">1</span>
                            <span class="kpi-delta warn">OR lista para cobrar</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Importe a cobrar</span>
                            <span class="kpi-value">€628.40</span>
                            <span class="kpi-delta">IVA incluido</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Método habitual cliente</span>
                            <span class="kpi-value" style="font-size:14px;padding-top:4px">Tarjeta</span>
                            <span class="kpi-delta">Última visita: tarjeta débito</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Facturado este mes</span>
                            <span class="kpi-value">€12.840</span>
                            <span class="kpi-delta up">+8% vs abril</span>
                        </div>
                    </div>

                    <div class="grid-2">
                        <div class="card">
                            <div class="card-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                                </svg>
                                OR #0245 · Renault Clio · Pedro Ruiz
                            </div>

                            <div class="pago-resumen">
                                <div class="pago-line"><span>M.O. Diagnosis ABS (2 h)</span><span>€160.00</span></div>
                                <div class="pago-line"><span>Sensor ABS delantero izq.</span><span>€48.90</span></div>
                                <div class="pago-line"><span>Líquido de frenos DOT4 (1 L)</span><span>€12.00</span></div>
                                <div class="pago-line"><span>Subtotal</span><span>€220.90</span></div>
                                <div class="pago-line"><span>IVA 21%</span><span>€46.39</span></div>
                                <div class="pago-line total"><span>TOTAL</span><span>€267.29</span></div>
                            </div>

                            <div style="margin-bottom:10px">
                                <div style="font-size:12px;color:#9ca3af;margin-bottom:6px">Forma de pago</div>
                                <div class="pago-metodo">
                                    <button class="pago-btn selected" onclick="selectPago(this)">💳 Tarjeta</button>
                                    <button class="pago-btn" onclick="selectPago(this)">💵 Efectivo</button>
                                    <button class="pago-btn" onclick="selectPago(this)">📱 Bizum</button>
                                    <button class="pago-btn" onclick="selectPago(this)">🏦 Transfer.</button>
                                </div>
                            </div>

                            <div style="display:flex;gap:8px;justify-content:flex-end">
                                <button class="btn btn-sm">📱 Enviar link de pago</button>
                                <button class="btn btn-sm btn-success" onclick="showPanel('entrega')">
                                    ✓ Confirmar cobro → Paso 6
                                </button>
                            </div>
                        </div>

                        <div class="card card-last">
                            <div class="card-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Impagados activos
                            </div>
                            <div class="factura-row">
                                <span class="factura-id">#FAC-0301</span>
                                <span class="factura-cliente">Roberto N. · Golf VII</span>
                                <span class="factura-importe">€890.00</span>
                                <span class="factura-estado impagado">Vencida 30d</span>
                                <button class="baremo-add" style="margin-left:auto">Recordar</button>
                            </div>
                            <div class="factura-row">
                                <span class="factura-id">#FAC-0298</span>
                                <span class="factura-cliente">Carmen V. · Ibiza</span>
                                <span class="factura-importe">€245.50</span>
                                <span class="factura-estado impagado">Vencida 15d</span>
                                <button class="baremo-add" style="margin-left:auto">Recordar</button>
                            </div>
                            <div class="factura-row">
                                <span class="factura-id">#FAC-0294</span>
                                <span class="factura-cliente">Luis M. · Focus</span>
                                <span class="factura-importe">€1.384.20</span>
                                <span class="factura-estado impagado">Vencida 45d</span>
                                <button class="baremo-add" style="margin-left:auto">Recordar</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== PASO 6: MARCAR ENTREGADO ========== --}}
                <div class="panel" id="panel-entrega">
                    <div class="kpi-row">
                        <div class="kpi">
                            <span class="kpi-label">Listos para entrega</span>
                            <span class="kpi-value">2</span>
                            <span class="kpi-delta up">Pagados y revisados</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Entregados hoy</span>
                            <span class="kpi-value">3</span>
                            <span class="kpi-delta up">↑ 1 vs ayer</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Tiempo medio en taller</span>
                            <span class="kpi-value">1.4 días</span>
                            <span class="kpi-delta up">↓ 0.2d esta semana</span>
                        </div>
                        <div class="kpi">
                            <span class="kpi-label">Satisfacción cliente</span>
                            <span class="kpi-value">4.8 ★</span>
                            <span class="kpi-delta up">Últimas 30 reseñas</span>
                        </div>
                    </div>

                    <div class="grid-2">
                        {{-- Coche 1 --}}
                        <div class="card">
                            <div class="card-title" style="justify-content:space-between">
                                <span style="display:flex;align-items:center;gap:8px">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    OR #0245 · Renault Clio · Pedro Ruiz
                                </span>
                                <span class="status-pill s-pago">💳 Pago confirmado</span>
                            </div>
                            <div style="font-size:12px;color:#6b7280;margin-bottom:12px">
                                Propietario: <strong style="color:#f9fafb">Pedro Ruiz Olmedo</strong> · 628 441 920 · Recogida prevista: Hoy 17:00
                            </div>
                            <div class="checklist" id="checklist-245">
                                <div class="check-item checked" onclick="toggleCheck(this)">
                                    <div class="check-box">
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="check-label">Reparación completada y documentada en OR</span>
                                </div>
                                <div class="check-item checked" onclick="toggleCheck(this)">
                                    <div class="check-box">
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="check-label">Prueba de carretera realizada</span>
                                </div>
                                <div class="check-item checked" onclick="toggleCheck(this)">
                                    <div class="check-box">
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="check-label">Pago confirmado (Tarjeta ✓)</span>
                                </div>
                                <div class="check-item" onclick="toggleCheck(this)">
                                    <div class="check-box"></div>
                                    <span class="check-label">Vehículo limpio interior/exterior</span>
                                </div>
                                <div class="check-item" onclick="toggleCheck(this)">
                                    <div class="check-box"></div>
                                    <span class="check-label">Llave y documentación preparadas</span>
                                </div>
                                <div class="check-item" onclick="toggleCheck(this)">
                                    <div class="check-box"></div>
                                    <span class="check-label">Cliente notificado por WhatsApp</span>
                                </div>
                            </div>
                            <div style="text-align:right;margin-top:12px">
                                <button class="btn btn-success btn-sm" onclick="marcarEntregado(this,'OR #0245')">
                                    🚗 Marcar como entregado
                                </button>
                            </div>
                        </div>

                        {{-- Coche 2 --}}
                        <div class="card">
                            <div class="card-title" style="justify-content:space-between">
                                <span style="display:flex;align-items:center;gap:8px">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    OR #0244 · Peugeot 308 · Luis González
                                </span>
                                <span class="status-pill s-pago">💳 Pago confirmado</span>
                            </div>
                            <div style="font-size:12px;color:#6b7280;margin-bottom:12px">
                                Propietario: <strong style="color:#f9fafb">María Fernández</strong> · 655 112 930 · Recogida prevista: Hoy 18:30
                            </div>
                            <div class="checklist" id="checklist-244">
                                <div class="check-item checked" onclick="toggleCheck(this)">
                                    <div class="check-box">
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="check-label">Reparación completada y documentada en OR</span>
                                </div>
                                <div class="check-item checked" onclick="toggleCheck(this)">
                                    <div class="check-box">
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="check-label">Prueba de carretera realizada</span>
                                </div>
                                <div class="check-item checked" onclick="toggleCheck(this)">
                                    <div class="check-box">
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="check-label">Pago confirmado (Bizum ✓)</span>
                                </div>
                                <div class="check-item checked" onclick="toggleCheck(this)">
                                    <div class="check-box">
                                        <svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="check-label">Vehículo limpio interior/exterior</span>
                                </div>
                                <div class="check-item" onclick="toggleCheck(this)">
                                    <div class="check-box"></div>
                                    <span class="check-label">Llave y documentación preparadas</span>
                                </div>
                                <div class="check-item" onclick="toggleCheck(this)">
                                    <div class="check-box"></div>
                                    <span class="check-label">Cliente notificado por WhatsApp</span>
                                </div>
                            </div>
                            <div style="text-align:right;margin-top:12px">
                                <button class="btn btn-success btn-sm" onclick="marcarEntregado(this,'OR #0244')">
                                    🚗 Marcar como entregado
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== PRESUPUESTOS (con gráficas) ========== --}}
                <div class="panel" id="panel-presupuestos">

                    {{-- GRÁFICAS --}}
                    <div class="grid-2" style="margin-bottom:1rem">
                        <div class="card card-last">
                            <div class="card-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Presupuestos emitidos · Últimos 6 meses
                            </div>
                            <div class="chart-section">
                                <div class="bar-chart" style="align-items:flex-end">
                                    <div class="bar-col">
                                        <span class="bar-val">€8.2k</span>
                                        <div class="bar-fill" style="height:55px;background:#1d4ed8"></div>
                                        <span class="bar-label">Dic</span>
                                    </div>
                                    <div class="bar-col">
                                        <span class="bar-val">€9.1k</span>
                                        <div class="bar-fill" style="height:61px;background:#1d4ed8"></div>
                                        <span class="bar-label">Ene</span>
                                    </div>
                                    <div class="bar-col">
                                        <span class="bar-val">€11.4k</span>
                                        <div class="bar-fill" style="height:76px;background:#1d4ed8"></div>
                                        <span class="bar-label">Feb</span>
                                    </div>
                                    <div class="bar-col">
                                        <span class="bar-val">€10.8k</span>
                                        <div class="bar-fill" style="height:72px;background:#1d4ed8"></div>
                                        <span class="bar-label">Mar</span>
                                    </div>
                                    <div class="bar-col">
                                        <span class="bar-val">€13.2k</span>
                                        <div class="bar-fill" style="height:88px;background:#2563eb"></div>
                                        <span class="bar-label">Abr</span>
                                    </div>
                                    <div class="bar-col">
                                        <span class="bar-val">€14.8k</span>
                                        <div class="bar-fill" style="height:100px;background:#3b82f6"></div>
                                        <span class="bar-label">May</span>
                                    </div>
                                </div>
                            </div>
                            <div style="display:flex;gap:16px;margin-top:8px;font-size:12px;color:#6b7280;border-top:1px solid #374151;padding-top:8px">
                                <span>Emitidos este mes: <strong style="color:#f9fafb">38</strong></span>
                                <span>Aceptados: <strong style="color:#4ade80">31 (81%)</strong></span>
                                <span>Rechazados: <strong style="color:#f87171">7</strong></span>
                            </div>
                        </div>

                        <div class="card card-last">
                            <div class="card-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                                Desglose por tipo de servicio · Mayo
                            </div>
                            <div class="donut-wrap">
                                <svg viewBox="0 0 100 100" width="110" height="110" style="flex-shrink:0">
                                    <!-- donut chart SVG con stroke-dasharray -->
                                    <circle cx="50" cy="50" r="38" fill="none" stroke="#374151" stroke-width="18" />
                                    <!-- Mecánica compleja 38% → 239.1 de 238.76 -->
                                    <circle cx="50" cy="50" r="38" fill="none" stroke="#3b82f6" stroke-width="18"
                                        stroke-dasharray="90.7 238.76" stroke-dashoffset="0" transform="rotate(-90 50 50)" />
                                    <!-- Mecánica rápida 27% -->
                                    <circle cx="50" cy="50" r="38" fill="none" stroke="#22c55e" stroke-width="18"
                                        stroke-dasharray="64.5 238.76" stroke-dashoffset="-90.7" transform="rotate(-90 50 50)" />
                                    <!-- Piezas 20% -->
                                    <circle cx="50" cy="50" r="38" fill="none" stroke="#f59e0b" stroke-width="18"
                                        stroke-dasharray="47.8 238.76" stroke-dashoffset="-155.2" transform="rotate(-90 50 50)" />
                                    <!-- Diagnóstico 15% -->
                                    <circle cx="50" cy="50" r="38" fill="none" stroke="#a855f7" stroke-width="18"
                                        stroke-dasharray="35.8 238.76" stroke-dashoffset="-203" transform="rotate(-90 50 50)" />
                                    <text x="50" y="54" text-anchor="middle" font-size="11" font-weight="700" fill="#f9fafb">€14.8k</text>
                                </svg>
                                <div class="donut-legend">
                                    <div class="donut-leg-item">
                                        <span class="donut-leg-dot" style="background:#3b82f6"></span>
                                        Mecánica compleja
                                        <span class="donut-leg-val">38% · €5.6k</span>
                                    </div>
                                    <div class="donut-leg-item">
                                        <span class="donut-leg-dot" style="background:#22c55e"></span>
                                        Mecánica rápida
                                        <span class="donut-leg-val">27% · €4.0k</span>
                                    </div>
                                    <div class="donut-leg-item">
                                        <span class="donut-leg-dot" style="background:#f59e0b"></span>
                                        Piezas y recambios
                                        <span class="donut-leg-val">20% · €3.0k</span>
                                    </div>
                                    <div class="donut-leg-item">
                                        <span class="donut-leg-dot" style="background:#a855f7"></span>
                                        Diagnosis
                                        <span class="donut-leg-val">15% · €2.2k</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CONSTRUCTOR + BAREMO --}}
                    <div class="grid-2">
                        <div>
                            <div class="card">
                                <div class="card-title">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Buscador de baremo
                                </div>
                                <input class="search-input" type="text" placeholder="Ej: embrague Seat Ibiza 1.0 TSI…">
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
                                    <span class="baremo-op">Frenos delanteros Golf VII (discos+pastillas)</span>
                                    <span class="baremo-tiempo">1.5 h</span>
                                    <span class="baremo-precio">€120</span>
                                    <button class="baremo-add" onclick="addBaremo('M.O. Frenos delanteros Golf VII (1.5h)','120.00')">+ Añadir</button>
                                </div>
                            </div>

                            <div class="card card-last">
                                <div class="card-title">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
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
                                        <div style="font-size:13px;color:#d1d5db">Discos freno delant. TRW · Golf VII</div>
                                        <div class="pieza-ref">REF: TRW DF6116S</div>
                                    </div>
                                    <span class="pieza-stock">En stock</span>
                                    <span class="pieza-precio">€95.80</span>
                                    <button class="baremo-add" onclick="addBaremo('Discos freno TRW Golf VII','95.80')">+ Añadir</button>
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

                        <div class="card" style="display:flex;flex-direction:column">
                            <div class="card-title">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
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
                                        <td><input type="text" value="M.O. Frenos delanteros (1.5h)"></td>
                                        <td><input type="number" value="1" style="width:40px" oninput="recalcTotal()"></td>
                                        <td><input type="number" value="120.00" style="width:65px" oninput="recalcTotal()"></td>
                                        <td class="linea-total" style="font-weight:600">€120.00</td>
                                        <td><button onclick="removeRow(this)" style="background:none;border:none;cursor:pointer;color:#6b7280">✕</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" value="Discos freno TRW Golf VII"></td>
                                        <td><input type="number" value="1" style="width:40px" oninput="recalcTotal()"></td>
                                        <td><input type="number" value="95.80" style="width:65px" oninput="recalcTotal()"></td>
                                        <td class="linea-total" style="font-weight:600">€95.80</td>
                                        <td><button onclick="removeRow(this)" style="background:none;border:none;cursor:pointer;color:#6b7280">✕</button></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" value="Pastillas freno Brembo"></td>
                                        <td><input type="number" value="1" style="width:40px" oninput="recalcTotal()"></td>
                                        <td><input type="number" value="42.60" style="width:65px" oninput="recalcTotal()"></td>
                                        <td class="linea-total" style="font-weight:600">€42.60</td>
                                        <td><button onclick="removeRow(this)" style="background:none;border:none;cursor:pointer;color:#6b7280">✕</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-sm" style="align-self:flex-start;margin-bottom:auto" onclick="addBlankRow()">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Añadir línea
                            </button>
                            <div class="presup-total">
                                <span>Subtotal</span><span id="total-sub">€258.40</span>
                                <span>IVA 21%</span><span id="total-iva">€54.26</span>
                                <span>Total</span><span class="presup-total-value" id="total-final">€312.66</span>
                            </div>
                            <div class="firma-section">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <div class="firma-text">Enviar para <strong>firma digital</strong> · El cliente acepta desde su móvil.</div>
                                <div style="display:flex;gap:6px">
                                    <button class="btn btn-sm">📱 WhatsApp</button>
                                    <button class="btn btn-sm">✉️ Email</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ========== FACTURACIÓN ========== --}}
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
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Excel · PDF
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="card card-danger">
                        <div class="card-title" style="color:#f87171">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Control de impagados
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0301</span><span class="factura-cliente">Roberto Núñez · Golf VII</span>
                            <span class="factura-importe">€890.00</span><span class="factura-estado impagado">Vencida 30d</span>
                            <button class="baremo-add" style="margin-left:auto">Recordatorio</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0298</span><span class="factura-cliente">Carmen Vidal · Ibiza</span>
                            <span class="factura-importe">€245.50</span><span class="factura-estado impagado">Vencida 15d</span>
                            <button class="baremo-add" style="margin-left:auto">Recordatorio</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0294</span><span class="factura-cliente">Luis Mora · Focus</span>
                            <span class="factura-importe">€1.384.20</span><span class="factura-estado impagado">Vencida 45d</span>
                            <button class="baremo-add" style="margin-left:auto">Recordatorio</button>
                        </div>
                    </div>

                    <div class="card card-last">
                        <div class="card-title">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Historial de facturas
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0311</span><span class="factura-cliente">Ana López · Golf VII</span>
                            <span class="factura-importe">€312.66</span><span class="factura-estado pendiente">Pendiente firma</span>
                            <button class="baremo-add" style="margin-left:auto">Convertir a factura</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0310</span><span class="factura-cliente">Pedro Ruiz · Clio</span>
                            <span class="factura-importe">€267.29</span><span class="factura-estado cobrado">✓ Cobrada</span>
                            <button class="baremo-add" style="margin-left:auto">Descargar</button>
                        </div>
                        <div class="factura-row">
                            <span class="factura-id">#FAC-0309</span><span class="factura-cliente">Marta Jiménez · Polo</span>
                            <span class="factura-importe">€635.00</span><span class="factura-estado cobrado">✓ Cobrada</span>
                            <button class="baremo-add" style="margin-left:auto">Descargar</button>
                        </div>
                    </div>
                </div>

            </div>{{-- /content --}}
        </div>{{-- /main --}}
    </div>{{-- /dash --}}

</section>

{{-- MODAL NUEVA SOLICITUD --}}
<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this)hideModal()">
    <div class="modal-box">
        <div class="modal-header">
            <span id="modal-title">Nueva solicitud de reparación</span>
            <button onclick="hideModal()">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="form-grid">
            <div class="form-field"><label>Matrícula</label><input type="text" placeholder="1234 ABC" style="text-transform:uppercase"></div>
            <div class="form-field"><label>Teléfono cliente</label><input type="text" placeholder="600 000 000"></div>
            <div class="form-field" style="grid-column:span 2">
                <label>Descripción del problema</label>
                <textarea placeholder="Describe la avería o servicio solicitado…" style="min-height:80px"></textarea>
            </div>
            <div class="form-field">
                <label>Urgencia</label>
                <select>
                    <option>Normal</option>
                    <option>Media</option>
                    <option>Urgente</option>
                </select>
            </div>
            <div class="form-field">
                <label>Tipo de servicio</label>
                <select>
                    <option>Mecánica rápida</option>
                    <option>Mecánica compleja</option>
                    <option>Diagnóstico</option>
                    <option>ITV</option>
                    <option>Chapa y pintura</option>
                </select>
            </div>
        </div>
        <div style="text-align:right;margin-top:14px">
            <button class="btn" onclick="hideModal()" style="margin-right:8px">Cancelar</button>
            <button class="btn btn-primary" onclick="hideModal()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear solicitud
            </button>
        </div>
    </div>
</div>

<script>
    // ---------- NAVEGACIÓN ----------
    const panelTitles = {
        solicitudes: 'Paso 1 · Revisar solicitudes',
        mecanico: 'Paso 2 · Asignar mecánico responsable',
        programar: 'Paso 3 · Programar fecha de reparación',
        piezas: 'Paso 4 · Aprobar compra de piezas',
        pago: 'Paso 5 · Confirmar pago',
        entrega: 'Paso 6 · Marcar coche como entregado',
        presupuestos: 'Constructor de presupuestos',
        facturacion: 'Facturación y cobro',
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

    // ---------- MECÁNICO: SELECCIÓN ----------
    function selectMec(card) {
        card.closest('.mec-grid').querySelectorAll('.mec-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
    }

    // ---------- CALENDARIO: SELECCIÓN SLOT ----------
    let selectedSlot = null;

    function selectSlot(cell) {
        if (cell.classList.contains('wg-busy')) return;
        if (selectedSlot) selectedSlot.classList.remove('wg-selected');
        cell.classList.add('wg-selected');
        selectedSlot = cell;
    }

    // ---------- PAGO: MÉTODO ----------
    function selectPago(btn) {
        btn.closest('.pago-metodo').querySelectorAll('.pago-btn').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
    }

    // ---------- APROBACIÓN PIEZAS (toggle) ----------
    function toggleApprove(btn) {
        btn.classList.toggle('on');
        btn.title = btn.classList.contains('on') ? 'Aprobado' : 'Pendiente aprobación';
    }

    // ---------- ENTREGA: CHECKLIST ----------
    function toggleCheck(item) {
        item.classList.toggle('checked');
        const box = item.querySelector('.check-box');
        if (item.classList.contains('checked')) {
            box.innerHTML = '<svg width="10" height="10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>';
        } else {
            box.innerHTML = '';
        }
    }

    function marcarEntregado(btn, label) {
        const card = btn.closest('.card');
        const statusPill = card.querySelector('.status-pill');
        if (statusPill) {
            statusPill.className = 'status-pill s-entregado';
            statusPill.textContent = '✅ Entregado';
        }
        btn.textContent = '✓ Entregado';
        btn.disabled = true;
        btn.style.opacity = '0.5';
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
            const pu = parseFloat(row.querySelectorAll('input')[2]?.value) || 0;
            const linea = uds * pu;
            const totalCell = row.querySelector('.linea-total');
            if (totalCell) totalCell.textContent = '€' + linea.toFixed(2);
            sub += linea;
        });
        const iva = sub * 0.21;
        document.getElementById('total-sub').textContent = '€' + sub.toFixed(2);
        document.getElementById('total-iva').textContent = '€' + iva.toFixed(2);
        document.getElementById('total-final').textContent = '€' + (sub + iva).toFixed(2);
    }

    // ---------- MODAL ----------
    function showModal(type) {
        document.getElementById('modalOverlay').classList.add('open');
    }

    function hideModal() {
        document.getElementById('modalOverlay').classList.remove('open');
    }
</script>
@endsection
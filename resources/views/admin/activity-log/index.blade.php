@extends('admin.layouts.app')
@section('title', 'Log Aktivitas')

@section('content')
<div class="page-hd">
    <div>
        <h1 class="page-hd-title">Log Aktivitas (CRUD)</h1>
        <p class="page-hd-sub">Pantau perubahan data di sistem yang dilakukan oleh akun.</p>
    </div>
</div>

<div class="filter-bar mb-4">
    <form action="{{ route('admin.activity-log.index') }}" method="GET" class="d-flex gap-2 align-items-center w-100" style="flex-wrap:nowrap;">
        @php
            $reqSearch = request('search', '');
        @endphp
        <input type="text" name="search" class="form-control" style="flex:1 1 0; min-width:0;"
               placeholder="Cari nama user, modul..." value="{{ $reqSearch }}">

        @php
            $reqModule = request('module');
            $modLabel = 'Semua Modul';
            if ($reqModule) $modLabel = $reqModule;
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width: 180px;">
            <input type="hidden" name="module" value="{{ $reqModule }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $modLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqModule == '' ? 'active' : '' }}" data-value="">Semua Modul</li>
                @foreach($modules as $mod)
                    @php $basename = class_basename($mod); @endphp
                    <li class="custom-dropdown-option {{ $reqModule == $basename ? 'active' : '' }}" data-value="{{ $basename }}">{{ $basename }}</li>
                @endforeach
            </ul>
        </div>

        @php
            $reqEvent = request('event');
            $eventOptions = ['created' => 'Created', 'updated' => 'Updated', 'deleted' => 'Deleted'];
            $eventLabel = 'Semua Aksi';
            if ($reqEvent && isset($eventOptions[$reqEvent])) $eventLabel = $eventOptions[$reqEvent];
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width: 150px;">
            <input type="hidden" name="event" value="{{ $reqEvent }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $eventLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqEvent == '' ? 'active' : '' }}" data-value="">Semua Aksi</li>
                @foreach($eventOptions as $v => $l)
                <li class="custom-dropdown-option {{ $reqEvent == $v ? 'active' : '' }}" data-value="{{ $v }}">{{ $l }}</li>
                @endforeach
            </ul>
        </div>

        @php
            $reqUserId = request('user_id');
            $userLabel = 'Semua User';
            if ($reqUserId) {
                $selUser = collect($users)->firstWhere('id', $reqUserId);
                if ($selUser) $userLabel = $selUser->name;
            }
        @endphp
        <div class="custom-dropdown-wrapper flex-shrink-0" style="width: 200px;">
            <input type="hidden" name="user_id" value="{{ $reqUserId }}">
            <div class="custom-dropdown-trigger">
                <span class="custom-dropdown-label">{{ $userLabel }}</span>
                <i class="bi bi-chevron-down custom-dropdown-arrow"></i>
            </div>
            <ul class="custom-dropdown-options-container">
                <li class="custom-dropdown-option {{ $reqUserId == '' ? 'active' : '' }}" data-value="">Semua User</li>
                @foreach($users as $u)
                <li class="custom-dropdown-option {{ $reqUserId == $u->id ? 'active' : '' }}" data-value="{{ $u->id }}">{{ $u->name }} ({{ $u->getRoleLabel() }})</li>
                @endforeach
            </ul>
        </div>

        <button type="submit" class="btn btn-primary flex-shrink-0"><i class="bi bi-funnel-fill me-1"></i>Filter</button>
        @if(request()->hasAny(['module', 'event', 'user_id', 'search']))
        <a href="{{ route('admin.activity-log.index') }}" class="btn btn-outline-secondary flex-shrink-0">Reset</a>
        @endif
    </form>
</div>

<div class="admin-table">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>User / Aktor</th>
                    <th>Aksi</th>
                    <th>Modul / ID Data</th>
                    <th width="100">Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $log->created_at->format('d M Y') }}</div>
                        <small class="text-muted">{{ $log->created_at->format('H:i') }}</small>
                    </td>
                    <td>
                        @if($log->causer)
                            <div class="fw-bold">{{ $log->causer->name }}</div>
                            <span class="badge {{ $log->causer->getRoleBadgeClass() }}">{{ $log->causer->getRoleLabel() }}</span>
                        @else
                            <span class="text-muted">Sistem / Guest</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $badgeColor = match($log->event) {
                                'created' => 'success',
                                'updated' => 'primary',
                                'deleted' => 'danger',
                                default   => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badgeColor }} text-capitalize">{{ $log->event }}</span>
                    </td>
                    <td>
                        <div class="fw-bold">{{ class_basename($log->subject_type) }}</div>
                        <small class="text-muted">ID: {{ $log->subject_id }}</small>
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-log-{{ $log->id }}">
                            <i class="bi bi-eye"></i> Lihat
                        </button>
                    </td>
                </tr>



                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-clock-history fs-1 text-muted d-block mb-2"></i>
                        <h6 class="fw-bold">Belum Ada Log Aktivitas</h6>
                        <p class="text-muted small mb-0">Semua perubahan data (CRUD) akan tercatat di sini.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $logs->links() }}
</div>

<!-- Modals -->
@foreach($logs as $log)
    @php
        $badgeColor = match($log->event) {
            'created' => 'success',
            'updated' => 'primary',
            'deleted' => 'danger',
            default   => 'secondary',
        };
    @endphp
    <div class="modal fade" id="modal-log-{{ $log->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="border-radius:16px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Detail Perubahan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <p class="mb-1 text-muted small fw-bold">Modul / Data</p>
                            <div class="fw-bold">{{ class_basename($log->subject_type) }} (ID: {{ $log->subject_id }})</div>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-1 text-muted small fw-bold">Aksi</p>
                            <span class="badge bg-{{ $badgeColor }} text-capitalize">{{ $log->event }}</span>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-1 text-muted small fw-bold">Aktor</p>
                            <div class="fw-bold">{{ $log->causer ? $log->causer->name : 'Sistem / Guest' }}</div>
                        </div>
                    </div>

                    @if($log->properties && isset($log->properties['attributes']))
                        <h6 class="fw-bold mb-3">Data yang Direkam (Hanya Kolom yang Berubah):</h6>
                        <div class="table-responsive border rounded-3 mb-4">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="20%">Kolom</th>
                                        @if(isset($log->properties['old'])) <th width="40%">Nilai Lama</th> @endif
                                        <th width="{{ isset($log->properties['old']) ? '40%' : '80%' }}">Nilai Baru</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($log->properties['attributes'] as $key => $newValue)
                                        @php
                                            $oldValue = $log->properties['old'][$key] ?? null;
                                        @endphp
                                        <tr>
                                            <td class="fw-bold text-muted">{{ $key }}</td>
                                            @if(isset($log->properties['old']))
                                            <td style="word-break: break-word; white-space: pre-wrap; background: #fff5f5;">
                                                @if(is_array($oldValue) || is_object($oldValue))
                                                    <pre class="mb-0" style="font-size:11px;">{{ json_encode($oldValue, JSON_PRETTY_PRINT) }}</pre>
                                                @else
                                                    {{ $oldValue }}
                                                @endif
                                            </td>
                                            @endif
                                            <td style="word-break: break-word; white-space: pre-wrap; background: #f0fdf4;">
                                                @if(is_array($newValue) || is_object($newValue))
                                                    <pre class="mb-0" style="font-size:11px;">{{ json_encode($newValue, JSON_PRETTY_PRINT) }}</pre>
                                                @else
                                                    {{ $newValue }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@extends('admin.layouts.app')

@section('title', 'Pengaturan Navbar Admin')

@push('styles')
<style>
.menu-card {
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    margin-bottom: 8px;
    transition: box-shadow .2s, border-color .2s;
    overflow: hidden;
}
.menu-card:hover {
    box-shadow: 0 4px 18px rgba(0,85,165,.10);
    border-color: #a5b4fc;
}
.menu-card.sortable-ghost {
    opacity: 0.4;
    background: #eef2ff;
    border: 2px dashed #6366f1;
}
.menu-card.sortable-chosen {
    box-shadow: 0 8px 28px rgba(0,85,165,.18);
    border-color: #6366f1;
}
.menu-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    cursor: default;
}
.drag-handle {
    cursor: grab;
    color: #94a3b8;
    padding: 4px 6px;
    border-radius: 6px;
    transition: background .15s, color .15s;
    flex-shrink: 0;
}
.drag-handle:hover { background: #f1f5f9; color: #475569; }
.drag-handle:active { cursor: grabbing; }
.menu-icon-badge {
    width: 36px; height: 36px;
    background: #eef2ff;
    border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    color: #4f46e5;
    font-size: 16px;
    flex-shrink: 0;
}
.menu-info { flex: 1; min-width: 0; }
.menu-name { font-weight: 700; font-size: 14.5px; color: #1e293b; }
.menu-route { font-size: 12px; color: #64748b; font-family: monospace; }
.role-chip {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
}
.role-chip.super { background: #fef3c7; color: #92400e; border-color: #fde68a; }
.role-chip.marketing { background: #dbeafe; color: #1e40af; border-color: #bfdbfe; }
.role-chip.sdm { background: #d1fae5; color: #065f46; border-color: #a7f3d0; }

.sub-menu-list {
    background: #f8fafc;
    border-top: 1.5px solid #e2e8f0;
    padding: 8px 12px 8px 52px;
}
.sub-menu-item {
    background: #fff;
    border: 1.5px solid #e2e8f0;
    border-radius: 9px;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    transition: box-shadow .15s;
}
.sub-menu-item:last-child { margin-bottom: 0; }
.sub-menu-item.sortable-ghost { opacity: 0.4; background: #eef2ff; border: 2px dashed #a5b4fc; }
.sub-menu-item:hover { box-shadow: 0 2px 8px rgba(0,0,0,.07); }

.save-toast {
    position: fixed; bottom: 24px; right: 24px;
    background: #0f172a; color: #fff;
    padding: 12px 20px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 600;
    display: flex; align-items: center; gap: 10px;
    box-shadow: 0 8px 28px rgba(0,0,0,.25);
    z-index: 9999;
    opacity: 0;
    transform: translateY(12px);
    transition: opacity .3s, transform .3s;
    pointer-events: none;
}
.save-toast.show { opacity: 1; transform: translateY(0); }
.save-toast.success { background: #16a34a; }
.save-toast.error { background: #dc2626; }
</style>
@endpush

@section('content')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Susunan Navbar Admin</h4>
        <p class="text-muted mb-0 small">Drag & drop untuk mengubah urutan. Menu dengan sub-item bisa dikembangkan.</p>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i> Tambah Menu
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Menu List --}}
<div id="mainMenuList">
    @forelse($menus as $menu)
    <div class="menu-card" data-id="{{ $menu->id }}">
        {{-- Parent Row --}}
        <div class="menu-header">
            <span class="drag-handle" title="Drag untuk pindahkan"><i class="bi bi-grip-vertical fs-5"></i></span>

            <div class="menu-icon-badge">
                <i class="bi {{ $menu->icon ?? 'bi-grid-3x3-gap' }}"></i>
            </div>

            <div class="menu-info">
                <div class="menu-name">{{ $menu->name }}</div>
                <div class="menu-route">{{ $menu->route_name ?? '— Kategori —' }}</div>
            </div>

            <div class="d-flex gap-1 flex-wrap me-2">
                @foreach($menu->roles as $role)
                    @php
                        $cls = match($role) {
                            'super_admin' => 'super',
                            'admin_marketing' => 'marketing',
                            'admin_sdm' => 'sdm',
                            default => ''
                        };
                    @endphp
                    <span class="role-chip {{ $cls }}">{{ str_replace('admin_', '', $role) }}</span>
                @endforeach
            </div>

            <div class="d-flex gap-1 flex-shrink-0">
                <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus menu ini beserta sub-menunya?')"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>

        {{-- Sub-menu --}}
        @if($menu->children->count())
        <div class="sub-menu-list sub-sortable" data-parent="{{ $menu->id }}">
            @foreach($menu->children as $child)
            <div class="sub-menu-item" data-id="{{ $child->id }}">
                <span class="drag-handle sub-handle" title="Drag untuk pindahkan"><i class="bi bi-grip-vertical"></i></span>
                <div class="menu-icon-badge" style="width:30px;height:30px;font-size:13px;">
                    <i class="bi {{ $child->icon ?? 'bi-dot' }}"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-name" style="font-size:13.5px;">{{ $child->name }}</div>
                    <div class="menu-route">{{ $child->route_name ?? '-' }}</div>
                </div>
                <div class="d-flex gap-1 flex-wrap me-2">
                    @foreach($child->roles as $role)
                        @php $cls = match($role) { 'super_admin' => 'super', 'admin_marketing' => 'marketing', 'admin_sdm' => 'sdm', default => '' }; @endphp
                        <span class="role-chip {{ $cls }}">{{ str_replace('admin_', '', $role) }}</span>
                    @endforeach
                </div>
                <div class="d-flex gap-1 flex-shrink-0">
                    <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('admin.menus.destroy', $child) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Hapus sub-menu ini?')"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="sub-menu-list sub-sortable" data-parent="{{ $menu->id }}" style="min-height:8px;padding:4px 12px 4px 52px;">
            <p class="text-muted small mb-0 py-1" style="font-size:12px;">Belum ada sub-menu. Drag item ke sini atau tambah lewat tombol Tambah Menu.</p>
        </div>
        @endif
    </div>
    @empty
    <div class="text-center py-5 text-muted">
        <i class="bi bi-list-nested fs-1 d-block mb-3 opacity-50"></i>
        Belum ada menu yang dikonfigurasi. Klik <strong>Tambah Menu</strong> untuk memulai.
    </div>
    @endforelse
</div>

{{-- Toast notification --}}
<div class="save-toast" id="saveToast">
    <span id="saveToastIcon"></span>
    <span id="saveToastMsg">Urutan disimpan</span>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
const REORDER_URL = "{{ route('admin.menus.reorder') }}";
const CSRF_TOKEN  = "{{ csrf_token() }}";

function showToast(msg, type = 'success') {
    const toast = document.getElementById('saveToast');
    const icon  = document.getElementById('saveToastIcon');
    const text  = document.getElementById('saveToastMsg');
    toast.className = 'save-toast ' + type;
    icon.innerHTML  = type === 'success' ? '<i class="bi bi-check-circle-fill"></i>' : '<i class="bi bi-x-circle-fill"></i>';
    text.textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);
}

async function saveOrder() {
    const items = [];
    document.querySelectorAll('#mainMenuList > .menu-card').forEach((card, idx) => {
        const parentId = card.dataset.id;
        const children = [];
        card.querySelectorAll('.sub-sortable > .sub-menu-item').forEach((sub, ci) => {
            children.push({ id: sub.dataset.id, order: ci });
        });
        items.push({ id: parentId, order: idx, children });
    });

    try {
        const res = await fetch(REORDER_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ items })
        });
        if (res.ok) {
            showToast('Urutan disimpan!', 'success');
        } else {
            showToast('Gagal menyimpan urutan.', 'error');
        }
    } catch {
        showToast('Gagal terhubung ke server.', 'error');
    }
}

// Main list sortable
Sortable.create(document.getElementById('mainMenuList'), {
    animation: 180,
    handle: '.drag-handle:not(.sub-handle)',
    ghostClass: 'sortable-ghost',
    chosenClass: 'sortable-chosen',
    onEnd: saveOrder,
});

// Sub-list sortables (each parent's children)
document.querySelectorAll('.sub-sortable').forEach(el => {
    Sortable.create(el, {
        animation: 150,
        handle: '.sub-handle',
        ghostClass: 'sortable-ghost',
        group: 'sub-menus',   // allow moving between sub-lists
        onEnd: saveOrder,
    });
});
</script>
@endpush

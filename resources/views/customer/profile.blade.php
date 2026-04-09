@extends('customer.dashboard')

@section('page-title', 'My Profile')
@section('page-subtitle', 'View and manage your account information.')

@section('content')

<div style="display: grid; grid-template-columns: 320px 1fr; gap: 20px; align-items: start;">

    {{-- ── Left: Profile Card ── --}}
    <div>
        {{-- Hero Card --}}
        <div style="background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%); border-radius: 14px; padding: 28px 24px; margin-bottom: 16px; text-align: center; position: relative; overflow: hidden;">
            <div style="position:absolute;inset:0;background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/svg%3E');"></div>
            <div style="position:relative;">
                <div style="width:72px; height:72px; border-radius:50%; background:linear-gradient(135deg, #1e40af, #3b82f6); display:flex; align-items:center; justify-content:center; font-size:24px; font-weight:700; color:#fff; margin:0 auto 14px; border:3px solid rgba(255,255,255,0.15);">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div style="font-size:17px; font-weight:700; color:#fff;">{{ Auth::user()->name }}</div>
                <div style="font-size:12px; color:rgba(255,255,255,0.45); margin-top:3px;">{{ Auth::user()->email }}</div>
                <div style="margin-top:12px; display:inline-block; background:rgba(30,64,175,0.4); border:1px solid rgba(59,130,246,0.3); border-radius:6px; padding:3px 12px; font-size:11px; font-weight:600; color:#93c5fd;">
                    {{ ucfirst(Auth::user()->role) }}
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="card" style="padding: 16px 20px;">
            <div style="font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:14px;">Account Summary</div>
            <div style="display:flex; flex-direction:column; gap:12px;">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:13px; color:#64748b;">Total Orders</span>
                    <span style="font-size:13px; font-weight:700; color:#0f172a;">14</span>
                </div>
                <div style="height:1px; background:#f1f5f9;"></div>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:13px; color:#64748b;">Total Spent</span>
                    <span style="font-size:13px; font-weight:700; color:#0f172a;">£8,400</span>
                </div>
                <div style="height:1px; background:#f1f5f9;"></div>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:13px; color:#64748b;">Member Since</span>
                    <span style="font-size:13px; font-weight:700; color:#0f172a;">Jan 2024</span>
                </div>
                <div style="height:1px; background:#f1f5f9;"></div>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-size:13px; color:#64748b;">Account Status</span>
                    <span class="pill pill-green" style="font-size:11px;"><span class="pill-dot"></span>Active</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Right: Info Sections ── --}}
    <div style="display: flex; flex-direction: column; gap: 16px;">

        {{-- Personal Information --}}
        <div class="card">
            <div style="padding: 18px 20px 14px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #f1f5f9;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:32px;height:32px;background:#eff6ff;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <svg width="15" height="15" fill="none" stroke="#1e40af" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </div>
                    <span style="font-size:14px; font-weight:700; color:#0f172a;">Personal Information</span>
                </div>
                <button style="font-size:12px; font-weight:600; color:#1e40af; background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px;">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit
                </button>
            </div>
            <div style="padding: 8px 0;">
                @php
                $infoRows = [
                    ['label'=>'Full Name',      'value'=> Auth::user()->name,  'icon'=>'M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2'],
                    ['label'=>'Email Address',  'value'=> Auth::user()->email, 'icon'=>'M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'],
                    ['label'=>'Phone',          'value'=> '+91 98765 43210',   'icon'=>'M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .14h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 14l.01 2.92z'],
                    ['label'=>'Role',           'value'=> ucfirst(Auth::user()->role), 'icon'=>'M12 2a5 5 0 100 10A5 5 0 0012 2zm0 12c-5.33 0-8 2.67-8 4v2h16v-2c0-1.33-2.67-4-8-4z'],
                ];
                @endphp

                @foreach($infoRows as $row)
                <div style="display:flex; align-items:center; padding:12px 20px; border-bottom:1px solid #f8fafc;">
                    <div style="width:32px; height:32px; background:#f8fafc; border-radius:8px; display:flex; align-items:center; justify-content:center; margin-right:12px; flex-shrink:0;">
                        <svg width="14" height="14" fill="none" stroke="#64748b" stroke-width="2" viewBox="0 0 24 24"><path d="{{ $row['icon'] }}"/></svg>
                    </div>
                    <div style="flex:1;">
                        <div style="font-size:11px; color:#94a3b8; font-weight:600; margin-bottom:2px;">{{ $row['label'] }}</div>
                        <div style="font-size:13px; font-weight:600; color:#1e293b;">{{ $row['value'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Delivery Address --}}
        <div class="card">
            <div style="padding: 18px 20px 14px; display:flex; align-items:center; gap:10px; border-bottom:1px solid #f1f5f9;">
                <div style="width:32px;height:32px;background:#f0fdf4;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="#059669" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <span style="font-size:14px; font-weight:700; color:#0f172a;">Delivery Address</span>
            </div>
            <div style="padding: 16px 20px;">
                <div style="font-size:13px; color:#334155; line-height:1.7;">
                    42 MG Road, Koregaon Park<br>
                    Pune, Maharashtra — 411001<br>
                    India
                </div>
            </div>
        </div>

        {{-- Security --}}
        <div class="card">
            <div style="padding: 18px 20px 14px; display:flex; align-items:center; gap:10px; border-bottom:1px solid #f1f5f9;">
                <div style="width:32px;height:32px;background:#fff7ed;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                    <svg width="15" height="15" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                </div>
                <span style="font-size:14px; font-weight:700; color:#0f172a;">Security</span>
            </div>
            <div style="padding: 14px 20px; display:flex; align-items:center; justify-content:space-between;">
                <div>
                    <div style="font-size:13px; font-weight:600; color:#1e293b;">Password</div>
                    <div style="font-size:12px; color:#94a3b8; margin-top:2px;">Last changed 30 days ago</div>
                </div>
                <button style="background:#eff6ff; border:none; border-radius:8px; padding:8px 14px; font-size:12px; font-weight:600; color:#1e40af; cursor:pointer;">
                    Change
                </button>
            </div>
        </div>

    </div>
</div>

@endsection
@extends('layouts.admin')

@section('title', 'Admin Dashboard — Motra')
@section('page-title', 'Estate Overview')

@section('content')
  <style>
    .metrics-grid{
      display:grid;
      grid-template-columns:repeat(4, 1fr);
      gap:20px;
      margin-bottom:28px;
    }
    .metric-card{
      background:var(--paper);
      border:1px solid var(--line);
      padding:24px 22px;
      border-radius:2px;
      position:relative;
    }
    .metric-k{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.68rem;
      letter-spacing:0.12em;
      text-transform:uppercase;
      color:var(--clay);
      margin-bottom:8px;
    }
    .metric-v{
      font-family:'Fraunces', serif;
      font-size:2.4rem;
      line-height:1;
      color:var(--pine-deep);
      font-weight:600;
    }
    .metric-sub{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      color:var(--brass);
      margin-top:8px;
    }

    .breakdown-row{
      display:flex;
      gap:12px;
      flex-wrap:wrap;
      margin-top:14px;
    }
    .breakdown-pill{
      background:var(--paper-deep);
      border:1px solid var(--line);
      padding:8px 14px;
      border-radius:2px;
      font-size:0.8rem;
      display:flex;
      align-items:center;
      gap:8px;
    }
    .breakdown-pill b{
      font-family:'IBM Plex Mono', monospace;
      color:var(--pine-deep);
    }

    @media (max-width:960px){
      .metrics-grid{ grid-template-columns:repeat(2, 1fr); }
    }
    @media (max-width:560px){
      .metrics-grid{ grid-template-columns:1fr; }
    }
  </style>

  <!-- Metric Statistics Cards -->
  <div class="metrics-grid">
    <div class="metric-card">
      <div class="metric-k">Total Inquiries</div>
      <div class="metric-v">{{ $totalMessages }}</div>
      <div class="metric-sub">Form submissions</div>
    </div>

    <div class="metric-card">
      <div class="metric-k">Pending / Unread</div>
      <div class="metric-v" style="color:var(--brass);">{{ $unreadMessages }}</div>
      <div class="metric-sub">Requires attention</div>
    </div>

    <div class="metric-card">
      <div class="metric-k">Replied &amp; Processed</div>
      <div class="metric-v" style="color:#2f6e4a;">{{ $repliedMessages }}</div>
      <div class="metric-sub">Completed inquiries</div>
    </div>

    <div class="metric-card">
      <div class="metric-k">Received Today</div>
      <div class="metric-v">{{ $todayMessages }}</div>
      <div class="metric-sub">{{ date('d M Y') }}</div>
    </div>
  </div>

  <!-- Inquiries by Category Card -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Inquiry Breakdown by Channel</h3>
      <a href="{{ route('admin.messages.index') }}" class="btn-admin btn-admin-ghost">View Full Inbox →</a>
    </div>
    <div class="breakdown-row">
      @forelse($interestStats as $interest => $count)
        <div class="breakdown-pill">
          <span>{{ $interest }}:</span>
          <b>{{ $count }}</b>
        </div>
      @empty
        <span style="color:var(--clay); font-size:0.88rem;">No breakdown data available yet.</span>
      @endforelse
    </div>
  </div>

  <!-- Recent Inquiries Table -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Latest Contact Messages</h3>
      <div style="display:flex; gap:10px;">
        <a href="{{ route('admin.messages.export') }}" class="btn-admin btn-admin-ghost">Export CSV</a>
        <a href="{{ route('admin.messages.index') }}" class="btn-admin btn-admin-pine">Manage Inquiries</a>
      </div>
    </div>

    <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <th>Status</th>
            <th>Sender</th>
            <th>Company</th>
            <th>Type</th>
            <th>Message Excerpt</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentMessages as $msg)
            <tr>
              <td>
                <span class="badge badge-{{ $msg->status }}">{{ ucfirst($msg->status) }}</span>
              </td>
              <td>
                <strong>{{ $msg->name }}</strong><br>
                <small style="color:var(--clay); font-family:'IBM Plex Mono', monospace;">{{ $msg->email }}</small>
              </td>
              <td>{{ $msg->company ?: '—' }}</td>
              <td>
                <span style="font-family:'IBM Plex Mono', monospace; font-size:0.75rem;">{{ $msg->interest }}</span>
              </td>
              <td style="max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ $msg->message }}
              </td>
              <td style="font-family:'IBM Plex Mono', monospace; font-size:0.75rem;">
                {{ $msg->created_at->format('M d, Y H:i') }}
              </td>
              <td>
                <a href="{{ route('admin.messages.show', $msg) }}" class="btn-admin btn-admin-ghost" style="padding:4px 10px;">
                  Review
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align:center; padding:48px 20px; color:var(--clay);">
                <div style="font-size:1.8rem; margin-bottom:8px; opacity:0.6;">📭</div>
                <div style="font-weight:500; font-family:'Fraunces', serif; font-size:1.15rem; color:var(--pine-deep);">No inquiries received yet</div>
                <div style="font-size:0.85rem; margin-top:4px;">When visitors submit the contact form, their inquiries will appear here in real-time.</div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection

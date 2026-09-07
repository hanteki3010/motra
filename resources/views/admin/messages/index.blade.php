@extends('layouts.admin')

@section('title', 'Contact Inquiries — Motra Admin')
@section('page-title', 'Contact Inquiries & Form Submissions')

@section('content')
  <style>
    .filter-bar{
      background:var(--paper);
      border:1px solid var(--line);
      padding:18px 22px;
      margin-bottom:24px;
      border-radius:2px;
      display:flex;
      flex-wrap:wrap;
      align-items:center;
      justify-content:space-between;
      gap:16px;
    }
    .filter-inputs{
      display:flex;
      gap:12px;
      flex-wrap:wrap;
      align-items:center;
    }
    .status-tabs{
      display:flex;
      gap:6px;
      margin-bottom:20px;
      border-bottom:1px solid var(--line);
      padding-bottom:10px;
    }
    .status-tab{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.75rem;
      letter-spacing:0.06em;
      text-transform:uppercase;
      padding:6px 14px;
      border-radius:2px;
      color:var(--ink);
      text-decoration:none;
      border:1px solid transparent;
      transition:all .2s;
    }
    .status-tab:hover{
      background:var(--paper-deep);
    }
    .status-tab.active{
      background:var(--pine);
      color:var(--paper);
      font-weight:500;
    }
    .pagination-wrapper{
      margin-top:24px;
      display:flex;
      justify-content:space-between;
      align-items:center;
    }
    .action-group{
      display:flex;
      gap:8px;
      align-items:center;
    }
  </style>

  <!-- Status Tabs -->
  <div class="status-tabs">
    <a href="{{ route('admin.messages.index', request()->except('status', 'page')) }}" 
       class="status-tab {{ !request()->filled('status') ? 'active' : '' }}">
      All Inquiries
    </a>
    <a href="{{ route('admin.messages.index', array_merge(request()->except('page'), ['status' => 'unread'])) }}" 
       class="status-tab {{ request('status') === 'unread' ? 'active' : '' }}">
      Unread
    </a>
    <a href="{{ route('admin.messages.index', array_merge(request()->except('page'), ['status' => 'read'])) }}" 
       class="status-tab {{ request('status') === 'read' ? 'active' : '' }}">
      Read
    </a>
    <a href="{{ route('admin.messages.index', array_merge(request()->except('page'), ['status' => 'replied'])) }}" 
       class="status-tab {{ request('status') === 'replied' ? 'active' : '' }}">
      Replied
    </a>
    <a href="{{ route('admin.messages.index', array_merge(request()->except('page'), ['status' => 'archived'])) }}" 
       class="status-tab {{ request('status') === 'archived' ? 'active' : '' }}">
      Archived
    </a>
  </div>

  <!-- Filter & Search Controls -->
  <div class="filter-bar">
    <form action="{{ route('admin.messages.index') }}" method="GET" class="filter-inputs">
      @if(request()->filled('status'))
        <input type="hidden" name="status" value="{{ request('status') }}">
      @endif

      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, company..." class="form-control" style="width:240px; padding:8px 12px;">

      <select name="interest" class="form-control" style="width:220px; padding:8px 12px;" onchange="this.form.submit()">
        <option value="">All Enquiry Types</option>
        @foreach($interestTypes as $type)
          <option value="{{ $type }}" {{ request('interest') === $type ? 'selected' : '' }}>
            {{ $type }}
          </option>
        @endforeach
      </select>

      <button type="submit" class="btn-admin btn-admin-pine">Filter</button>

      @if(request()->filled('search') || request()->filled('interest') || request()->filled('status'))
        <a href="{{ route('admin.messages.index') }}" class="btn-admin btn-admin-ghost">Clear Filters</a>
      @endif
    </form>

    <div>
      <a href="{{ route('admin.messages.export', request()->query()) }}" class="btn-admin btn-admin-brass">
        📥 Export CSV
      </a>
    </div>
  </div>

  <!-- Messages Table Card -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        Showing {{ $messages->total() }} Inquiries
      </h3>
    </div>

    <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <th>Status</th>
            <th>Contact Name &amp; Email</th>
            <th>Company</th>
            <th>Enquiry Type</th>
            <th>Message</th>
            <th>Received Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($messages as $msg)
            <tr>
              <td>
                <form action="{{ route('admin.messages.status', $msg) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('PATCH')
                  <select name="status" onchange="this.form.submit()" class="badge badge-{{ $msg->status }}" style="cursor:pointer; border-radius:2px; font-family:'IBM Plex Mono', monospace; font-size:0.68rem; padding:4px 6px;">
                    <option value="unread" {{ $msg->status === 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ $msg->status === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ $msg->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="archived" {{ $msg->status === 'archived' ? 'selected' : '' }}>Archived</option>
                  </select>
                </form>
              </td>
              <td>
                <a href="{{ route('admin.messages.show', $msg) }}" style="font-weight:600; color:var(--pine-deep);">
                  {{ $msg->name }}
                </a>
                <div style="font-family:'IBM Plex Mono', monospace; font-size:0.75rem; color:var(--clay);">
                  <a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a>
                </div>
              </td>
              <td>{{ $msg->company ?: '—' }}</td>
              <td>
                <span style="font-family:'IBM Plex Mono', monospace; font-size:0.74rem;">{{ $msg->interest }}</span>
              </td>
              <td style="max-width:280px;">
                <div style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-size:0.86rem; color:#4a5a4d;">
                  {{ $msg->message }}
                </div>
                @if($msg->notes)
                  <small style="color:var(--brass); font-family:'IBM Plex Mono', monospace; font-size:0.68rem; display:block; margin-top:2px;">
                    📝 Note: {{ Str::limit($msg->notes, 40) }}
                  </small>
                @endif
              </td>
              <td style="font-family:'IBM Plex Mono', monospace; font-size:0.75rem; white-space:nowrap;">
                {{ $msg->created_at->format('Y-m-d H:i') }}
              </td>
              <td>
                <div class="action-group">
                  <a href="{{ route('admin.messages.show', $msg) }}" class="btn-admin btn-admin-ghost" style="padding:4px 8px;" title="View Details">
                    Review
                  </a>
                  <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message record?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-admin btn-admin-danger" style="padding:4px 8px;" title="Delete Record">
                      ✕
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align:center; padding:54px 20px; color:var(--clay);">
                <div style="font-size:2rem; margin-bottom:10px; opacity:0.5;">📭</div>
                <div style="font-weight:500; font-family:'Fraunces', serif; font-size:1.2rem; color:var(--pine-deep);">No contact messages found</div>
                <div style="font-size:0.85rem; margin-top:4px; max-width:400px; margin-left:auto; margin-right:auto;">
                  @if(request()->filled('search') || request()->filled('status') || request()->filled('interest'))
                    No messages match the current filters. Try clearing your search parameters.
                  @else
                    There are currently no contact messages stored in the database.
                  @endif
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
      <div class="pagination-wrapper">
        <span style="font-family:'IBM Plex Mono', monospace; font-size:0.76rem; color:var(--clay);">
          Page {{ $messages->currentPage() }} of {{ $messages->lastPage() }} (Total: {{ $messages->total() }})
        </span>
        <div>
          {{ $messages->links() }}
        </div>
      </div>
    @endif
  </div>
@endsection

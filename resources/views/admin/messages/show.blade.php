@extends('layouts.admin')

@section('title', 'Review Inquiry — ' . $message->name)
@section('page-title', 'Inquiry Details')

@section('content')
  <style>
    .message-layout{
      display:grid;
      grid-template-columns:1fr 340px;
      gap:28px;
    }
    .message-body-box{
      background:var(--paper-deep);
      border:1px solid var(--line);
      padding:28px 30px;
      border-radius:2px;
      margin-top:20px;
      font-size:1.02rem;
      line-height:1.7;
      color:var(--ink);
      white-space:pre-wrap;
    }
    .meta-row{
      display:flex;
      justify-content:space-between;
      padding:10px 0;
      border-bottom:1px dashed var(--line);
      font-size:0.88rem;
    }
    .meta-row:last-child{ border-bottom:none; }
    .meta-k{
      font-family:'IBM Plex Mono', monospace;
      font-size:0.72rem;
      letter-spacing:0.08em;
      text-transform:uppercase;
      color:var(--clay);
    }
    .meta-v{
      font-weight:500;
      color:var(--pine-deep);
    }
    @media (max-width:960px){
      .message-layout{ grid-template-columns:1fr; }
    }
  </style>

  <div style="margin-bottom:20px;">
    <a href="{{ route('admin.messages.index') }}" class="btn-admin btn-admin-ghost">← Back to Inquiries Inbox</a>
  </div>

  <div class="message-layout">
    <!-- Left Column: Message Content -->
    <div class="card">
      <div class="card-header">
        <div>
          <span class="eyebrow" style="margin-bottom:8px;">Inquiry Reference #{{ $message->id }}</span>
          <h2 style="font-size:1.6rem; color:var(--pine-deep);">{{ $message->name }}</h2>
          @if($message->company)
            <div style="color:var(--clay); font-size:0.95rem; margin-top:4px;">{{ $message->company }}</div>
          @endif
        </div>
        <div>
          <span class="badge badge-{{ $message->status }}" style="font-size:0.78rem; padding:6px 12px;">
            Status: {{ ucfirst($message->status) }}
          </span>
        </div>
      </div>

      <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
        <div style="font-family:'IBM Plex Mono', monospace; font-size:0.76rem; color:var(--clay);">
          Type: <b style="color:var(--pine-deep);">{{ $message->interest }}</b> · Submitted on {{ $message->created_at->format('M d, Y \a\t H:i:s') }}
        </div>
        <a href="mailto:{{ $message->email }}?subject={{ urlencode('Regarding your inquiry to Motra Farm: ' . $message->interest) }}" class="btn-admin btn-admin-brass">
          ✉ Reply via Email ({{ $message->email }})
        </a>
      </div>

      <div class="message-body-box">
{{ $message->message }}
      </div>

      <!-- Quick Status Form -->
      <div style="margin-top:28px; padding-top:20px; border-top:1px solid var(--line); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
        <form action="{{ route('admin.messages.status', $message) }}" method="POST" style="display:flex; align-items:center; gap:10px;">
          @csrf
          @method('PATCH')
          <label style="margin:0; font-family:'IBM Plex Mono', monospace; font-size:0.72rem; text-transform:uppercase; color:var(--clay);">Update Status:</label>
          <select name="status" class="form-control" style="width:160px; padding:6px 10px;">
            <option value="unread" {{ $message->status === 'unread' ? 'selected' : '' }}>Unread</option>
            <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>Read</option>
            <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Replied</option>
            <option value="archived" {{ $message->status === 'archived' ? 'selected' : '' }}>Archived</option>
          </select>
          <button type="submit" class="btn-admin btn-admin-pine">Update</button>
        </form>

        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Permanently delete this inquiry from records?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-admin btn-admin-danger">
            Delete Record
          </button>
        </form>
      </div>
    </div>

    <!-- Right Column: Sender Info & Internal Notes -->
    <div>
      <div class="card">
        <h3 class="card-title" style="margin-bottom:16px;">Contact Information</h3>
        
        <div class="meta-row">
          <span class="meta-k">Name</span>
          <span class="meta-v">{{ $message->name }}</span>
        </div>

        <div class="meta-row">
          <span class="meta-k">Company</span>
          <span class="meta-v">{{ $message->company ?: 'Not specified' }}</span>
        </div>

        <div class="meta-row">
          <span class="meta-k">Email</span>
          <span class="meta-v">
            <a href="mailto:{{ $message->email }}" style="color:var(--brass);">{{ $message->email }}</a>
          </span>
        </div>

        <div class="meta-row">
          <span class="meta-k">Interest</span>
          <span class="meta-v">{{ $message->interest }}</span>
        </div>

        <div class="meta-row">
          <span class="meta-k">Received</span>
          <span class="meta-v" style="font-family:'IBM Plex Mono', monospace; font-size:0.8rem;">
            {{ $message->created_at->format('Y-m-d H:i') }}
          </span>
        </div>
      </div>

      <!-- Internal Admin Notes Card -->
      <div class="card">
        <h3 class="card-title" style="margin-bottom:12px;">Estate Internal Notes</h3>
        <p style="font-size:0.8rem; color:var(--clay); margin-top:0;">Private notes visible only to Motra administrators.</p>

        <form action="{{ route('admin.messages.note', $message) }}" method="POST">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <textarea name="notes" class="form-control" placeholder="Add follow-up notes, wholesale quotes sent, shipment status..." rows="5">{{ old('notes', $message->notes) }}</textarea>
          </div>
          <button type="submit" class="btn-admin btn-admin-pine" style="width:100%;">Save Notes</button>
        </form>
      </div>
    </div>
  </div>
@endsection

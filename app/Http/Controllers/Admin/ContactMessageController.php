<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages with filters & search.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by interest
        if ($request->filled('interest')) {
            $query->where('interest', $request->interest);
        }

        // Search in name, company, email, message
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(15)->withQueryString();

        // Available interest types for filter dropdown
        $interestTypes = [
            'Wholesale / bulk pricing',
            'Retail order',
            'Export & distribution',
            'Farm visit',
            'Other',
        ];

        return view('admin.messages.index', compact('messages', 'interestTypes'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $message)
    {
        // Auto mark as read if it was unread
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Update message status (unread, read, replied, archived).
     */
    public function updateStatus(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
        ]);

        $message->update(['status' => $validated['status']]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $message->status,
                'message' => 'Status updated successfully.',
            ]);
        }

        return back()->with('success', 'Status updated successfully.');
    }

    /**
     * Update internal note for message.
     */
    public function updateNote(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string|max:3000',
        ]);

        $message->update(['notes' => $validated['notes']]);

        return back()->with('success', 'Estate notes saved successfully.');
    }

    /**
     * Remove the specified message.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Contact message removed from records.');
    }

    /**
     * Export contacts as CSV file.
     */
    public function export(Request $request)
    {
        $filename = 'motra-contacts-' . date('Y-m-d-His') . '.csv';

        $query = ContactMessage::query();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('interest')) {
            $query->where('interest', $request->interest);
        }

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($query) {
            $file = fopen('php://output', 'w');
            // Write BOM for UTF-8 Excel compatibility
            fputs($file, "\xEF\xBB\xBF");

            // Header row
            fputcsv($file, [
                'ID',
                'Name',
                'Company',
                'Email',
                'Enquiry Type',
                'Message',
                'Status',
                'Internal Notes',
                'Submitted Date',
            ]);

            $query->chunk(100, function ($rows) use ($file) {
                foreach ($rows as $row) {
                    fputcsv($file, [
                        $row->id,
                        $row->name,
                        $row->company ?? '',
                        $row->email,
                        $row->interest,
                        $row->message,
                        $row->status,
                        $row->notes ?? '',
                        $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : '',
                    ]);
                }
            });

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with overview statistics and latest inquiries.
     */
    public function index()
    {
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('status', 'unread')->count();
        $repliedMessages = ContactMessage::where('status', 'replied')->count();
        $todayMessages = ContactMessage::whereDate('created_at', today())->count();

        // Enquiries breakdown by interest
        $interestStats = ContactMessage::select('interest', \DB::raw('count(*) as total'))
            ->groupBy('interest')
            ->pluck('total', 'interest')
            ->toArray();

        // Recent 5 messages
        $recentMessages = ContactMessage::latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalMessages',
            'unreadMessages',
            'repliedMessages',
            'todayMessages',
            'interestStats',
            'recentMessages'
        ));
    }
}

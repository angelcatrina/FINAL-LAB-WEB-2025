<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ModerationController extends Controller
{
    public function queue()
    {
        $reports = Report::with(['reporter','artwork','comment'])
            ->latest()
            ->get();

        return view('admin.moderation.queue', compact('reports'));
    }

    public function dismiss(Report $report)
    {
        $report->delete();
        return back()->with('success', 'Report dismissed.');
    }

    public function takeDown(Report $report)
    {
        if ($report->reported_type === 'artwork' && $report->artwork) {
            $report->artwork->delete();
        }

        if ($report->reported_type === 'comment' && $report->comment) {
            $report->comment->delete();
        }

        $report->delete();

        return back()->with('success', 'Content taken down.');
    }

    public function detail(Report $report)
{
    
    $report->load('reporter', 'artwork', 'comment');

    return view('admin.moderation.detail', compact('report'));
}


}

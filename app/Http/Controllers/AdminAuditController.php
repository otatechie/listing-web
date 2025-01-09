<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Jenssegers\Agent\Agent;
use OwenIt\Auditing\Models\Audit;

class AdminAuditController extends Controller
{
    public function index()
    {
        $audits = Audit::with('user')
            ->get()
            ->map(function ($audit) {

                $agent = new Agent();

                $agent->setUserAgent($audit->user_agent);

                return [
                    'event' => $audit->event,
                    'auditable_type' => $audit->auditable_type,
                    'name' => $audit->user?->name,
                    'email' => $audit->user?->email,
                    'url' => $audit->url,
                    'browser' => $agent->browser() . ', ' . $agent->platform(),
                    'created_at' => $audit->created_at->diffForHumans()
                ];
            });

        return Inertia::render('Admin/IndexAuditPage', [
            'audits' => $audits
        ]);
    }
}

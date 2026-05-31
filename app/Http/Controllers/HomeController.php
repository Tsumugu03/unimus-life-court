<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Quick fallback: if Blade view service isn't available, return simple HTML
        if (! app()->bound('view')) {
            return new \Symfony\Component\HttpFoundation\Response(
                '<!doctype html><html><head><meta charset="utf-8"><title>Unimus Life</title></head><body><h1>Unimus Life & Culinary Hub</h1><p>Website berjalan — tampilan Blade belum tersedia.</p></body></html>',
                200,
                ['Content-Type' => 'text/html']
            );
        }
        $query = CatalogItem::query();

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        match ($request->price ?? 'all') {
            'low'  => $query->where('price', '<', 25000),
            'mid'  => $query->whereBetween('price', [25000, 500000]),
            'high' => $query->where('price', '>', 500000),
            default => null,
        };

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%$q%")
                   ->orWhere('short_desc', 'like', "%$q%")
                   ->orWhere('address', 'like', "%$q%");
            });
        }

        $items = $query->latest()->get();

        $data = [
            'items'           => $items,
            'activeCategory'  => $request->category ?? 'All',
            'activePrice'     => $request->price ?? 'all',
            'q'               => $request->q ?? '',
        ];

        // Try to render the Blade view; if it's empty, return a safe HTML fallback
        try {
            if (app()->bound('view')) {
                $rendered = view('home.index', $data)->render();
                if (is_string($rendered) && trim($rendered) !== '') {
                    return new \Symfony\Component\HttpFoundation\Response($rendered, 200, ['Content-Type' => 'text/html']);
                }
            }
        } catch (\Throwable $e) {
            @file_put_contents(base_path('storage/framework/debug_home_render_error.txt'), $e->getMessage() . "\n", FILE_APPEND);
        }

        // Fallback HTML (simple but functional)
        $html = '<!doctype html><html><head><meta charset="utf-8"><title>Unimus Life</title></head><body>';
        $html .= '<h1>Unimus Life & Culinary Hub</h1>';
        $html .= '<p>Daftar item:</p><ul>';
        foreach ($items as $it) {
            $html .= '<li>' . htmlspecialchars($it->name) . ' — ' . htmlspecialchars($it->short_desc) . '</li>';
        }
        $html .= '</ul></body></html>';
        return new \Symfony\Component\HttpFoundation\Response($html, 200, ['Content-Type' => 'text/html']);
    }

    public function show(CatalogItem $catalogItem)
    {
        return view('home.detail', ['item' => $catalogItem]);
    }
}
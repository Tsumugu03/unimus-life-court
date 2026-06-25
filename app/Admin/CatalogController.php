<?php

namespace App\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    // Dashboard: list semua item
    public function index()
    {
        $items = CatalogItem::latest()->get();
        return view('admin.dashboard', compact('items'));
    }

    // Form tambah baru
    public function create()
    {
        return view('admin.form', ['item' => null]);
    }

    // Simpan item baru ke database
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['image'] = $this->handleUpload($request);

        CatalogItem::create($data);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Item berhasil ditambahkan!');
    }

    // Form edit
    public function edit(CatalogItem $item)
    {
        return view('admin.form', compact('item'));
    }

    // Update item di database
    public function update(Request $request, CatalogItem $item)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($item->image) {
                @unlink(public_path('uploads/' . $item->image));
            }
            $data['image'] = $this->handleUpload($request);
        }

        $item->update($data);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Item berhasil diperbarui!');
    }

    // Hapus item
    public function destroy(CatalogItem $item)
    {
        if ($item->image) {
            @unlink(public_path('uploads/' . $item->image));
        }
        $item->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Item berhasil dihapus.');
    }

    // ── Helper: validasi input form ────────────────
    private function validateData(Request $request): array
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:200',
            'category'    => 'required|in:Culinary,Kost,BRT',
            'price'       => 'required|integer|min:0',
            'price_label' => 'nullable|string|max:50',
            'short_desc'  => 'required|string|max:255',
            'description' => 'required|string',
            'hours'       => 'required|string|max:100',
            'contact'     => 'nullable|string|max:100',
            'address'     => 'required|string|max:255',
            'lat'         => 'required|numeric',
            'lng'         => 'required|numeric',
            'instagram'   => 'nullable|string|max:100',
            'tiktok'      => 'nullable|string|max:100',
            'route_code'  => 'nullable|string|max:10',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Facilities: dari input textarea (1 baris = 1 fasilitas) → array → JSON
        $validated['facilities'] = array_filter(
            array_map('trim', explode("\n", $request->input('facilities_text', '')))
        );

        // Stops BRT: sama, 1 baris = 1 halte
        $validated['stops'] = $request->category === 'BRT'
            ? array_filter(array_map('trim', explode("\n", $request->input('stops_text', ''))))
            : null;

        // Jika kontak tidak diisi, simpan sebagai string kosong untuk menghindari NOT NULL error pada database lama
        $validated['contact'] = $validated['contact'] ?? '';

        return $validated;
    }

    // ── Helper: simpan foto upload ──────────────────
    private function handleUpload(Request $request): ?string
    {
        if (!$request->hasFile('image')) return null;

        $file     = $request->file('image');
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                  . '.' . $file->getClientOriginalExtension();

        // Simpan ke /public/uploads/
        $file->move(public_path('uploads'), $filename);

        return $filename;
    }
}
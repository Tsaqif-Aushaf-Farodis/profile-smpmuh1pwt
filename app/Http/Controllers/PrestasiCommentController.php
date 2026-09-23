<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\PrestasiComment;
use Illuminate\Http\Request;

class PrestasiCommentController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $prestasi = Prestasi::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:2000'],
            'website' => ['prohibited'],
        ]);

        PrestasiComment::create([
            'prestasi_id' => $prestasi->id,
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('prestasi', ['slug' => $slug])
            ->with('comment_status', 'Komentar Anda telah dikirim dan menunggu persetujuan admin.')
            ->withFragment('komentar');
    }
}

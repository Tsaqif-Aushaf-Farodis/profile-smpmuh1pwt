<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Stephenjude\FilamentBlog\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $article = Post::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:2000'],
            'website' => ['prohibited'],
        ]);

        Comment::create([
            'post_id' => $article->id,
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('article', ['slug' => $slug])
            ->with('comment_status', 'Komentar Anda telah dikirim dan menunggu persetujuan admin.')
            ->withFragment('komentar');
    }
}

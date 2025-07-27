<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vulnerability;
use Illuminate\Support\Facades\Auth; // Bu satırın olduğundan emin olun

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Vulnerability $vulnerability)
    {


        $request->validate([
            'body' => 'required|string|min:3',
        ]);

        $vulnerability->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->input('body'),
        ]);

        return redirect()->route('vulnerabilities.show', $vulnerability)
                         ->with('success', 'Yorum başarıyla eklendi!');
    }
}

<?php

namespace App\Http\Controllers\Article;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ArticleCommentController extends Controller
{
    public function store(string $id, string $slug, Request $request): JsonResponse
    {
        $data = $request->validate([
            'content' => 'required|string|min:5'
        ]);

        if (!$activeArticle = Article::fromIdAndSlug($id, $slug)->first()) {
            return $this->jsonResponse(['message' => 'Article not found'], 404);
        }

        $user = \Auth::user();

        if($user->recentlyCommentedOnArticle()) {
            return $this->jsonResponse(['message' => 'You are commenting too fast'], 422);
        }

        $comment = $activeArticle->comments()->create([
            'content' => nl2br(strip_tags($data['content'])),
            'user_id' => $user->id
        ]);

        return $this->jsonResponse([
            'comment' => $comment,
            'message' => 'Comment created successfully'
        ]);
    }
}
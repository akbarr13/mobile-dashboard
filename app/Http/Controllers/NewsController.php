<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('author') // Eager load the author relationship
            ->select(['id', 'title', 'content', 'author_id', 'image_url', 'published_date', 'category', 'status', 'created_at', 'updated_at'])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'content' => $item->content,
                    'author' => $item->author->name ?? 'Unknown', // Retrieve author name
                    'image_url' => $item->image_url ? url('storage/' . $item->image_url) : null, // Convert image URL to public path
                    'published_date' => $item->published_date ? $item->published_date->format('F j, Y, g:i a') : 'None',
                    'category' => $item->category ?? 'None',
                    'status' => ucfirst($item->status), // Capitalize first letter of status
                    'created_at' => $item->created_at->format('F j, Y, g:i a'),
                    'updated_at' => $item->updated_at->format('F j, Y, g:i a'),
                ];
            });

        return response()->json([
            'data' => $news,
            'message' => 'News fetched successfully',
            'status' => true,
        ], 200);
    }

    public function show($id)
    {
        // Retrieve a single news article by ID
        $news = News::with('author')->find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        // Return the news article as a resource
        return response()->json([
            'data' => $news,
            'message' => 'News fetched successfully',
            'status' => true,
        ], 200);
    }
}

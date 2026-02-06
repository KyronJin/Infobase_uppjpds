<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display gallery photos
     */
    public function index(Request $request): View
    {
        $category = $request->query('category');
        
        $query = GalleryPhoto::active()->orderBy('order');

        if ($category) {
            $query->byCategory($category);
        }

        $photos = $query->get();
        $categories = GalleryPhoto::distinct()->pluck('category');

        return view('gallery.index', compact('photos', 'categories', 'category'));
    }

    /**
     * Display photo details
     */
    public function show(GalleryPhoto $photo): View
    {
        return view('gallery.show', compact('photo'));
    }
}

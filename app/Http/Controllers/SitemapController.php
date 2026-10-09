<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic sitemap XML.
     */
    public function index(): Response
    {
        $articles = Article::latest()->get();
        $projects = Project::latest()->get();

        $xml = view('sitemap', [
            'articles' => $articles,
            'projects' => $projects,
        ])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600, s-maxage=86400',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Section;
use App\Models\Staff;
use App\Models\Program;
use App\Models\Prestasi;
use App\Models\PrestasiComment;
use App\Models\Galeri;
use Beier\FilamentPages\Models\FilamentPage;
use Stephenjude\FilamentBlog\Models\Post;
use Stephenjude\FilamentBlog\Models\Category;
use Spatie\Tags\Tag;

use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index()
    {
        $sections = Section::where('active', 1)->orderBy('ordering')->orderBy('id')->get();
        //cek Section Hero
        $cekHeroSection = Section::where('type', 'hero_template')->where('active', 1)->first();
        //list section selain Hero
        $listSection =  Section::where('type', '<>', 'hero_template')
                        ->where('active', 1)
                        ->orderBy('ordering')
                        ->orderBy('id')
                        ->get();
    
        $news = []; // Initialize $news variable
        $hero = null; // Initialize $hero variable
    
        foreach ($sections as $section) {
            $type = $section['type'];
            $content = $section['data']['content'];
    
            if ($type === 'news_template') {
                $news = $content['news'];
            } elseif ($type === 'hero_template') {
                $hero = $content['hero'];
            }
        }
        
        $banner = $news[0]['banner'];
    
        $blog = Post::orderBy('published_at', 'desc')->take(2)->get();

        $staff = Staff::orderBy('id', 'asc')->get();

        $unggulan = Program::orderBy('id', 'asc')->get();

        $juara = Prestasi::orderBy('created_at', 'desc')->get();

        $galeri = Galeri::orderBy('id', 'desc')->take(6)->get();

    
        return view('home', compact('blog', 'sections', 'cekHeroSection', 'listSection', 'hero', 'staff', 'banner', 'unggulan', 'juara', 'galeri'));
    }
    
        public function createStorageLink()
    {
        // Create symbolic link from storage/app/public to public/storage
        File::link(
            storage_path('app/public'), 
            public_path('storage')
        );
        
        return "Symbolic link created successfully.";
    }
    
    
    
    public function page($slug)
        {   
            $page = FilamentPage::where('slug', $slug)->first();
            //buatcontact
            $program = Program::orderBy('id', 'asc')->get();
            $prestasi = Prestasi::orderBy('id', 'desc')->get();
            $staff = Staff::orderBy('id', 'asc')->get();
            $galeri = Galeri::orderBy('id', 'desc')->get();
            $berita = Post::orderBy('published_at', 'desc')->get();

                if ($page) {
                    return view('page', compact('page', 'program', 'prestasi', 'staff', 'galeri', 'berita'));
                } else {
                    abort(404); // Page not found
                }
           
        }

  
    public function article($slug)
        {
            $article = Post::where('slug', $slug)->first();
            $categories = Category::withCount('posts')->get();
            $comments = Comment::approved()->where('post_id', $article->id)->latest()->get();

            return view('article', compact('article', 'categories', 'comments'));
        }

    
    public function program($slug)
        {
          
            $detail = Program::where('slug', $slug)->firstOrFail();
        
    
            return view('programDetail', compact('detail'));
        }
  
    public function prestasi($slug)
        {

            $detail = Prestasi::where('slug', $slug)->firstOrFail();
            $comments = PrestasiComment::approved()->where('prestasi_id', $detail->id)->latest()->get();

            return view('prestasiDetail', compact('detail', 'comments'));
        }
  
   
}

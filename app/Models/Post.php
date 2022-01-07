<?php

	namespace App\Models;
    use Illuminate\Support\Facades\File;
    use Spatie\YamlFrontMatter;
    class Post {
        public $title;
        public  $excerpt;
        public $date;
        public $body;
        public $slug;

        public function __construct($title,$excerpt,$date,$body,$slug) {
            $this->title =$title;
            $this->excerpt = $excerpt;
            $this->date = $date;
            $this->body =$body;
            $this->slug =$slug;
        }

        /**
         * @throws \Exception
         */
        public static function find($slug){
           $posts =static::all();
           return $posts->firstWhere('slug',$slug);
        }
        public static function all(){
            return cache()->rememberForever('posts.all',function (){
                return collect(File::files(resource_path('posts')))
                    ->map(function ($file){
                        return YamlFrontMatter\YamlFrontMatter::parseFile($file);
                    })
                    ->map(function ($document){
                        return new Post($document->matter('title'),$document->matter('exceprt'),$document->matter('date'),$document->body(),$document->slug);
                    })->sortByDesc('date');
            });
        }
	}

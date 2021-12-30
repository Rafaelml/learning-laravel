<?php

	namespace App\Models;
    use Illuminate\Support\Facades\File;
    class Post {
        /**
         * @throws \Exception
         */
        public static function find($slug){
            if(!file_exists($path =resource_path("posts/{$slug}.html"))){
                var_dump($path);
                ddd('file no exist');
            }
            return cache()->remember("posts.{$slug}",1200, function () use ( $path ) {
                return file_get_contents( $path );
            } );
        }
        public static function all(){
            $files= File::allFiles(resource_path("posts/"));
            return array_map(function ($file){
                return $file->getContents();
            },$files);
        }
	}

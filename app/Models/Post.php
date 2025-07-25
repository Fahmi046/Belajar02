<?php   

namespace App\Models;

use Illuminate\Support\Arr;

class Post

{
    public static function all()
    {
        return [
         [
            'id' => 1,
            'title' => 'Judul Artikel 1',
            'slug' => 'judul-artikel-1',
            'author' => 'Fahmi',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, temporibus. Autem, sunt obcaecati. Culpa minima labore ipsum vitae ab expedita. Necessitatibus pariatur cupiditate ad labore quibusdam perferendis doloribus facere officiis!'
        ],
        [
            'id' => 2,
            'title' => 'Judul Artikel 2',
            'slug' => 'judul-artikel-2',
            'author' => 'Fahmi',
            'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequatur alias recusandae dolorum illum voluptatibus cum blanditiis deleniti qui repellendus, unde odit ullam totam. Eius reiciendis animi deserunt voluptatibus illum ipsum.'
        ]
        ];
    }

    public static function find($slug): array
    {
        $post = Arr::first(static::all(), fn ($post) => $post['slug'] == $slug);

        if (!$post) {
            abort(404);
        }
        return $post;
    }
     
}

?>
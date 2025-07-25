<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});
Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});
Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog', 'posts' => [
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
    ]]);
});

Route::get('/posts/{slug}', function ($slug) {
    $posts = [
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
    $post = Arr::first($posts, function($post) use ($slug){
        return $post['slug'] == $slug;
    }); 

    return view('post',['title' => 'Single Post', 'post' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

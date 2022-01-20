@extends('layouts.front')

@section('title', 'Home')

@section('content')
    <div id="hero" class="mx-3 mx-sm-1 mt-4">
        <div class="d-flex">
            <x-hero-el :article="$heroArticles->count() >= 1 ? $heroArticles[0] : $blankArticle" id="hero-el-1" class="relative hero-w-lg-75 d-flex flex-sm-column py-2 py-sm-0 mb-sm-1 hero-el"/>
            <x-hero-el :article="$heroArticles->count() >= 2 ? $heroArticles[1] : $blankArticle" id="hero-el-2" class="hero-w-lg-25-1 d-none d-lg-block d-flex flex-column ms-lg-1 hero-el"/>
        </div>
        <div class="d-flex flex-column flex-md-row mb-md-1">
            <div class="d-flex flex-column flex-sm-row mb-sm-1 mb-md-0">
                <x-hero-el :article="$heroArticles->count() >= 2 ? $heroArticles[1] : $blankArticle" id="hero-el-2" class="hero-w-sm-50 hero-w-md-33 d-lg-none d-flex flex-sm-column py-2 py-sm-0 hero-el"/>
                <x-hero-el :article="$heroArticles->count() >= 3 ? $heroArticles[2] : $blankArticle" id="hero-el-3" class="hero-w-sm-50 hero-w-md-33 hero-w-lg-25-2 d-flex flex-sm-column ms-sm-1 m-lg-0 py-2 py-sm-0 hero-el"/>
            </div>
            <x-hero-el :article="$heroArticles->count() >= 4 ? $heroArticles[3] : $blankArticle" id="hero-el-4" class="relative hero-w-md-33 hero-w-lg-50 d-flex flex-sm-column py-2 py-sm-0 ms-md-1 mb-sm-1 mb-md-0 hero-el"/>
            <x-hero-el :article="$heroArticles->count() >= 5 ? $heroArticles[4] : $blankArticle" id="hero-el-5" class="relative hero-w-lg-25-2 d-none d-lg-block d-flex flex-column ms-lg-1 hero-el"/>
        </div>
        <x-hero-el :article="$heroArticles->count() >= 5 ? $heroArticles[4] : $blankArticle" id="hero-el-5" class="relative flex-md-grow-1 d-none d-md-block d-lg-none d-flex flex-column hero-el mb-1"/>
        <div class="d-flex flex-column flex-sm-row d-md-none">
            <x-hero-el :article="$heroArticles->count() >= 5 ? $heroArticles[4] : $blankArticle" id="hero-el-5" class="relative hero-w-sm-50 d-flex flex-sm-column py-2 py-sm-0 hero-el"/>
            <x-hero-el :article="$heroArticles->count() >= 6 ? $heroArticles[5] : $blankArticle" id="hero-el-6" class="relative hero-w-sm-50 d-flex flex-sm-column ms-sm-1 py-2 py-sm-0 hero-el"/>
        </div>
        <div class="d-flex flex-column flex-sm-row">
            <x-hero-el :article="$heroArticles->count() >= 6 ? $heroArticles[5] : $blankArticle" id="hero-el-6" class="relative hero-w-md-33 hero-w-lg-50 d-none d-md-block d-flex flex-sm-column hero-el"/>
            <x-hero-el :article="$heroArticles->count() >= 7 ? $heroArticles[6] : $blankArticle" id="hero-el-7" class="hero-w-sm-50 hero-w-md-33 hero-w-lg-25-2 d-flex flex-sm-column ms-md-1 py-2 py-sm-0 hero-el"/>
            <x-hero-el :article="$heroArticles->count() >= 8 ? $heroArticles[7] : $blankArticle" id="hero-el-8" class="hero-w-sm-50 hero-w-md-33 hero-w-lg-25-2 d-flex flex-sm-column ms-sm-1 py-2 py-sm-0 hero-el"/>
        </div>
    </div>
    <div id="feed" class="mx-sm-3 mt-5 d-flex">
        <div id="feed-river">
            <div>
                <h2 id="feed-river-title" class="ms-3">Derniers articles</h2>
            </div>
            <div id="feed-elements">
                @foreach ($articles as $article)
                    <div class="feed-el py-2 d-flex">
                        <div class="feed-el-image">
                            <a href="{{ route('article.show', ['article' => $article]) }}">
                                <img class="img-fluid" src="{{ $article->image->url }}">
                            </a>
                        </div>
                        <div class="feed-el-body mx-2">
                            <h2 class="feed-el-title">
                                <a href="{{ route('article.show', ['article' => $article]) }}">{{ $article->title }}</a>
                            </h2>
                            <div class="feed-el-byline">Par <a class="feed-el-author" href="{{ route('author.show', ['author' => $article->author]) }}">{{ $article->author->name }}</a> | {{ $article->postedAtDifference() }} | {{ $article->comments()->approved()->count() }} commentaires</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="feed-side" class="d-none d-lg-block"></div>
    </div>
@endsection
@extends('layouts.front')

@section('title', 'Home')

@section('content')
    <div id="hero" class="mx-3 mx-sm-1 mt-4">
        <div class="d-flex">
            <div id="hero-el-1" class="relative hero-w-lg-75 d-flex flex-sm-column py-2 py-sm-0 mb-sm-1 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[0]]) }}">
                        <img class="img-fluid" src="https://cdn.vox-cdn.com/thumbor/UWyR71QpQWCRN38z0E1O1LjyBCs=/0x0:4096x1716/2320x1305/filters:focal(1668x225:2322x879):format(webp)/cdn.vox-cdn.com/uploads/chorus_image/image/70379510/spider_man_into_the_spider_verse_dom_SpiderVerse_trlb795.1015_DH_v2.0.jpg">
                    </a>
                </div>
                <div class="hero-el-body">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[0]->category]) }}">{{ $heroArticles[0]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[0]]) }}">{{ $heroArticles[0]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[0]->author]) }}">{{ $heroArticles[0]->author->name }}</a></span>
                    </div>
                </div>
            </div>
            <div id="hero-el-2" class="hero-w-lg-25-1 d-none d-lg-block d-flex flex-column ms-lg-1 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[1]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[1]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[1]->category]) }}">{{ $heroArticles[1]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[1]]) }}">{{ $heroArticles[1]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[1]->author]) }}">{{ $heroArticles[1]->author->name }}</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row mb-md-1">
            <div class="d-flex flex-column flex-sm-row mb-sm-1 mb-md-0">
                <div id="hero-el-2" class=" hero-w-sm-50 hero-w-md-33 d-lg-none d-flex flex-sm-column py-2 py-sm-0 hero-el">
                    <div class="hero-el-image-wrapper">
                        <a href="{{ route('article.show', ['article' => $heroArticles[1]]) }}">
                            <img class="img-fluid" src="{{ $heroArticles[1]->image->url }}">
                        </a>
                    </div>
                    <div class="hero-el-body relative">
                        <div class="hero-el-category">
                            <a href="{{ route('category.show', ['category' => $heroArticles[1]->category]) }}">{{ $heroArticles[1]->category->name }}</a>
                        </div>
                        <div>
                            <h2 class="hero-el-title">
                                <a href="{{ route('article.show', ['article' => $heroArticles[1]]) }}">{{ $heroArticles[1]->title }}</a>
                            </h2>
                        </div>
                        <div class="hero-el-byline">
                            <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[1]->author]) }}">{{ $heroArticles[1]->author->name }}</a></span>
                        </div>
                    </div>
                </div>
                <div id="hero-el-3" class="hero-w-sm-50 hero-w-md-33 hero-w-lg-25-2 d-flex flex-sm-column ms-sm-1 m-lg-0 py-2 py-sm-0 hero-el">
                    <div class="hero-el-image-wrapper">
                        <a href="{{ route('article.show', ['article' => $heroArticles[2]]) }}">
                            <img class="img-fluid" src="{{ $heroArticles[2]->image->url }}">
                        </a>
                    </div>
                    <div class="hero-el-body relative">
                        <div class="hero-el-category">
                            <a href="{{ route('category.show', ['category' => $heroArticles[2]->category]) }}">{{ $heroArticles[2]->category->name }}</a>
                        </div>
                        <div>
                            <h2 class="hero-el-title">
                                <a href="{{ route('article.show', ['article' => $heroArticles[2]]) }}">{{ $heroArticles[2]->title }}</a>
                            </h2>
                        </div>
                        <div class="hero-el-byline">
                            <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[2]->author]) }}">{{ $heroArticles[2]->author->name }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="hero-el-4" class="relative hero-w-md-33 hero-w-lg-50 d-flex flex-sm-column py-2 py-sm-0 ms-md-1 mb-sm-1 mb-md-0 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[3]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[3]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[3]->category]) }}">{{ $heroArticles[3]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[3]]) }}">{{ $heroArticles[3]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[3]->author]) }}">{{ $heroArticles[3]->author->name }}</a></span>
                    </div>
                </div>
            </div>
            <div id="hero-el-5" class="relative hero-w-lg-25-2 d-none d-lg-block d-flex flex-column ms-lg-1 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[4]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[4]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[4]->category]) }}">{{ $heroArticles[4]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[4]]) }}">{{ $heroArticles[4]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[4]->author]) }}">{{ $heroArticles[4]->author->name }}</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="hero-el-5" class="relative flex-md-grow-1 d-none d-md-block d-lg-none d-flex flex-column hero-el mb-1">
            <div class="hero-el-image-wrapper">
                <a href="{{ route('article.show', ['article' => $heroArticles[4]]) }}">
                    <img class="img-fluid" src="{{ $heroArticles[4]->image->url }}">
                </a>
            </div>
            <div class="hero-el-body">
                <div class="hero-el-category">
                    <a href="{{ route('category.show', ['category' => $heroArticles[4]->category]) }}">{{ $heroArticles[4]->category->name }}</a>
                </div>
                <div>
                    <h2 class="hero-el-title">
                        <a href="{{ route('article.show', ['article' => $heroArticles[4]]) }}">{{ $heroArticles[4]->title }}</a>
                    </h2>
                </div>
                <div class="hero-el-byline">
                    <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[4]->author]) }}">{{ $heroArticles[4]->author->name }}</a></span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row d-md-none">
            <div id="hero-el-5" class="relative hero-w-sm-50 d-flex flex-sm-column py-2 py-sm-0 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[4]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[4]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[4]->category]) }}">{{ $heroArticles[4]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[4]]) }}">{{ $heroArticles[4]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[4]->author]) }}">{{ $heroArticles[4]->author->name }}</a></span>
                    </div>
                </div>
            </div>
            <div id="hero-el-6" class="relative hero-w-sm-50 d-flex flex-sm-column ms-sm-1 py-2 py-sm-0 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[5]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[5]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[5]->category]) }}">{{ $heroArticles[5]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[5]]) }}">{{ $heroArticles[5]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[5]->author]) }}">{{ $heroArticles[5]->author->name }}</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row">
            <div id="hero-el-6" class="relative hero-w-md-33 hero-w-lg-50 d-none d-md-block d-flex flex-sm-column hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[5]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[5]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[5]->category]) }}">{{ $heroArticles[5]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[5]]) }}">{{ $heroArticles[5]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[5]->author]) }}">{{ $heroArticles[5]->author->name }}</a></span>
                    </div>
                </div>
            </div>
            <div id="hero-el-7" class="hero-w-sm-50 hero-w-md-33 hero-w-lg-25-2 d-flex flex-sm-column ms-md-1 py-2 py-sm-0 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[6]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[6]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[6]->category]) }}">{{ $heroArticles[6]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[6]]) }}">{{ $heroArticles[6]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[6]->author]) }}">{{ $heroArticles[6]->author->name }}</a></span>
                    </div>
                </div>
            </div>
            <div id="hero-el-8" class="hero-w-sm-50 hero-w-md-33 hero-w-lg-25-2 d-flex flex-sm-column ms-sm-1 py-2 py-sm-0 hero-el">
                <div class="hero-el-image-wrapper">
                    <a href="{{ route('article.show', ['article' => $heroArticles[7]]) }}">
                        <img class="img-fluid" src="{{ $heroArticles[7]->image->url }}">
                    </a>
                </div>
                <div class="hero-el-body relative">
                    <div class="hero-el-category">
                        <a href="{{ route('category.show', ['category' => $heroArticles[7]->category]) }}">{{ $heroArticles[7]->category->name }}</a>
                    </div>
                    <div>
                        <h2 class="hero-el-title">
                            <a href="{{ route('article.show', ['article' => $heroArticles[7]]) }}">{{ $heroArticles[7]->title }}</a>
                        </h2>
                    </div>
                    <div class="hero-el-byline">
                        <span>Par <a class="hero-el-author" href="{{ route('author.show', ['author' => $heroArticles[7]->author]) }}">{{ $heroArticles[7]->author->name }}</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="feed">feed</div>
@endsection
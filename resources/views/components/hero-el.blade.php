<div {{ $attributes }}>
    <div class="hero-el-image-wrapper">
        <a href="{{ is_null($article->id) ? '#' : route('article.show', ['article' => $article]) }}">
            <img class="img-fluid" src="{{ is_null($article->id) ? 'https://via.placeholder.com/1500x900' : $article->image->url }}">
        </a>
    </div>
    <div class="hero-el-body relative">
        <div class="hero-el-category">
            <a href="{{ is_null($article->id) ? '#' : route('category.show', ['category' => $article->category]) }}">
                {{ is_null($article->id) ? 'Lorem Ipsum' : $article->category->name }}
            </a>
        </div>
        <div>
            <h2 class="hero-el-title">
                <a href="{{ is_null($article->id) ? '#' : route('article.show', ['article' => $article]) }}">
                    {{ is_null($article->id) ? 'Lorem Ipsum' : $article->title }}
                </a>
            </h2>
        </div>
        <div class="hero-el-byline">
            <span>Par <a class="hero-el-author" href="{{ is_null($article->id) ? '#' : route('author.show', ['author' => $article->author]) }}">{{ is_null($article->id) ? 'Lorem Ipsum' : $article->author->name }}</a></span>
        </div>
    </div>
</div>
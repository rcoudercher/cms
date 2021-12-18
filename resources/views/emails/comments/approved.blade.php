<div>
  <p>Bonjour,</p>
  <p>votre commentaire :</p>
  <p>{{ $comment->content }}</p>
  <p>de l'article <a href="{{ route('article.show', [
    'year' => $comment->article->created_at->year, 
    'month' => $comment->article->created_at->month, 
    'day' => $comment->article->created_at->day, 
    'slug' => $comment->article->slug]) }}">{{ $comment->article->title }}</a> a été approuvé.</p>
  <p>Merci beaucoup pour votre participation sur le site.</p>
  <p>Amicalement,<br>Ocelot</p>
</div>
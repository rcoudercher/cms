@extends('layouts.front')

@section('title', 'edit comment')

@section('content')
  <h1 class="h2 mb-4">Modifier un commentaire</h1>
  <p class="mb-4">Un commentaire modifié sera de nouveau soumis à modération.</p>
  
  <form action="{{ route('comment.update', ['comment' => $comment]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="mb-3">
      <textarea name="content" @class([
        'form-control',
        'is-invalid' => $errors->has('content'),
        ]) rows="5" style="resize: none;">{{ old('content') ?? $comment->content }}</textarea>
        @error('content')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="button">Modifier le commentaire</button>
  </form>
  
@endsection

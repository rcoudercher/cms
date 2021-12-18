<div class="mt-5 clearfix">
  @if (!$collection->onFirstPage())
    <div class="float-start">
      <a class="button" href="{{ $collection->currentPage() == 2 ? $origin : $collection->previousPageUrl() }}">Page précédente</a>
    </div>
  @endif
  @if ($collection->hasMorePages())
    <div class="float-end">
      <a class="button" href="{{ $collection->nextPageUrl() }}">Page suivante</a>
    </div>
  @endif
</div>
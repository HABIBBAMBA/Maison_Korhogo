@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="immopro-pagination">
        {{-- Résumé textuel d'affichage en français --}}
        <div class="immopro-pagination-summary">
            Affichage de <span class="tabular-nums">{{ $paginator->firstItem() }}</span> à <span class="tabular-nums">{{ $paginator->lastItem() }}</span> sur <span class="tabular-nums">{{ $paginator->total() }}</span> résultats
        </div>

        {{-- Liens de pagination --}}
        <ul class="immopro-pagination-list" role="list">
            {{-- Bouton Précédent --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="Page précédente">
                    <span class="page-link" aria-hidden="true">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link" aria-label="Page précédente">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Éléments de pagination (numéros de page & séparateurs) --}}
            @foreach ($elements as $element)
                {{-- Séparateur "..." --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Liens vers les pages --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link tabular-nums">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}" class="page-link tabular-nums">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Bouton Suivant --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link" aria-label="Page suivante">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="Page suivante">
                    <span class="page-link" aria-hidden="true">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

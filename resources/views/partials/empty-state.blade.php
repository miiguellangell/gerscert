{{-- Fallback row shown inside a <tbody> when a listing/search has no results.
     Expects: colspan, message. Optional: icon (bootstrap-icons class), clearUrl. --}}
<tr>
    <td colspan="{{ $colspan }}" class="empty-state">
        <div class="empty-state-inner">
            <i class="bi {{ $icon ?? 'bi-inbox' }}" aria-hidden="true"></i>
            <p>{{ $message }}</p>
            @isset($clearUrl)
                <a href="{{ $clearUrl }}" class="btn btn-azul btn-sm">
                    <i class="bi bi-x-circle" aria-hidden="true"></i> <span>Limpiar búsqueda</span>
                </a>
            @endisset
        </div>
    </td>
</tr>

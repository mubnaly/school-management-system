<div>
    <form id="{{ $formId ?? 'logout-form' }}" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="javascript:void(0);"
        onclick="event.preventDefault(); document.getElementById('{{ $formId ?? 'logout-form' }}').submit();"
        class="{{ $class ?? 'btn btn-danger' }}" title="Log Out">
        @if ($slot->isEmpty())
            <i class="fa fa-sign-out"></i> Log Out
        @else
            {{ $slot }}
        @endif
    </a>
</div>

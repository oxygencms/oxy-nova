<!-- Language Switcher -->
<div class="nav dropdown">
    <a class="nav-link dropdown-toggle"
       id="navUserDropdown"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
       title="Change the language."
       href=""
    >
        <i class="fas fa-globe-americas"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navUserDropdown">
        @foreach(config('oxygen.locales') as $key => $value)
            <a href="/lang/{{ $key }}"
               class="dropdown-item {{ app()->isLocale($key) ? 'active' : null }}"
               title="{{ $value }}"
            >
                {{ $value }}
            </a>
        @endforeach
    </div>
</div>
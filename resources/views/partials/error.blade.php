@if (session('failure'))
    <div class="alert alert-failure show-notification-message">
        <ul>
            {{ session('failure') }}
        </ul>
    </div>
@endif
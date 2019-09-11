@if (session('status'))
    <div class="alert alert-success show-notification-message">
        <ul>
            {{ session('status') }}
        </ul>
    </div>
@endif
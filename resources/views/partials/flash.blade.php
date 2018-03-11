
@if(session()->has('message'))
    <div class="alert alert-info margin-top25 margin-bot25">{{ session('message') }}</div>
@endif
<!-- Start Session -->
<div class="sessions">
    @if (session()->has('status'))
    <div class="session bg-blue">
        <p>{{ session('status') }}.</p>
        <button class="exit"><i class="fas fa-times"></i></button>
    </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="session bg-red">
            <p>{{ $error }}.</p>
            <button class="exit"><i class="fas fa-times"></i></button>
        </div>
        @endforeach
    @endif
</div>
<!-- End Session -->

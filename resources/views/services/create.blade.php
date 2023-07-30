<x-layout>
    <x-slot:body_style>background-image: url({{ url('images', 'bg-1.jpg') }});</x-slot:body_style>

    <div class="form-box center">
        <div class="box">
            <h2>Service</h2>
            <form action="{{ route('services.create') }}" method="POST">
                @csrf

                <input class="field" placeholder="Name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error"> - {{ $message }}</div>
                @enderror

                <input class="field" placeholder="Price" type="nubmer" name="price" value="{{ old('price') }}" required>
                @error('price')
                    <div class="error"> - {{ $message }}</div>
                @enderror
                
                <input type="submit" value="Create">
            </form>
        </div>
    </div>           
</x-layout>

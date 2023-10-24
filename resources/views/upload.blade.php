<x-app-layout>
  <h2>Upload form</h2>
  <form method="post" enctype="multipart/form-data" action="{{ route('upload.store')}}">
    @csrf

    @if (session('message'))
        <div class="alert">{{ session('message') }}</div>
    @endif

    @if ($errors->any())
       <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="file" name="attachment" />
    <input type="submit" value="Upload" />
  </form>
</x-app-layout>

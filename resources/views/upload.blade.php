<x-app-layout>
  <h2>Upload form</h2>
  <form method="post" enctype="multipart/form-data" action="{{ route('upload.store')}}">
    @csrf
    <input type="file" name="avatar" />
    <input type="submit" value="Upload" />
  </form>
</x-app-layout>

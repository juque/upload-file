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
    <div>
      <progress value="0" max="100"></progress>
    </div>
  </form>

@push('scripts')

<script type="text/javascript">

  const form = document.forms[0];

  form.addEventListener('submit', (event) => {

    event.preventDefault();

    const { currentTarget } = event;

    const fileInput = currentTarget.attachment;
    if ( !fileInput.files.length ) {
      console.error('No file selected.');
      return;
    }

    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append('attachment', file);
    const xhr = new XMLHttpRequest();

    xhr.upload.addEventListener('progress', (event) => {
      if (event.lengthComputable) {
        const percent = (event.loaded / event.total) * 100;
        document.querySelector('progress').value = Math.round(percent);
      }
    });

    xhr.addEventListener('load', (event) => {
      const { currentTarget } = event;
      if (currentTarget.readyState === 4) {
        if (currentTarget.status === 200) {
          console.log('All OK');
        } else {
          console.error(`Error: ${currentTarget.status} - ${currentTarget.statusText}`);
        }
      }
    });

    xhr.addEventListener('error', () => {
      console.error('An error occurred during the upload.');
    });

    xhr.open('POST', '{{ route("upload.store") }}', true);
    xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
    xhr.send(formData);

  });


</script>

@endpush

</x-app-layout>

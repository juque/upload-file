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

  const onUploadProgress = event => {
    const percentCompleted = Math.round((event.loaded * 100) / event.total);
    document.querySelector('progress').value = Math.round(percentCompleted);
    console.log('onUploadProgress', percentCompleted);
  }

  const upload = async event => {

    event.preventDefault();

    const { currentTarget } = event;

    const formData = new FormData();

    for (const file of currentTarget.attachment.files) {

      formData.append('attachment', file);

    }

    try {

      const result = await axios.post( '{{ route("upload.store") }}', formData, { onUploadProgress });

      console.log('result is', result);

    }

    catch ( error ) {

      console.error( error );

    } 

    finally {
      console.log('Upload complete');
    } 
    
  }

  // const fileInput = document.querySelector("input[type=file]");
  const form = document.querySelector('form');
 
  form.addEventListener('submit', upload);


</script>

@endpush

</x-app-layout>

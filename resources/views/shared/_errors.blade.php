@if ($errors->any())
  <div class="validation-error-summary" role="alert">
    <p>请检查以下信息：</p>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

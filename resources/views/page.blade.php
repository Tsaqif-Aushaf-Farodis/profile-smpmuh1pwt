@php
    use Illuminate\Support\Str;
@endphp

@include('layout.header')


  @php  

      $template = $page['data']['templateName'];
      
  @endphp

  @include('page.' . Str::before($template, '_template'))



@include('layout.footer')
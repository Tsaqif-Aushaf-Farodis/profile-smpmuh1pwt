@php
    use Illuminate\Support\Str;
@endphp
  
@include('layout.header')

    @if ($cekHeroSection)
    @include('section.hero')
    @endif


    @foreach ($listSection as $section)

    @php  
    
        $counters = [];
        $news = [];      
        $program = [];
        $profile = [];
        $prestasi = [];
       

        $type = $section['type'];
        $content = $section['data']['content'];
        
            if ($type === 'counter_template') {
                $counters = $content['counter'];
            } elseif ($type === 'news_template') {
                $news = $content['news'];            
            } elseif ($type === 'program_template') {
                $program = $content['program'];
            } elseif ($type === 'prestasi_template') {
                $prestasi = $content['prestasi'];
            } elseif ($type === 'profile_template') {
                $profile = $content['profile'];
            }  
            
        
    @endphp

    @include('section.' . Str::before($section->type, '_template'))
        
 

@endforeach

@include('layout.footer')



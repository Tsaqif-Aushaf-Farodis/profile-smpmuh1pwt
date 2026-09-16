
  <header class="main-header">
    <nav class="main-menu">
        <div class="container">
            <div class="main-menu__logo">
                <a href="/">
                    <img src="{{ asset('assets/images/logo.png') }}" width="183" alt="SMPMuOne">
                </a>
            </div><!-- /.main-menu__logo -->
            <div class="main-menu__nav">
                <ul class="main-menu__list">    
                  @foreach($navigation->items as $item)    
                    @if($item['children'])                 
                      <li class="dropdown">
                          <a href="#">{{ $item['label'] }}</a>
                          <ul>
                            @foreach($item['children'] as $child)
                                <li>
                                    <a href="{{ $child['data']['url'] }}">
                                        @isset($child['data']['title'])
                                            {{$child['data']['title']}}
                                        @else
                                            {{ $child['label'] }}
                                        @endisset
                                    </a>
                                </li>
                            @endforeach
                          </ul>   
                      </li>
                      
                    @else         
                      <li><a href="{{ $item['data']['url'] }}">{{ $item['label'] }}</a></li>
                    @endif
                  @endforeach                      
                </ul>
            </div><!-- /.main-menu__nav -->
            
            <div class="main-menu__right">
                <a href="#" class="main-menu__toggler mobile-nav__toggler">
                    <i class="fa fa-bars"></i>
                </a><!-- /.mobile menu btn -->  
                <a href="https://www.facebook.com/smpmuh1pwt" target="_blank" class="soc-ico"><i class="fab fa-facebook"></i></a>                        
                <a href="https://www.instagram.com/smpmuhammadiyah1pwt" target="_blank" class="soc-ico"><i class="fab fa-instagram"></i></a>         
                <a href="https://www.tiktok.com/@smpmuonepwt" class="soc-ico" target="_blank"><i class="fab fa-tiktok"></i></a>
                <a href="https://wa.me/6285877535383" class="soc-ico" target="_blank"><i class="fab fa-whatsapp"></i></a>                                               
            </div><!-- /.main-menu__right -->
        </div><!-- /.container -->
    </nav>
    <!-- /.main-menu -->
</header><!-- /.main-header -->
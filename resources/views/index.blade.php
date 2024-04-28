<!doctype html>
<html class="no-js" lang="zxx">
    @include('includes.head')

   <body>
       
    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="/layout/assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->

    @include('includes.header')

    @include($main)
    
    @include('includes.footer')
   
	@include('includes.script')
        
    </body>
</html>
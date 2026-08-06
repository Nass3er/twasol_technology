{{-- <div class="owl-carousel  bg-gradient-to-r from-gray-900 to-emerald-900 p-3 "> --}}
{{-- <x-divider>{{ __('adminlte::landingpage.latestnews') }}</x-divider> --}}
<div class="carousel w-full h-screen overflow-hidden scroll-smooth scroll-mt-0 snap-y snap-mandatory">
    <div class="owl-carousel relative w-full">
        <div class="item cursor-grabbing">
            <img src="/images/slide1.png" alt="Slide 1"/>
        </div>
    </div>
</div>


<script>
    var owl = jQuery('.owl-carousel');
    owl.owlCarousel({
        loop: true,
        // margin: 20,
        autoplay: true,
        autoplayTimeout: 5000,
        // autoplayHoverPause: true,
        rtl: document.documentElement.getAttribute('dir') === 'rtl', // ← fixed comma here
        items:1,
        // responsive: {
        //     0: {
        //         items: 1, // 👈 mobile
        //     },
        //     768: {
        //         items: 2, // 👈 tablet
        //     },
        //     1024: {
        //         items: 3, // 👈 desktop
        //     },
        // },
    });

    // $('.play').on('click', function() {
    //     owl.trigger('play.owl.autoplay', [3000])
    // })
    // $('.stop').on('click', function() {
    //     owl.trigger('stop.owl.autoplay')
    // })
</script>

{{-- <div class="carousel w-full h-[80vh] overflow-hidden scroll-smooth scroll-mt-0 snap-y snap-mandatory">
    <div id="slide1" class="carousel-item relative w-full">
        <img src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp" class="w-full" />
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide4" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide4').classList.remove('hidden'); document.getElementById('slide1').classList.add('hidden');">❮</a>

            <a href="#slide2" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide2').classList.remove('hidden'); document.getElementById('slide1').classList.add('hidden');">❯</a>
        </div>
    </div>
    <div id="slide2" class="carousel-item relative w-full">
        <img src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp" class="w-full" />
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide1" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide1').classList.remove('hidden'); document.getElementById('slide2').classList.add('hidden');">❮</a>
            <a href="#slide3" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide3').classList.remove('hidden'); document.getElementById('slide2').classList.add('hidden');">❯</a>
        </div>
    </div>
    <div id="slide3" class="carousel-item relative w-full">
        <img src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp" class="w-full" />
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide2" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide2').classList.remove('hidden'); document.getElementById('slide3').classList.add('hidden');">❮</a>
            <a href="#slide4" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide4').classList.remove('hidden'); document.getElementById('slide3').classList.add('hidden');">❯</a>
        </div>
    </div>
    <div id="slide4" class="carousel-item relative w-full">
        <img src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp" class="w-full" />
        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
            <a href="#slide3" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide3').classList.remove('hidden'); document.getElementById('slide4').classList.add('hidden');">❮</a>
            <a href="#slide1" class="btn btn-circle"
                onclick="event.preventDefault(); document.getElementById('slide1').classList.remove('hidden'); document.getElementById('slide4').classList.add('hidden');">❯</a>
        </div>
    </div>
</div> --}}


{{-- <script>
        const slides = ['#slide1', '#slide2', '#slide3', '#slide4'];
        let current = 0;
        
        setInterval(() => {
          current = (current + 1) % slides.length;
          window.location.hash = slides[current];
          }, 3000); // 3 seconds
        </script> --}}

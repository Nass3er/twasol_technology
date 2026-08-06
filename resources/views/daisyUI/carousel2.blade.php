    <div class="owl-carousel  p-3 rounded-2">
    <div class="item transition-all duration-300 ease-in-out hover:scale-[0.95] hover:z-10 cursor-pointer text-center">
        <img src="/images/slide1.png" alt="Slide 1" class="rounded-xl shadow-md" />
        <p>okoko</p>
    </div>
    <div class="item transition-all duration-300 ease-in-out hover:scale-[0.95] hover:z-10 cursor-pointer items-center">
        <img src="/images/slide2.png" alt="Slide 2" class="rounded-xl shadow-md" />
        <p>d,f,f2</p>
    </div>
    <div class="item transition-all duration-300 ease-in-out hover:scale-[0.98] hover:z-10 justify-center">
        <img src="/images/slide1.png" alt="Slide 3" class="rounded-xl shadow-md" />
    <p>dsffffff</p>
    </div>
</div>


<script>
var owl = jQuery('.owl-carousel');
owl.owlCarousel({
    loop: true,
    margin: 20,
    autoplay: true,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
    rtl: document.documentElement.getAttribute('dir') === 'rtl', // ← fixed comma here
    responsive: {
        0: {
            items: 1, // 👈 mobile
        },
        768: {
            items: 2, // 👈 tablet
        },
        1024: {
            items: 3, // 👈 desktop
        },
    },
});

</script>

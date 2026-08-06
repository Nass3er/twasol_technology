<div class="hero h-100 lg:h-150 bg-center bg-cover" 
style="background-image: url(./images/news1.png);">
    {{-- <img 
class="mask-r-from-10% mask-l-from-10% w-full h-full object-cover" 
src="./images/news1.png" 
alt="Album" /> --}}

<div class="hero-overlay backdrop-blur-xs backdrop-hue-rotate-275 "></div>

<div class="hero-content text-neutral-content text-center">
  <div class="max-w-full px-4" data-aos="fade-right" data-aos-delay="300">
    <h1 class="mb-5 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
      {{ $details->heroTitle ?? 'sd' }}
    </h1>
    <p class="mb-5 text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed">
      {{-- {{ $details['description'] }} --}}
    </p>
  </div>
</div>
</div>

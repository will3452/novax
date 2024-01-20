<x-layout>
  <x-navbar></x-navbar>
  <x-hero></x-hero>
  <div class="p-2 mt-2 mx-auto md:w-11/12">
    <h1 class="sticky top-0 z-2 text-4xl font-custom hover:underline text-center bg-white p-4"> Attractions</h1>
    <div class="place-slider z-1 owl-carousel owl-theme flex mt-2 text-center flex-wrap ">
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
    </div>
    <h1 class="sticky top-0 z-1 text-4xl font-custom hover:underline text-center bg-white p-4 mt-4"> Blogs</h1>
    <div class="flex flex-wrap">
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-view-more></x-blog-view-more>
    </div>
    <h1 class="sticky top-0 z-1 text-4xl font-custom hover:underline text-center bg-white p-4 mt-4"> Feedback / Testimonials</h1>
    <div class="fb-slider owl-carousel owl-theme">
      <x-feedback-item></x-feedback-item>      
      <x-feedback-item></x-feedback-item>      
      <x-feedback-item></x-feedback-item>      
      <x-feedback-item></x-feedback-item>      
    </div>
    <h1 class="sticky top-0 z-1 text-4xl font-custom hover:underline text-center bg-white p-4 mt-8"> Contact Us</h1>
    <div class="flex">
      <x-contact-form></x-contact-form>
    </div>
  </div>
  
<script>
    $('.place-slider').owlCarousel({
    loop: true, 
    autoHeight:true,
    autoplay: true, 
    autoplayTimeout:3000, 
    autoplayHoverPause:true,
    responsive: {
      0: {
        nav: true, 
        items: 2, 
      },
      900: {
        nav:true, 
        items: 4, 
      }
    }
  })
  $('.fb-slider').owlCarousel({
    loop: true, 
    margin: 10, 
    // center: true, 
    autoHeight:true,
    autoplay: true, 
    autoplayTimeout:3000, 
    autoplayHoverPause:true,
    responsive: {
      0: {
        nav: false, 
        items: 1, 
      },
      900: {
        nav: true, 
        items: 3, 
      }
    }
  })
</script>
</x-layout>

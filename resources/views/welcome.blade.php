<x-layout>
  <x-navbar></x-navbar>
  <x-hero></x-hero>
  <div class="p-2 mt-2 mx-auto md:w-11/12">
    <h1 class="sticky top-0 z-2 text-4xl font-custom hover:underline text-center bg-white p-4"> Feature Attraction</h1>
    <x-place-details :attraction="\App\Models\Destination::with(['category', 'photographs'])->inRandomOrder()->first()"></x-place-details>
    <h1 class="sticky top-0 z-2 text-4xl font-custom hover:underline text-center bg-white p-4"> Attractions</h1>
    <div class="place-slider z-1 owl-carousel owl-theme flex mt-2 text-center flex-wrap ">
      @foreach (\App\Models\Destination::with(['photographs'])->inRandomOrder()->take(10)->get() as $item)         
        <x-place-item :photo="$item->photographs[0]->image" :name="$item->name" :id="$item->id"></x-place-item>
      @endforeach
    </div>
    <h1 class="sticky top-0 z-1 text-4xl font-custom hover:underline text-center bg-white p-4 mt-4"> Blogs</h1>
    <div class="flex flex-wrap">
      @foreach (\App\Models\Post::with('user')->latest()->take(5)->get() as $item)
        <x-blog-item :blog="$item"></x-blog-item>
      @endforeach
      <x-blog-view-more></x-blog-view-more>
    </div>
    <h1 class="sticky top-0 z-1 text-4xl font-custom hover:underline text-center bg-white p-4 mt-4"> Feedback / Testimonials</h1>
    <div class="fb-slider owl-carousel owl-theme">
      @foreach (\App\Models\Feedback::latest()->take(12)->get() as $item)
        <x-feedback-item :feedback="$item"></x-feedback-item>
      @endforeach          
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

<x-layout>
  <x-navbar></x-navbar>
  <x-hero></x-hero>
  <div class="p-2 mt-2 mx-auto md:w-11/12" x-data="{activeImage:'https://picsum.photos/seed/4/200/200', description: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. In ullam expedita voluptatem repellendus, placeat voluptatum et illum officia at omnis aspernatur asperiores quam illo atque dolores repudiandae reprehenderit ducimus impedit culpa temporibus! Dolorum dicta, reprehenderit assumenda inventore laudantium eius eum aliquam soluta veritatis commodi ad id cupiditate. Quas quasi laborum, rerum eum similique quaerat omnis eveniet corrupti alias pariatur doloremque voluptatem rem itaque odit natus. Id laudantium sint quo consectetur ipsa! Laborum similique, corrupti excepturi assumenda a, doloremque officiis vel quos placeat fugiat, at odit. Itaque laborum fugit maxime, facere libero totam quisquam optio vel fuga placeat nesciunt nam hic soluta? Adipisci rerum ipsum debitis ipsam ex eum commodi esse neque vel, blanditiis sunt consequuntur. Est, voluptates tempore. Voluptas, nobis quam libero qui cumque ad eaque eius architecto dolor saepe ratione reiciendis officiis fugiat repellendus at, ipsum suscipit. Possimus at commodi ipsa, quae impedit, optio nisi dolore facilis ipsum culpa earum alias ex! Perferendis, porro quos? Et perferendis explicabo, expedita unde, ad dolores eum eos nisi, magni molestias ipsam recusandae tenetur quos ipsa culpa fuga. Nostrum magnam eaque soluta accusantium tempore, iure necessitatibus repellat quis sunt ad nulla facilis voluptatem quae numquam error excepturi molestiae, odit facere fugit, suscipit corporis?', viewAll: false, }">
    <h1 class="sticky top-0 z-2 text-4xl font-custom hover:underline text-center bg-white p-4"> Feature Attraction</h1>
    <x-place-details></x-place-details>
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

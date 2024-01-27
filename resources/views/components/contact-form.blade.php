
<form action="/inquiry" method="post" class="w-full md:w-1/2 p-8" data-aos="fade-right">
  @csrf 
    <div class="text-2xl font-custom tracking-widest">
      Full Name
    </div>
    <input required name="name" class="p-2 border-b-2 block w-full mb-4" type="text">
    <div class="text-2xl font-custom tracking-widest">
      Email
    </div>
    <input required name="email" class="p-2 border-b-2 block w-full mb-4" type="email">
    <div class="text-2xl font-custom tracking-widest">
      Message
    </div>
    <textarea name="message" required id="" class="block border-b-2 w-full"></textarea>
    <div class="text-2xl font-custom tracking-widest mt-4">
      <button class="bg-green-700 text-white rounded-md p-4" type="submit">Leave Message</button>
    </div>
  </form>
  <div class="items-center  justify-center w-1/3 hidden md:flex">
    <img src="/map.jpg" class="w-full" alt="">
  </div>
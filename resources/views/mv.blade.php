<x-layout>
    <x-navbar></x-navbar>
    
    <div class="text-center">
      <h1 class="text-4xl font-bold uppercase font-custom">Mission</h1>
      {!!nova_get_setting('Mission')!!}
      <h1 class="text-4xl font-bold uppercase font-custom mt-4">Vision</h1>
      {!!nova_get_setting('Vision')!!}
    </div>
  </x-layout>
<div class="text-center flex items-center justify-center h-32 md:h-80"style=" background:url('/bg.jpg'); background-size:cover;background-attachment: fixed; background-position:center;">
  <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
    <div class="w-full md:w-2/3 p-2">
      <h1 class="text-3xl md:text-6xl font-mono font-custom mb-2">
        Find the best place to rest
      </h1>
      <form action="/search" class="w-full flex items-center mt-4 justify-center">
        <input id="search" type="text" name="keyword"  value="{{request()->keyword}}" class="p-2 md:p-6  rounded-l-md w-4/5" placeholder=""> <button class="p-2 md:p-6  rounded-r-md bg-green-700 text-white hover:bg-green-900 w-1/5">SEARCH</button>
      </form>
    </div>
  </div>

  <script>
    var input = document.getElementById('search');

    var customNodeCreator = function(character) {
      // Add character to input placeholder
      input.placeholder = input.placeholder + character;

      // Return null to skip internal adding of dom node
      return null;
    }

    var onRemoveNode = function({ character }) {
      if(input.placeholder) {
        // Remove last character from input placeholder
        input.placeholder = input.placeholder.slice(0, -1)
      }
    }

    var typewriter = new Typewriter(null, {
      loop: true,
      strings: @json(\App\Models\Destination::inRandomOrder()->take(5)->get()->pluck('name') ), 
      onCreateTextNode: customNodeCreator,
      onRemoveNode: onRemoveNode,
      autoStart:true, 
    });



  </script>
<x-layout>
    <script
    src="http://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
    </script>
     <div id="my_pdf_viewer" class="mx-auto w-100 relative">
        <div id="canvas_container" class="w-100 bg-gray-400 flex justify-center">
            <canvas id="pdf_renderer"></canvas>
        </div>
        <div class="w-100 fixed bottom-5 flex justify-center" style="width:100vw;">
            <div id="navigation_controls">
                <button id="go_previous" class="bg-blue-500 text-white p-1 rounded">Previous</button>
                <input id="current_page" value="1" type="number" class="border p-1 rounded"/>
                <button id="go_next" class="bg-blue-500 text-white p-1 rounded">Next</button>
            </div>
            <div id="zoom_controls">
                <button id="zoom_in" class="mx-1 bg-green-500 text-white p-1 rounded text-white px-3">+</button>
                <button id="zoom_out" class="mx-1 bg-green-500 text-white p-1 rounded text-white px-3">-</button>
            </div>
        </div>
    </div>

    <script>
        var myState = {
            pdf: null,
            currentPage: 1,
            zoom: 1
        }

        pdfjsLib.getDocument('/storage/{{$module->material}}').then((pdf) => {

            myState.pdf = pdf;
            render();

        });

        function render() {
            myState.pdf.getPage(myState.currentPage).then((page) => {

                var canvas = document.getElementById("pdf_renderer");
                var ctx = canvas.getContext('2d');

                var viewport = page.getViewport(myState.zoom);

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });
            });
        }

        document.getElementById('go_previous').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage == 1)
              return;
            myState.currentPage -= 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });

        document.getElementById('go_next').addEventListener('click', (e) => {
            if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages)
               return;
            myState.currentPage += 1;
            document.getElementById("current_page").value = myState.currentPage;
            render();
        });

        document.getElementById('current_page').addEventListener('keypress', (e) => {
            if(myState.pdf == null) return;

            // Get key code
            var code = (e.keyCode ? e.keyCode : e.which);

            // If key code matches that of the Enter key
            if(code == 13) {
                var desiredPage =
                document.getElementById('current_page').valueAsNumber;

                if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                    myState.currentPage = desiredPage;
                    document.getElementById("current_page").value = desiredPage;
                    render();
                }
            }
        });

        document.getElementById('zoom_in').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            myState.zoom += 0.5;
            render();
        });

        document.getElementById('zoom_out').addEventListener('click', (e) => {
            if(myState.pdf == null) return;
            if ( myState.zoom <= 1) {
                render();
                return;
            }
            myState.zoom -= 0.5;
            render();
        });
    </script>

    <script>
        setInterval(() => {
            fetch('/check-module/{{$module->id}}')
                .then(res => res.text())
                .then(data => {
                    if (data !== "{{\App\Models\Module::STATUS_ENABLE}}") {
                        console.log('now disabling...');
                        window.location.reload();
                    }
                })
        }, 3000);
    </script>
</x-layout>

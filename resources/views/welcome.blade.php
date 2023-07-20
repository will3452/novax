<x-layout>
    <div class="w-screen h-screen flex justify-center items-center bg-gray-100">
        <div>
            <h1 class="text-3xl uppercase font-bold text-gray-700">
                SOS is under development
            </h1>
            <div class="text-center">
                <a href="/admin/login" class="btn mt-2">LOGIN AS ADMIN</a>
            </div>
        </div>
    </div>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.0.0/firebase-app.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        const firebaseConfig = {
          apiKey: "AIzaSyBVNLTWE9tTbKFd3angSI3ZDNHyils-gbQ",
          authDomain: "sos-app-9435f.firebaseapp.com",
          projectId: "sos-app-9435f",
          storageBucket: "sos-app-9435f.appspot.com",
          messagingSenderId: "266779597326",
          appId: "1:266779597326:web:39fa16ee36c72b4059ba5f"
        };

        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.0.0/firebase-messaging.js"

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        const messaging = getMessaging(app);
        let token = await getToken(messaging, {vapidKey: "BJkPJbFo9NrzjMa1GS0Ukhn1kkpEstI1NYji5qB8eaJpIGDA3-ww0NghMKFHXvXOObSAXfv6lI3fnVU4nQ1Y7QI"});
        console.log('token >> ', token)
      </script>

</x-layout>

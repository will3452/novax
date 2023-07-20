// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyBVNLTWE9tTbKFd3angSI3ZDNHyils-gbQ",
    authDomain: "sos-app-9435f.firebaseapp.com",
    projectId: "sos-app-9435f",
    storageBucket: "sos-app-9435f.appspot.com",
    messagingSenderId: "266779597326",
    appId: "1:266779597326:web:39fa16ee36c72b4059ba5f"
  });

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

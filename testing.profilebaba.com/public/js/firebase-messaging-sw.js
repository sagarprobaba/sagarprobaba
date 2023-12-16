importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js');

const firebaseConfig = {
    apiKey: "AIzaSyBnaV8Ij34EF3dz-QNjBW5y0_Ox5GNU1oM",
    authDomain: "profilebaba-7e028.firebaseapp.com",
    databaseURL: "https://profilebaba-7e028-default-rtdb.firebaseio.com",
    projectId: "profilebaba-7e028",
    storageBucket: "profilebaba-7e028.appspot.com",
    messagingSenderId: "351471668393",
    appId: "1:351471668393:web:19c22fec63992763eaedb8",
    measurementId: "G-WXL1BF9581"
  };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();

        console.log('FIREBASE MESSAGING SW ....');
        console.log(messaging);

        messaging.setBackgroundMessageHandler(function(payload) {

            console.log(
        
                "[firebase-messaging-sw.js] Received background message ",
        
                payload,
        
            );
        
            /* Customize notification here */
        
            const notificationTitle = "Background Message Title";
        
            const notificationOptions = {
        
                body: "Background Message body.",
        
                icon: "/itwonders-web-logo.png",
        
            };
        
          
        
            return self.registration.showNotification(
        
                notificationTitle,
        
                notificationOptions,
        
            );
        
        });
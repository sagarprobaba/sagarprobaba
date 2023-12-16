importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js');

const firebaseConfig = {
    apiKey: "AIzaSyBTOlZlSSZwPqlrxe4sYKYK6xx9nzmNu-I",
    authDomain: "profilebaba-e1037.firebaseapp.com",
    projectId: "profilebaba-e1037",
    storageBucket: "profilebaba-e1037.appspot.com",
    messagingSenderId: "758155398283",
    appId: "1:758155398283:web:19b7deb559ef6f20c5188e",
    measurementId: "G-748ZS3W535"
  };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();
        messaging.usePublicVapidKey("BNcdzywPhfwuS5k0B4TN70ngpJVknl-53v_Kh41xZFTcTO1OVSCzTf7hgjntpSpsljhW-bfK8_qdP164HZdK0mo");

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
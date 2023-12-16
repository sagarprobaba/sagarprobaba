
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
const database = firebase.database();
const auth = firebase.auth();

function retreiveToken(){
    messaging.getToken().then((currentToken) => {
        if (currentToken) {
            sendTokenToServer(currentToken);
            // updateUIForPushEnabled(currentToken);
        } else {
            // Show permission request.
            //console.log('No Instance ID token available. Request permission to generate one.');
            // Show permission UI.
            //updateUIForPushPermissionRequired();
            //etTokenSentToServer(false);
            alert('You should allow notification!');
        }
    }).catch((err) => {
        console.log(err.message);
        // showToken('Error retrieving Instance ID token. ', err);
        // setTokenSentToServer(false);
    });
}
retreiveToken();
messaging.onTokenRefresh(()=>{
    retreiveToken();
});

messaging.onMessage(function(payload) {
    console.log("onMessage: " + JSON.stringify(payload.notification));
    let notificationBody = JSON.parse(payload.notification.body);
    const noteTitle = payload.notification.title;
    const message = notificationBody.message;
    const chat = notificationBody.chat;
    const type = notificationBody.type;
    showNotification(message,noteTitle,chat,type);
    // appendMessage(notificationBody.msgContent);
    // scrollToButtom('.messages');
}, e => {
    console.log(e);
});


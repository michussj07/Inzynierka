importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-messaging.js');
// Initialize Firebase
var config = {
    apiKey: "AIzaSyBWrZPVnpMK_qG_LI3_YB0mnfI17gr8uA0",
    authDomain: "push-55bb6.firebaseapp.com",
    databaseURL: "https://push-55bb6.firebaseio.com",
    projectId: "push-55bb6",
    storageBucket: "push-55bb6.appspot.com",
    messagingSenderId: "1000733896588"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const notificationTitle = payload.data.title;
    const notificationOptions = {
        body: payload.data.body,
        icon: 'http://localhost/gcm-push/img/icon.png',
        image: 'http://localhost/gcm-push/img/d.png'
    };

    return self.registration.showNotification(notificationTitle,
        notificationOptions);
});
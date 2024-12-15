importScripts('https://www.gstatic.com/firebasejs/10.13.2/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging-compat.js');

const firebaseConfig = {
    apiKey: "AIzaSyD7YbmsRQkylbKg7dVrRekVIrMKU-s1SMU",
    authDomain: "fcm-web-51531.firebaseapp.com",
    projectId: "fcm-web-51531",
    storageBucket: "fcm-web-51531.firebasestorage.app",
    messagingSenderId: "359843238947",
    appId: "1:359843238947:web:12a1109f684e06c0384d96"
};

const app = firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log('[firebase-messaging-sw.js] Received background message: ', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        vibrate: [100, 50, 100],
    };
    self.registration.showNotification(notificationTitle, notificationOptions);
});
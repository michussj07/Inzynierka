importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.9.1/firebase-messaging.js');
/*Update this config*/
var config = {
    apiKey: "AIzaSyDZ56QKkFT33hC3Ee3KyhqwkM0Pmkysg20",
    authDomain: "push-v2-7a3d4.firebaseapp.com",
    databaseURL: "https://push-v2-7a3d4.firebaseio.com",
    projectId: "push-v2-7a3d4",
    storageBucket: "",
    messagingSenderId: "335978700030"
  };
  firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notificationOptions = {
    body: payload.data.body,
          icon: 'http://localhost/strony/inzynierka/style/img/powiadomienie.png',
		  image: 'http://localhost/strony/inzynierka/style/img/giphy.gif',
		  data:{
			time: new Date(Date.now()).toString(),
		  click_action: payload.data.click_action,
		  }, 
		  tag: payload.data.tag,
  };
  
  

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});

self.addEventListener('notificationclick',function(event) {
	
	var action_click=event.notification.data.click_action;
	event.notification.close();
	
	event.waitUntil(
	clients.openWindow(action_click)
	);
});

/*self.addEventListener('notificationclick', function(event) {
  console.log('On notification click: ', event.notification.tag);
  event.notification.close();

  // This looks to see if the current is already open and
  // focuses if it is
  event.waitUntil(clients.matchAll({
    type: "window"
  }).then(function(clientList) {
    for (var i = 0; i < clientList.length; i++) {
      var client = clientList[i];
      if (client.url == '/' && 'focus' in client)
        return client.focus();
    }
    if (clients.openWindow)
      return clients.openWindow('/');
  }));
});*/

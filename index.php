<!DOCTYPE html>
<html lang="pl">
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Interaktywne aplikacje internetowe</title>

    <meta name="description" content="Praca inżynierska prezemtująca działanie powiadomień push" />
    <meta name="keywords" content="powiadomienia, push, inżynierka, praca, dyplomowa" />
    <link href="https://fonts.googleapis.com/css?family=Charmonman:400,700|Lato&amp;subset=latin-ext" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <script src="scripts/date.js"></script>
    <script src="scripts/jquery-3.3.1.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.7.1/firebase.js"></script>
<link rel="manifest" href="man/manifest.json">
<script>

  var config = {
    apiKey: "AIzaSyDZ56QKkFT33hC3Ee3KyhqwkM0Pmkysg20",
    authDomain: "push-v2-7a3d4.firebaseapp.com",
    databaseURL: "https://push-v2-7a3d4.firebaseio.com",
    projectId: "push-v2-7a3d4",
    storageBucket: "",
    messagingSenderId: "335978700030"
  };
  firebase.initializeApp(config);

  // Retrieve Firebase Messaging object.
  const messaging = firebase.messaging();

  messaging.requestPermission().then(function() {
      console.log('Notification permission granted.');
      // TODO(developer): Retrieve an Instance ID token for use with FCM.
   if(isTokenSentToServer()) {
 console.log('Token already saved')
   } else {
       getRegToken();
   }
   //getRegToken();
   }).catch(function(err) {
   console.log('Unable to get permission to notify.', err);
});

function getRegToken (argument) {
       messaging.getToken().then(function(currentToken) {
           if (currentToken) {
               saveToken(currentToken);
               console.log(currentToken);
               setTokenSentToServer(true);
           } else {
               console.log('No Instance ID token available. Request permission to generate one.');
               setTokenSentToServer(false);
           }
       }).catch(function(err) {
           console.log('An error occurred while retrieving token. ', err);
           setTokenSentToServer(false);
       });
}

function setTokenSentToServer(sent) {
   window.localStorage.setItem('sentToServer', sent ? '1' : '0');
}

function isTokenSentToServer() {
   return window.localStorage.getItem('sentToServer') === '1';
}

    function saveToken(currentToken) {
        $.ajax({
            url: 'action.php',
            method: 'post',
            data: 'token=' + currentToken


        }).done(function(result){
            console.log(result);
        })
    }

messaging.onMessage(function (payload) {
    console.log('Message Received' + payload);
});
  messaging.onMessage(function(payload) {
      console.log("Message received. ", payload);
      notificationTitle = payload.data.title;
      notificationOptions = {
          body: payload.data.body,
          icon: payload.data.icon,
          image: payload.data.image,
          data:{
              time: new Date(Date.now()).toString(),
              click_action: payload.data.click_action,
          },
          tag: payload.data.tag,
          //click_action : 'http://localhost/strony/Inzynierka/index.php',

      };
      var notification = new Notification(notificationTitle,notificationOptions);
  });

  /*self.addEventListener('notificationclick',function(event) {

      var action_click=event.notification.data.click_action;
      event.notification.close();

      event.waitUntil(
          clients.openWindow(action_click)
      );
  });*/
  </script>
  </head>
      <body>

      <body onLoad="wyswietlDane()">

      <div class="logo">Interaktywne aplikacje internetowe </div>
      <div id="dataLayer">
      </div>
      <div class="nav">
          <ol>
              <li><a href="index.html">Strona główna</a></li>
              <li><a href="testpowiadomien.html">Demo</a></li>
              <li><a href="index.php">Demo Firebase</a></li>


          </ol>
      </div>

      <div class="content">

          <h1>Demo Firebase</h1>
          <br>
          Na prezentowanej stronie będzie przedstawiany bardziej rozwinięta technologia powiadomień push.
          Prezentowana aplikację korzysta z usług strony firebase i programu Postman by bez przeszkód
          wysłać powiadomienie na mój pulpit przy włączonej przeglądarce. (W tym przypadku Google Chrome)
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      </div>




      <div class="footer">
          powiadomieniapush.000webhost.pl &copy; Wszystkie prawa zastrzeżone 2018
      </div>

      <script src="scripts/stickynav.js"></script>
      </body>


</html>
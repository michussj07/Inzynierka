<!DOCTYPE HTML>
<html>
<head>

    <title>Interaktywne aplikacje internetowe</title>

    <script src="https://www.gstatic.com/firebasejs/5.7.1/firebase.js"></script>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <link rel="manifest" href="manifest.json">
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyBWrZPVnpMK_qG_LI3_YB0mnfI17gr8uA0",
            authDomain: "push-55bb6.firebaseapp.com",
            databaseURL: "https://push-55bb6.firebaseio.com",
            projectId: "push-55bb6",
            storageBucket: "",
            messagingSenderId: "1000733896588"
        };
        firebase.initializeApp(config);

        const messaging = firebase.messaging();
        messaging.requestPermission()
            .then(function() {
                console.log('Notification permission granted.');
                // TODO(developer): Retrieve an Instance ID token for use with FCM.
                if(isTokenSentToServer()) {
                    console.log('Token already saved.');
                } else {
                    getRegToken();
                }

            })
            .catch(function(err) {
                console.log('Unable to get permission to notify.', err);
            });

        function getRegToken(argument) {
            messaging.getToken()
                .then(function(currentToken) {
                    if (currentToken) {
                        saveToken(currentToken);
                        console.log(currentToken);
                        setTokenSentToServer(true);
                    } else {
                        console.log('No Instance ID token available. Request permission to generate one.');
                        setTokenSentToServer(false);
                    }
                })
                .catch(function(err) {
                    console.log('An error occurred while retrieving token. ', err);
                    setTokenSentToServer(false);
                });
        }

        function setTokenSentToServer(sent) {
            window.localStorage.setItem('sentToServer', sent ? 1 : 0);
        }

        function isTokenSentToServer() {
            return window.localStorage.getItem('sentToServer') == 1;
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

        messaging.onMessage(function(payload) {
            console.log("Message received. ", payload);
            notificationTitle = payload.data.title;
            notificationOptions = {
                body: payload.data.body,
                icon: payload.data.icon,
                image:  payload.data.image
            };
            var notification = new Notification(notificationTitle,notificationOptions);
        });

    </script>
</head>

<body>
    <h1>Test powiadomień push nr2</h1>




</body>
</html>
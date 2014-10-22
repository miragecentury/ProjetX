<?php
header('Access-Control-Allow-Origin: *');
?>

<head>
    <script src="/js/autobahn.js"></script>
    <script>
        window.onload = function () {

            // WAMP server
            var wsuri = "ws://projetx.nordri.fr:8080";

            ab.connect(wsuri,
                    // WAMP session was established
                            function (session) {
                                console.log("Connected");
                                // subscribe to topic
                                session.subscribe(
                                        "ws.projetx.common.user.login",
                                        // on event publication callback
                                                function (topic, event) {
                                                    console.log("User Login");
                                                    console.debug(topic);
                                                    console.debug(event);
                                                }
                                        );
                                    },
                                    // WAMP session is gone
                                            function (code, reason) {
                                                console.log(reason);
                                            }
                                    );
                                };
    </script>
</head>
<body>
    WS Test
</body>
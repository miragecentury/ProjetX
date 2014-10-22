<?php
header('Access-Control-Allow-Origin: *');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="/js/autobahn.js"></script>
    <script>
        window.onload = function () {

            // WAMP server
            var wsuri = "ws://projetx.nordri.fr:8080";
            $('#state').empty();
            $('#state').text("Déconnecté");
            var addEvent = function (topic, event) {
                console.debug(topic);
                console.debug(event);
                var ar = {};
                ar = JSON.parse(event);
                // create a new javascript Date object based on the timestamp
                // multiplied by 1000 so that the argument is in milliseconds, not seconds
                var date = new Date(ar.data.TimeStamp*1000);
                // hours part from the timestamp
                var hours = date.getHours();
                // minutes part from the timestamp
                var minutes = "0" + date.getMinutes();
                // seconds part from the timestamp
                var seconds = "0" + date.getSeconds();

                // will display time in 10:30:23 format
                var formattedTime = hours + ':' + minutes.substr(minutes.length-2) + ':' + seconds.substr(seconds.length-2);
                $("#eventtable").append("<tr><td>"+formattedTime+"</td><td>"+topic+"</td><td>"+JSON.stringify(ar.data)+"</td></tr>");
            };
            ab.connect(wsuri,
                    // WAMP session was established
                            function (session) {
                                console.log("Connected");
                                $('#state').empty();
                                $('#state').text("Connecté");
                                $('#state').removeClass("label-danger");
                                $('#state').addClass("label-success");
                                // subscribe to topic
                                session.subscribe(
                                        "ws.projetx.common.user.login",
                                        // on event publication callback
                                                function (topic, event) {
                                                    addEvent(topic, event);
                                                }
                                        );
                                        session.subscribe(
                                                "ws.projetx.common.user.create",
                                                // on event publication callback
                                                        function (topic, event) {
                                                            addEvent(topic, event);
                                                        }
                                                );
                                            },
                                            // WAMP session is gone
                                                    function (code, reason) {
                                                        console.log(code);
                                                        console.log(reason);
                                                        $('#state').text("Déconnecté");
                                                        $('#state').removeClass("label-success");
                                                        $('#state').addClass("label-danger");
                                                    }
                                            );
                                        };
    </script>
</head>
<body style="padding-top: 50px;">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Debug Wamp ProjetX</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <th>WAMP</th>
                    <th><div id="state" class="label label-danger" style="display: block;">Disconnect</div></th>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <th>DateTime</th>
                    <th>Topic</th>
                    <th>Data</th>
                    </thead>
                    <tbody id="eventtable">

                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>
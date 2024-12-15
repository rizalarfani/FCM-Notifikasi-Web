<?php
include 'koneksi.php';

$query = mysqli_query($connection, 'SELECT * FROM notifikasi');
$listNotifikasi = mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FCM Notifikasi Web</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">

    <script src="https://www.gstatic.com/firebasejs/11.0.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/11.0.2/firebase-messaging-compat.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="../../index2.html" class="navbar-brand"><b>FCM</b>Notifikasi</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php">Notifikasi <span class="sr-only">(current)</span></a></li>
                        </ul>
                    </div>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Notifications Menu -->
                            <li class="dropdown notifications-menu">
                                <!-- Menu toggle button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning" id="jumlah_notif">0</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Your notifications</li>
                                    <li>
                                        <ul class="menu" id="menu-notif">
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="index.php">View all</a></li>
                                </ul>
                            </li>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">Rijal Arfani</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                        <p>
                                            Rijal Arfani - Web Developer
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div><!-- /.navbar-custom-menu -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <div class="container">
                <!-- Main content -->
                <section class="content mt-3">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Notifikasi</h3>
                            <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add">Tambah</button>
                        </div>
                        <div class="box-body">

                        </div>
                    </div>
                </section>
            </div>
        </div>

        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.0
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
            </div><!-- /.container -->
        </footer>
    </div><!-- ./wrapper -->

    <div class="example-modal">
        <div class="modal" id="add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Kirim Notifikasi</h4>
                    </div>
                    <form action="send_notif.php" class="form-horizontal" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="title" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body" class="col-sm-2 control-label">Body</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="body" name="body">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<!-- jQuery 2.1.4 -->
<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script>
    var source = new EventSource('sse.php');

    source.onmessage = function(e) {
        var data = JSON.parse(e.data);
        var html = ``;

        data.forEach(element => {
            html += `<li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i>${element.title}
                        </a>
                    </li>`;
        });

        $("#menu-notif").html(html);
        $("#jumlah_notif").text(data.length);
    };

    source.onerror = (err) => {
        console.error("EventSource failed:", err);
    };

    window.onunload = function() {
        source.close();
    }

    $(document).ready(function() {
        requestPermission();

        function requestPermission() {
            console.log('Request Permission');
            // Request permissions notifications
            if (Notification.permission == 'default') {
                Notification.requestPermission().then((permission) => {
                    if (permission === 'granted') {
                        console.log("Izin diberikan oleh user");
                        requestToken();
                    } else {
                        console.log("Izin ditolak oleh user");
                    }
                });
            } else if (Notification.permission == 'granted') {
                console.log("Izin sudah diberikan oleh  user");
                requestToken();
            }
        }
    });
</script>

<script>
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

    function requestToken() {
        messaging.getToken({
            vapidKey: "BAdiARoZVVi5FrS5lPNCjliCxj_Z6qViHK-b9cf1rmENT26mE0pH3cLcIEXmp0TR4yKl_CJ1Ch_-yYPioZ7LpjA"
        }).then((token) => {
            if (token) {
                console.log(token);
                $.ajax({
                    url: 'save_token.php',
                    type: 'POST',
                    data: {
                        token: token,
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log("Token berhasil disimpan: ", response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error saat menyimpan token: ", error);
                    }
                });
            } else {
                console.log('No registration token available. Request permission to generate one.');
                requestPermission();
            }

        });
    }

    messaging.onMessage((payload) => {
        console.log("Message received: ", payload);
        if (Notification.permission == 'granted') {
            new Notification(payload.notification.title, {
                body: payload.notification.body
            });
        }
    });
</script>


</html>
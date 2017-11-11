<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="apple-touch-icon-precomposed" href="img/extra/app_icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="img/extra/favicon.ico">

    <title>Cross the Line - Pop Rock from Marine City, MI</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    

    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-48981914-2', 'auto');
      ga('send', 'pageview');

    </script>

    <!-- script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us9.list-manage.com","uuid":"e0cce9ea50e7e37b5bc731b4f","lid":"7f2e7b3bb2"}) })</script -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<?php


// session_start();

/* Connecting to the database. */
$dsn = 'mysql:dbname=crosaomy_subscribers;host=localhost';
$user = 'crosaomy_admin';
$password = 'sjbew8==DIT';

try {
	$dbh = new PDO($dsn, $user, $password);
	//$_SESSION['server'] = $dbh;
}
catch (PDOException $e) {
	print 'Connection failed: ' . $e->getMessage();
}

// searching for all of the reset requests within the past 12 hours.
$search = $dbh->prepare("SELECT * FROM `users` WHERE date > DATE_SUB(NOW(), INTERVAL 1 WEEK)");
$search->execute();

// seeing if the resetID is still valid.
while ($found_rows = $search->fetch(PDO::FETCH_ASSOC)) {
	if ($found_rows['download_id'] === $_GET['id']) {
		$display = $found_rows['used'];
		break;
	}
}

// if there is a request found within the past 12 hours, present them with the option
// to reset their password.
if ($display == "0") {

	print '<div class="brand"><img class="img-responsive img-border img-center" src="img/ctl_logo.png" alt="" style="border:0px; margin-top: -25px"></div>
    <div class="address-bar">Quality Pop-Rock | Marine City, MI</div>

    <div class="container" style="margin-top: 25px">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>

                    <h2 class="intro-text text-center">Congratulations, you\'ve found our 
                        <strong>free songs!</strong>
                    </h2>
                    <hr>
                    <img class="img-responsive img-border img-left" src="img/ctl_wrecking_ball_artwork.png" alt="">
                    <hr class="visible-xs">
                    <p>Hope you guys really enjoy this! We love this song, and hope you do too! Thanks for all you guys do to support us. Tell us what you thought of it and what covers you would like to hear in the future - becuase we love to get feedback!</p>
                    <p>Here is the download link for the song: <a href="music/Wrecking Ball (Cross the Line).mp3" download>Wrecking Ball</a></p>
                    <hr>
                    <img class="img-responsive img-border img-left" src="img/ctl_xmas_artwork.png" alt="">
                    <hr class="visible-xs">
                    <p>This is our Christmas cover of Mariah Carey\'s, "All I Want For Christmas Is You." We hope all of you enjoy this song, and everyone have a safe and happy holiday!</p>
                    <p>Here is the download link for the song: <a href="music/All I Want For Christmas Is You (Cross the Line).mp3" download>All I Want For Christmas is You</a></p>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->';

    // changing the used field to 'true' or 1.
    $update_database = $dbh->prepare("UPDATE `users` SET `used` = 1 WHERE `download_id` = ?");
	$update_database->execute(array($_GET['id']));

}
// if the user came to the page with a wrong/expired ID.
else {

	print '<div class="brand"><img class="img-responsive img-border img-center" src="img/ctl_logo.png" alt="" style="border:0px; margin-top: -25px"></div>
    <div class="address-bar">Quality Pop-Rock | Marine City, MI</div>

    <div class="container" style="margin-top: 25px">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>

                    <h2 class="intro-text text-center">Uh oh! It looks like this link has already been <strong>used</strong> or has been <strong>expired.</strong></h2>
                    <hr>

                    <p class="text-center">If you think you\'ve came across the page by mistake, please contact us at <strong><a href="mailto:name@example.com">crossthelineband2016@gmail.com</a></strong></p>
                    <hr>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->';
}

?>

	<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Cross the Line 2014</p>
                </div>
            </div>
        </div>
    </footer>

<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Javascript for integrating the MailChimp Form. -->
    <!-- script type="text/javascript" src="js/ctl_website.js"></script -->
    <!-- script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script -->

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
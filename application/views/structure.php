<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>277Studios Library</title>
    <meta name="description" content="A admin dashboard theme that will get you started with Bootstrap 4." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Codeply">



    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body >
    <?php echo $this->load->view('common/header.php');?>
<div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">
         <?php echo $this->load->view('common/sidebar.php');?>
        <!--/col-->

        <div class="col-md-9 col-lg-10 main">
        <?php echo $this->load->view('home.php');?>
        </div>
        <!--/main col-->
    </div>

</div>
<!--/.container-->
<?php echo $this->load->view('common/footer');?>
  </body>
</html>
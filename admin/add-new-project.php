<?php
    // Initialize the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>New Project | Marvel Design</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
        <script>
            function successAlert()
            {
                Swal.fire(
                { 
                    icon: 'success',
                    title: 'Product Added Successfully.',
                    showConfirmButton: true, 
                }).then(function(){
                    window.location.replace("/marvel/admin/projects.php");
                })
            }
            function ErrorAlert()
            {
                Swal.fire(
                { 
                    icon: 'error',
                    title: 'Product is not Added .',
                    showConfirmButton: true, 
                })
            }
        </script>

        <script type='text/javascript'>
            function preview_image(event) 
            {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image');
            output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
            }
        </script>
<style>
#output_image
{
 max-width:200px;
}
</style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php"> Marvel Design Admin</a>
            
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">                    
                        <a class="dropdown-item bg-dark text-white" href="#"> <?php echo htmlspecialchars($_SESSION["username"]); ?> </a>                         
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-5">Add New Project</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><a href="dashboard.php">dashboard </a></li>
                            <li class="breadcrumb-item active"><a href="projects.php">Projects </a></li>
                            <li class="breadcrumb-item active">Add New Project </li>
                        </ol> 
                        <?php  
                            // Database configuration  
                            $dbHost     = "localhost";  
                            $dbUsername = "root";  
                            $dbPassword = "";  
                            $dbName     = "marvel";  
                            
                            // Create database connection  
                            $con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);  

                            if(isset($_POST['upload']))
                            {        
                                $Name= $_POST['Name'];                                
                                $file = $_FILES['Image']['name'];
                                
                                $query = "INSERT INTO projects(Image,Name) VALUES('$file','$Name')";   
                                $res = mysqli_query($con,$query);    
                                if($res)
                                {
                                    echo "<script>successAlert()</script>";
                                    move_uploaded_file($_FILES['Image']['tmp_name'],"images/$file");
                                }
                                else 
                                {
                                    echo "<script>ErrorAlert()</script>";
                                }
                                mysqli_close($con);
                                
                            }
                        ?>
                        <!-- Container //-->
                        <div class="container border rounded p-2 m-4">                                                                         
                            <form method="post" enctype="multipart/form-data">                                    
                                
                                <!-- form-group // -->
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Project Name :-</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="Name" id="name" placeholder="Enter your Product name" required>
                                    </div>
                                </div>
                                <!-- End form-group // -->                                                                                                                                                                                                                                           

                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Product Image :-</label>
                                    <div class="col-sm-3">
                                        <label class="control-label small" for="file_img">Image type : (jpg/png):</label>                                         
                                        <input type="file" id="imgInp" name="Image" accept="image/" onchange="preview_image(event)" required>
                                        <img id="output_image"/>
                                        
                                    </div>                                        
                                </div> <!-- form-group // -->

                                <!-- form-group // -->         
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <input type="submit" name="upload" value="UPLOAD" class="btn btn-success">
                                    </div>
                                </div> 
                                <!-- End form-group // -->                               
                            </form>                                                                                                  
                        </div> 
                        <!-- container// -->
                        <br>                                            
                    </div>                    
                </main>
                
            </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>


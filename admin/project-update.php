<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:/madhur/admin/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard | Marvel Design</title>
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
                        <h1 class="mt-5">Update your image</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><a href="dashboard.php">dashboard </a></li>
                            <li class="breadcrumb-item active"><a href="projects.php">Projects </a></li>
                            <li class="breadcrumb-item active">Update your image</li>
                        </ol> 
                        
                        <?php
                        // Database configuration  
                        $dbHost     = "localhost";  
                        $dbUsername = "root";  
                        $dbPassword = "";  
                        $dbName     = "marvel";  
                        
                        // Create database connection  
                        $con = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
                        
                        //now check the connection
                        if(!$con)
                        {
                            die("connection Failed :".mysqli_connect_error());
                        }
                        if(isset($_POST['save']))
                        {
                            $id = $_GET['id'];         
                            $Name=$_POST['Name'];                            
                            $Image=$_POST['Image'];

                            $sql_query = "UPDATE projects SET Name='$Name' ,  Image='$Image' WHERE id=$id"; 

                            if(mysqli_query($con,$sql_query))
                            {
                                echo"<script>successAlert()</script>";
                            }
                            else
                            {
                                echo "<script>ErrorAlert()</script>";
                            }
                            mysqli_close($con);
                        }
                    ?>
                    <?php
                        $id = $_GET['id'];
                        $link = mysqli_connect("localhost", "root", "", "marvel"); 
                        if ($link ==false) 
                        { 
                            die("ERROR: Could not connect. "
                            .mysqli_connect_error()); 
                        } 
                        $sql = "SELECT * FROM projects WHERE id=$id"; 
                        if ($res = mysqli_query($link, $sql)) 
                        { 
                            if (mysqli_num_rows($res) > 0) 
                            {                                                        
                                while ($row = mysqli_fetch_array($res)) 
                                { 
                        ?>
                    <form action="" method="post">
                        <div class="border rounded  ml-4 mr-4 p-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class=" control-label">Product Name :-</label>
                                    <input type="text" class="form-control"  name="Name" placeholder="Enter your Product Name" value="<?php echo $row['Name']?>" required>
                                </div>                                 

                                <div class="form-group">
                                    <label for="name" class=" control-label">Product Image :-</label><br>
                                    <div class="col-sm-3">
                                        <label class="control-label small" for="file_img">Image type : (jpg/png):</label>                                         
                                        <input type="file" id="imgInp" name="Image" accept="image/" onchange="preview_image(event)" required>
                                        <img id="output_image"/>                                        
                                    </div>                                    
                                </div>                            
                                    
                                <div class="row">
                                <div class="col-md-12">                                    
                                    <input type="submit" class="btn btn-primary btn-md" name="save" value="Update">           
                                    <a href="projects.php" class="btn btn-secondary" style="margin-left:20px;" role="button" aria-disabled="true">Cancel</a>                             
                                </div>
                            </div>    
                            </div>    
                        </div> 
                    </form>
                    <?php
                                    }                                              
                                } 
                                else 
                                { 
                                    echo ""; 
                                } 
                            } 
                            else 
                            { 
                                echo "ERROR: Could not able to execute $sql. "
                                .mysqli_error($link); 
                            } 
                            mysqli_close($link); 
                            ?>                   
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


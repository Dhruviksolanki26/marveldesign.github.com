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
                        <h1 class="mt-5">Projects</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><a href="dashboard.php">Dashboard </a></li>
                            <li class="breadcrumb-item active">Projects</li>
                        </ol> 
                        <ol class="breadcrumb mb-4">                                                  
                            <button class="btn btn-info "><a href="add-new-project.php" class="text-white" style="text-decoration:none;">Add New Project Image</a></button>                                                                                                                              
                        </ol> 

                        <div class="border rounded  ml-4 mr-4 p-3">                
                        <table class="table text-center ">
                        <?php    
                                        if(isset($_GET['del']  ) ){
                                            if($_GET['del']==1){
                                                $connection = mysqli_connect("localhost","root","","marvel");
                                                $ID=$_GET['ID']; 
                                                $sql = "DELETE FROM projects WHERE ID=$ID";
                                                if (mysqli_query($connection, $sql)) {
                                                    echo "<script>successAlert()</script>";
                                                } else {
                                                    echo "<script>ErrorAlert()</script>";
                                                }
                                                mysqli_close($connection);
                                            }
                                        }                          
      
                                    ?>  
                            <?php
                                $connection = mysqli_connect("localhost","root","","marvel");
                                $query = "SELECT * FROM projects";
                                $query_run = mysqli_query($connection,$query);
                                $result=$query_run;                                
                            ?>
                            <thead class="bg-dark text-white">
                                <tr>
                                    
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                                                                                                            
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        while($row = mysqli_fetch_assoc($query_run))
                                        {
                                            $image_path = $row['Image'];                                            
                                                
                                ?>
                                <tr>
                                
                                    <td><?php echo $row['id']; ?></td>
                                    <td> <?php echo"<img src='/marvel/admin/images/$image_path' height='100'>" ?>   </td>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td>
                                    <a href="project-update.php?id=<?php echo htmlentities($row['id']);?>" class="btn btn-sm " style="font-size:24px" >
                                                                <i class="fas fa-edit"></i></a> 
                                        </a>
                                        <a class="btn btn-sm btn-primary" style="background:red; border:none;" href="projects.php?ID=<?php echo $row["id"];?>&del=1" onClick="return confirm('You are about to permanently delete this Product. Click OK to continue or CANCEL to quit.');">
                                                                <i class="fa fa-trash"></i></a> 
                                            </a>                                        
                                    </td>                                    
                                </tr>                                                                 
                            </tbody>
                            <?php                                           
                                        }
                                    }
                                    else
                                    {
                                        echo"<tfoot><td colspan='6' class='text-center'><h3 style='color:red;'>No Records found<h3></td></tfoot>";
                                    }
                                ?>       
                            
                        </table>
                    </div> 

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


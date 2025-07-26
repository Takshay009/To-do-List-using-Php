<?php

// INSERT INTO `notess` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'go to buy fruits', 'hi takshay its done already to quite', CURRENT_TIMESTAMP);

// Initialize variables for insert, update, and delete operations
$insert = false;
// $update = false;
// $delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "notes";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Insert the notess into the database

    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // echo "notess added successfully.";
        $insert = true;
    } else {
        echo "Error adding notes: " . mysqli_error($conn);
    }
}

?>

+<!-- html starts from here  -->
<!doctype html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title>Inotes </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-Xbg45MqvDIk1e563NLpGEulpX6AvL404DP+/iCgW9eFa2BqztiwTexswJo2jLMue" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">


<script>
    document.getElementsByClassName('edit');
    Array.from(edit).forEach((element)=>
    {
        element.addEventListener("click",(e)=>{
            console.log("Edit",e);            
        })
    })
</script>
</head>


<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">inotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>


                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>



    <?php
                if ($insert) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your notes has been added successfully.
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }
            ?>

    <!-- form -->

    <div class="container my-4">
        <h3>Add a notes</h3>
        <form action="/To-do-List-using-Php/index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label"> notes Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">
            </div>
            <div class="mb-3">

                <label for="description" class="form-label">notes description</label>
                <textarea class="form-control" placeholder="Leave a notes here" id="description"
                    name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add notes</button>

        </form>
    </div>

    <!-- PHP code -->

    <div class="container">


    </div>

    <div class="container">
        <!-- head -->

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">s.no</th>
                    <th scope="col">Ttile</th>
                    <th scope="col">description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <!-- body and php -->
            <tbody>
                <?php

                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;


              while($row = mysqli_fetch_assoc($result)){
                $sno = $sno + 1;

                echo "<tr>
                    <th scope='row'>". $sno . "</th>
                    <td>". $row['title'] . "</td>
                    <td>". $row['description'] . "</td>
                    <td> <a class='edit' href='/del'>Delete</a> <a href='/Edit'>Edit</a> </td>
                </tr>";

        }
      ?>



            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>


    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- datatable -->
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

    <!-- implement -->
    <script>
        let table = new DataTable('#myTable');
    </script>

</body>

</html>
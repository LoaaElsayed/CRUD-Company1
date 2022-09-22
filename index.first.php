<?php
// function test //
function mytest($condtion,$message){
    if($condtion){
        echo "true $message";
    }
    else{
        echo "false $message";
    }
}
// connection with database//

$connection = mysqli_connect("localhost","root","","training_company");


// create data //
if (isset($_POST['send'])){
    $coursName= $_POST['courseName'];
    $coursCost= $_POST['courseCost'];
    // iNsert data  
    $insert = "INSERT INTO `courses` VALUES(null , '$coursName' , $coursCost)";
    $q = mysqli_query($connection , $insert);
    header("location:index.first.php");

}
// read/select data
$select = "SELECT * FROM `courses`";
$s = mysqli_query($connection , $select);


// delete data //
if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $delete = "DELETE FROM `courses` WHERE id = $id";
    mysqli_query($connection , $delete);
    header("location:index.first.php");
} 

// update data //
$name = "";
$cost = "";
$updatestat = false;
if(isset($_GET['edite'])){
    $id= $_GET['edite'];
    $updatestat = true;
    $selectele = "SELECT * FROM `courses` WHERE id = $id";
    $ele = mysqli_query($connection,$selectele);
    $row = mysqli_fetch_assoc($ele) ;
    $name = $row['course_name'];
    $cost = $row['course_cost'];
    if (isset($_POST['update'])){
        $coursName= $_POST['courseName'];
        $coursCost= $_POST['courseCost'];
        $update = "UPDATE `courses` SET course_name = '$coursName' , course_cost = '$coursCost' WHERE id = $id ";
        $u = mysqli_query($connection , $update);
        header("location:index.first.php");
    }
    
} 
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css - Copy/bootstrap.min.css">

</head>
<body>
    <?php if($updatestat):?>
        <h1 class="text-center m-3"> Update Element</h1>
    <?php else:?>
        <h1 class="text-center m-3"> create Element</h1>
    <?php endif;?>
    <div class="container col-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">course name</label>
                        <input type="text" class="form-control" name="courseName" value="<?php echo $name?>" >
                    </div>
                    <div class="form-group">
                        <label for="">course cost</label>
                        <input type="text" class="form-control" name="courseCost" value="<?php echo $cost?>">
                    </div>
                    <?php if($updatestat):?>
                    <button class="btn btn-warning mt-5" name="update">update data</button>
                    <?php else:?>
                    <button class="btn btn-info mt-5" name="send">send data</button>
                    <?php endif;?>
                </form>
            </div>
        </div>
    </div>

    <div class="container col-6 mt-5 mb-5">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>ID</td>
                        <td>name</td>
                        <td>cost</td>
                        <td colspan="2">Action</td>
                    </tr>
                    <?php foreach($s as $data) { ?>
                        <tr>
                            <th>
                                <?php echo $data['id'] ?>
                            </th>
                            <th>
                                <?php echo $data['course_name'] ?>
                            </th>
                            <th>
                                <?php echo $data['course_cost'] ?>
                            </th>
                            <th>
                                <a href="index.first.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger">Delete</a>
                            </th>
                            <th>
                                <a href="index.first.php?edite=<?php echo $data['id'] ?>" class="btn btn-info">Edite</a>
                            </th>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
<script src="./js/jquery.slim.min.js "></script>
<script src="./js/popper.min.js "></script>
<script src="./js/bootstrap.min.js "></script>
</body>
</html>
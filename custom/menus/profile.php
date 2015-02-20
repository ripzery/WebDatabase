<?php
    require_once('../includes/config.inc.php');

    require_once('../includes/functions.inc.php');

    session_start();

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
    mysqli_select_db($link, DB_DATABASE)  or die("could not find db.");

    $uid = $_SESSION['uid'];

    if($uid == 1){
        $query = "SELECT * FROM personinfo";
    }else{
        $query = "SELECT * FROM personinfo WHERE id = '".$uid."'";
    }

    $result = mysqli_query($link, $query) or die("Data not found");
    $no_row = mysqli_num_rows($result);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profile</h1>
        </div>
     </div>

    <!-- Address -->
    <div class="chat-panel panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <ul class="chat">


                <?php
                    while($row = mysqli_fetch_array($result)){
                ?>

                <li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                    </span>

                    <div class="chat-body clearfix">
                        <div class = "header">
                            <strong class="primary-font"><?php echo $row['firstname'];?></strong>
                        </div>
                        <table border="0">
                            <tbody>
                            <tr><td><i>Address</i></td></tr>
                            <tr>
                            <td><b>Name:</b></td>
                            <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                            </tr>
                            <tr>
                            <td><b>Location:</b></td>
                            <td><?php echo $row['city'].", ".$row['country'];?></td>
                            </tr>
                            <tr>
                            <td><b>Telephone:</b></td>
                            <td><?php echo $row['telephone'];?></td>
                            </tr>
                            <tr>
                            <td><b>E-mail</b></td>
                            <td><?php echo $row['email']?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </li>    
                <?php }?>   
            </ul>
        </div>

        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>



<?php
/**
 * Created by PhpStorm.
 * User: Hugh
 * Date: 2015/6/8 0008
 * Time: 9:16
 */
session_start();
// store session data
$_SESSION['name']=$_POST['name'];
?>

<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>欢迎您管理员：<?php echo $_SESSION['name']; ?></title>
        <link rel="stylesheet" href="../lib/css/common.css">
        <link rel="stylesheet" href="./css/manager.css">
        <script src="../lib/js/jquery.js"></script>
        <script src="../lib/js/logout.js"></script>
    </head>
    <body>
        <header>
            <img src="../lib/image/logo.png">
            <h1>所有用户信息</h1>
            <h2><span id="logout">注销</span></h2>
        </header>
        <div id="person_list">
            <table>
                <tbody>
                    <tr>
                        <th>UserName</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Tel</th>
                        <th>Email</th>
                        <th>Identity</th>
                    </tr>
                <?php
                    $con = mysqli_connect("localhost","root","root");
                    if (!$con)
                    {
                        die('Could not connect: '.mysqli_error($con));
                    }
                    $sql="select * from person";
                    mysqli_select_db( $con,"onlinebook");
                    $result=mysqli_query($con,$sql);
                    $i=0;
                    while($row = mysqli_fetch_array($result)){
                        if(++$i%2==0)
                            echo "<tr class='even'>";
                        else
                            echo "<tr>";
                        echo
                            "<td>".$row['name']."</td>"
                            ."<td>".$row['sex']."</td>"
                            ."<td>".$row['age']."</td>"
                            ."<td>".$row['tel']."</td>"
                            ."<td>".$row['email']."</td>";
                            switch ($row['identity']){
                                case "0":
                                    echo "<td>"."Buyer"."</td>";
                                    break;
                                case "1":
                                    echo "<td>"."ShopKeeper"."</td>";
                                    break;
                                case "2":
                                    echo "<td>"."System Manager"."</td>";
                                    break;
                            }
                            echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
        <footer>
            <h2>网上购书平台开发小组：洪鑫、邓旺华、徐平平、李志伟、吕成</h2>
        </footer>
    </body>
</html>
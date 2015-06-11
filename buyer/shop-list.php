<?php
/**
 * Created by PhpStorm.
 * User: Hugh
 * Date: 2015/6/8 0008
 * Time: 9:11
 */
    session_start();
    // store session data
    if (isset($_POST['name']))
        $_SESSION['name']=$_POST['name'];
?>
<html>
    <head>
        <title>商品列表</title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <link rel="stylesheet" href="../lib/css/common.css">
        <link rel="stylesheet" href="css/shop-list.css">
        <script src="../lib/js/jquery.js"></script>
        <script src="../lib/js/jquery.cookie.js"></script>
        <script src="../lib/js/logout.js"></script>
        <script src="js/cart_obj.js"></script>
        <script src="js/shop_list.js"></script>
    </head>
    <body>
        <header>
            <img src="../lib/image/logo.png">
            <div id="buyer_state">
                <p>
                    <span>Hello,<span id="buyer_name"><?php echo $_SESSION['name']; ?></span>!</span>
                    <span id="logout">注销</span>
                </p>
                <p id="cart">我的购物车</p>
            </div>
        </header>
        <div id="hint">
            <p hidden="hidden" id="success_hint">成功添加到购物车！</p>
        </div>
        <div id="shop_list">
            <?php
                $con = mysqli_connect("localhost","root","root");
                if (!$con)
                {
                    die('Could not connect: '.mysqli_error($con));
                }
                $sql="select * from book";
                mysqli_select_db( $con,"onlinebook");
                $result=mysqli_query($con,$sql);
                $i = 0;
                while($row = mysqli_fetch_array($result)){
                    if (++$i%2==1)
                        echo "<div class='two_items'>";
                    ?>
                    <div class="item<?php echo $i%2==1 ? ' odd_item' : ''; ?>">
                        <img src="../items/image/<?php echo $row['image']; ?>">
                        <div class="info">
                            <p class="item_id" hidden="hidden"><?php echo $row['id']; ?></p>
                            <p class="item_name"><?php echo $row['name']; ?></p>
                            <p>by <span class="item_author"><?php echo $row['author']; ?></span></p>
                            <p class="item_price">$<?php echo sprintf("%.2f",$row['price']); ?></p>
                            <p class="item_publisher">Publisher: <?php echo $row['publisher']; ?><p>
                            <p>Remained: <span class="item_number"><?php echo $row['number']; ?></span><p>
                            <p class="quality_chooser">
                                <span class="minus">-</span>
                                <input type="text" class="purchase_quantity" value="1" />
                                <span class="plus">+</span>
                            </p>
                            <div class="add_to_cart">
                                <img src="image/cart.png">加入购物车
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($i%2==0)
                        echo "</div>";
                }
                if ($i%2==1)
                    echo "</div>";
            ?>
        </div>
        <footer>
            <h2>网上购书平台开发小组：洪鑫、邓旺华、徐平平、李志伟、吕成</h2>
        </footer>
    </body>
</html>
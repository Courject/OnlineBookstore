<?php
/**
 * Created by PhpStorm.
 * User: Hugh
 * Date: 2015/6/9 0009
 * Time: 8:53
 */
    session_start();
    $cart = json_decode($_COOKIE["cart_json"],true);
//    foreach ($cart as $item){
//        echo $item['item_id']." ".$item['quantity']."<br />";
//    }
?>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>我的购物车</title>
        <script src="../lib/js/jquery.js"></script>
        <script src="../lib/js/jquery.cookie.js"></script>
        <script src="../lib/js/logout.js"></script>
        <script src="js/cart_obj.js"></script>
        <script src="js/cart.js"></script>
        <link rel="stylesheet" href="../lib/css/common.css">
        <link rel="stylesheet" href="css/shop-list.css">
        <link rel="stylesheet" href="css/cart.css">
    </head>
    <body>
    <header>
        <img src="../lib/image/logo.png">
        <div id="buyer_state">
            <p>
                <span>Hello,<span id="buyer_name"><?php echo $_SESSION['name']; ?></span>!</span>
                <span id="logout">注销</span>
            </p>
            <p id="shop_list_btn">返回商品列表</p>
        </div>
    </header>
    <div id="cart_list">
        <p id="cart_list_title">购物车列表</p>
        <?php
            $con = mysqli_connect("localhost","root","root");
            if (!$con)
            {
                die('Could not connect: '.mysqli_error($con));
            }
            mysqli_select_db( $con,"onlinebook");

            $total_price = 0.0;
            //遍历cart中的item
            foreach ($cart as $item) {
                $id = $item['item_id'];
                $sql="select * from book where id = ".$id;
                $result=mysqli_query($con,$sql);
                if (mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result);
                    $subtotal = $item['quantity']*$row['price'];
                    $total_price += $subtotal;
                    ?>
                    <div class="cart_item">
                        <img src="../items/image/<?php echo $row['image']; ?>">
                        <div class="item_info">
                            <p class="cart_item_name"><?php echo $row['name']; ?></p>
                            <p class="cart_item_price">单价：$<?php echo sprintf("%.2f",$row['price']); ?></p>
                            <p class="cart_item_quantity">购买数量：<?php echo $item['quantity']; ?></p>
                            <p class="cart_item_subtotal">小计：$<?php echo sprintf("%.2f",$subtotal); ?></p>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>
        <div id="total_price">
            <p id="total_price_title">总计：</p>
            <p id="total_price_num">$<?php echo sprintf("%.2f",$total_price); ?></p>
            <p id="pay">结算</p>
        </div>
    </div>
    <footer>
        <h2>网上购书平台开发小组：洪鑫、邓旺华、徐平平、李志伟、吕成</h2>
    </footer>
    </body>
</html>
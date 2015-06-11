/**
 * Created by Hugh on 2015/6/9 0009.
 */

$(function(){
    $(".plus").click(function () {
        plus_quantity($(this));
    });
    $(".minus").click(function () {
        minus_quantity($(this));
    });
    $(".purchase_quantity").mousedown(function () {
        quantity_value = parseInt($(this).val());
    });
    $(".purchase_quantity").change(function () {
        validate_text_change($(this));
    });
    $(".add_to_cart").click(function () {
        go_cart($(this));
        $("#success_hint").stop(true,true);
        $("#success_hint").fadeIn(300);
        $("#success_hint").fadeOut(5000);

    });
    $("#cart").click(function () {
        save_cart_to_cookie();
        window.location = "cart.php";
    });
});

var quantity_value = 1;
var shop_cart = new cart();

function plus_quantity(plus_btn){
    var quantity = $(plus_btn).siblings(".purchase_quantity").first();
    var total_amount = parseInt($(plus_btn).parent().first().parent().first().find(".item_number").text());
    var after_quantity = parseInt(quantity.val())+1;
    if(after_quantity <= total_amount)
        quantity.val(after_quantity);
    else
        alert("购买数量不可超过库存！");
}
function minus_quantity(minus_btn){
    var quantity = $(minus_btn).siblings(".purchase_quantity").first();
    var after_quantity = parseInt(quantity.val())-1;
    if(after_quantity >= 1)
        quantity.val(after_quantity);
    else
        alert("购买数量不可小于1！");
}
function validate_text_change(text){
    var text_val = parseInt(text.val());
    if(text_val!=text.val()){
        text.val(quantity_value);
        alert("请输入数字");
    }else{
        var total_amount = parseInt($(text).parent().first().parent().first().find(".item_number").text());
        if (text_val>total_amount){
            alert("购买数量不可超过库存！");
            text.val(total_amount);
        }else if(text_val<1){
            alert("购买数量不可小于1！");
            text.val(quantity_value);
        }
    }
}
function go_cart(cart_btn){
    var item_id = $(cart_btn).siblings(".item_id").first().text();
    var quantity = $(cart_btn).siblings(".quality_chooser").first().find(".purchase_quantity").first().val();
    var i = new item(item_id,parseInt(quantity));
    shop_cart.add_to_cart(i);
}

function save_cart_to_cookie(){
    var items = shop_cart.get_items();
    if (items.length != 0){
        var json_str = JSON.stringify(items);
        $.cookie('cart_json', json_str, { expires: 7, path: '/' });
    }
}
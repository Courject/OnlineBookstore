/**
 * Created by Hugh on 2015/6/8 0008.
 */
function login_check(name,password) {
    $.ajax({
        url: "login/login_check.php",
        data: "name="+name+"&password="+password,
        dataType: "text",
        type:"post",
        error: submit_fail,
        success: function(identity){
            if (identity == "false"){
                alert("用户名或密码错误！");
            }else {
                redirect(identity);
            }
        }
    });
}
function submit_fail(){
    alert("信息提交到服务器失败");
}
function check(){
    var name=document.getElementById("name").value;
    var password=document.getElementById("password").value;
    if(name==""||password==""){
        alert("用户名或密码不能为空！");
    }
    else{
        login_check(name,password);
    }
}
function redirect(identity) {
    var form = document.getElementById("login_form");
    switch (identity){
        case "0":
            form.action = "buyer/shop-list.php";
            break;
        case "1":
            form.action = "shopkeeper/shopkeeper.php";
            break;
        case "2":
            form.action = "system_manager/system_manager.php";
            break;
    }
    form.submit();
}
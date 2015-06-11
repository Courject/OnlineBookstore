/**
 * Created by Hugh on 2015/6/9 0009.
 */
function person_obj(){
    this.name = "";
    this.password = "";
    this.gender = "";
    this.age = 1;
    this.email = "";
    this.tel = "";
}

var person = new person_obj();

$(function () {
    add_age_options()
    $("#button_submit").click(function () {
        register();
    });
});

function add_age_options(){
    var select = $("#age");

    var option = $("<option value=''></option>");
    select.append(option);
    for (var i=1; i<=150; i++){
        var option = $("<option value=''+i >"+i+"</option>");
        select.append(option);
    }
}

function check(){
    person.name = $("#name").val();
    if ($("#password").val() == $("#ensure_password").val())
        person.password = $("#password").val();
    else
        alert()
    person.gender = $("#gender").val();
    person.age = parseInt($("#age option:selected").text());
    person.email = $("#email").val();
    person.tel = $("#tel").val();

    var txt = "";
    for (var x in person){
        txt += person[x];
        txt += " ";
    }
    alert(txt);
    return true;
}
function register(){
    if(check()){

    }
}
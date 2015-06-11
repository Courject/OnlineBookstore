/**
 * Created by Hugh on 2015/6/8 0008.
 */
$(function () {
    $("#logout").click(function () {
        window.location="/Practice/OnlineBookstore/";
        $.cookie('name',null);
    });
});
/**
 * Created by Hugh on 2015/6/8 0008.
 */


// Object cart
function cart(){
    var items = new Array();
    this.add_to_cart = function (item) {
        var added = 0;
        for (var x in items){
            if (items[x].item_id == item.item_id){
                items[x].quantity += item.quantity;
                added = 1;
                break;
            }
        }
        if (added == 0){
            items.push(item);
        }
    }
    this.get_items = function () {
        return items;
    }
    this.set_items_from_cookie = function () {
        items = JSON.parse($.cookie('cart_json'));
    }
}

// Object item
function item(item_id,quantity){
    this.item_id = item_id;
    this.quantity = quantity;
}




window.load=doShowAll();

function doShowAll() {

        var key = "";
        var list = "<tr><th>Item</th><th>Value</th></tr>\n";
        var i = 0;

        for (i = 0; i <= localStorage.length-1; i++) {
            key = localStorage.key(i);
            list += "<tr><td>" + key + "</td>\n<td>"
                + localStorage.getItem(key) + "</td></tr>\n";
        }
        if (list == "<tr><th>Item</th><th>Value</th></tr>\n") {
            list += "<tr><td><i>empty</i></td>\n<td><i>empty</i></td></tr>\n";
        }

        document.getElementById('list').innerHTML = list;

}
function SaveItem() {

    var name = document.forms.ShoppingList.name.value;
    var data = document.forms.ShoppingList.data.value;
    localStorage.setItem(name, data);
    doShowAll();

}
function ModifyItem() {
    var name1 = document.forms.ShoppingList.name.value;
    var data1 = document.forms.ShoppingList.data.value;
    //check if name1 is already exists

    if (localStorage.getItem(name1) !=null)
    {
        localStorage.setItem(name1,data1);
        document.forms.ShoppingList.data.value = localStorage.getItem(name1);
    }

    doShowAll();
}
function RemoveItem()
{
    var name=document.forms.ShoppingList.name.value;
    document.forms.ShoppingList.data.value=localStorage.removeItem(name);
    doShowAll();
}
function ClearAll() {
    localStorage.clear();
    doShowAll();
}
//Customer info
//You can use array in addition to object.
var obj1 = { firstname: "John", lastname: "thomson" };
var cust = JSON.stringify(obj1);

//Mailing info
var obj2 = { state: "VA", city: "Arlington" };
var mail = JSON.stringify(obj2);

//Item info
var obj3 = { item: "milk", quantity: 2 };
var basket = JSON.stringify(obj3);

//Next, push three strings into key-value of HTML5 storage.

//Use JSON parse function below to convert string back into object or array.
var New_cust=JSON.parse(cust);



/**
 * Created by dupuytom on 20/01/17.
 */

function getWindowWidth() {
    var windowWidth=0;
    if (typeof(window.innerWidth)=='number') {
        windowWidth=window.innerWidth;
    } else {
        if (document.documentElement&& document.documentElement.clientWidth) {
            windowWidth = document.documentElement.clientWidth;
        } else {
            if (document.body&&document.body.clientWidth) {
                windowWidth=document.body.clientWidth;
            }
        }
    }
    return windowWidth;
};

var addEvent = function(object, type, callback) {
    if (object == null || typeof(object) == 'undefined') return;
    if (object.addEventListener) {
        object.addEventListener(type, callback, false);
    } else if (object.attachEvent) {
        object.attachEvent("on" + type, callback);
    } else {
        object["on"+type] = callback;
    }
};

function paddingProductTable() {
    var windowWidth = getWindowWidth();
    console.log(windowWidth);
    if (windowWidth>480) {
        var productTablePaddingLeft=((windowWidth-200)%250)/2;
        var productTable = document.getElementById("product-table");
        productTable.style.paddingLeft = productTablePaddingLeft+"px";
    } else {
        console.log('Mobile size')
        productTable.style.paddingLeft ="0px";
    }
}

paddingProductTable();
addEvent(window, "resize", function(event) {
    console.log('resized');
    paddingProductTable();
});
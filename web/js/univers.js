/**
 * Created by dupuytom on 20/01/17.
 */



/**Centrage du tableau des produits**/

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
    /*console.log(windowWidth);*/
    if (windowWidth>480) {
        var nbProduct = $(".product-holder li").length;
        var maxProductOnLine=Math.floor((windowWidth-200)/250);
        var ProductOnLine= Math.min(nbProduct, maxProductOnLine);/*
        console.log("////////////////////");
        console.log("windowWidth : "+windowWidth);
        console.log("250*ProductOnLine : "+250*ProductOnLine);
        console.log("nbProduct : "+nbProduct);
        console.log("maxProductOnLine : "+maxProductOnLine);
        console.log("ProductOnLine : "+ProductOnLine);*/
        var productTablePaddingLeft=((windowWidth-200-10)-ProductOnLine*250)/2;
        var productTable = document.getElementById("section-product-table");
        productTable.style.paddingLeft = productTablePaddingLeft+"px";
    } else {
        var productTable = document.getElementById("section-product-table");
        productTable.style.paddingLeft ="0px";
    }
}

/**Detection scroll -> positionnement sidebar**/

function estVisible(id_element){
    /**
     * elementVisible.yMax -> bandeauBottom
     * cadreVisible.yMin -> windowTop
     * **/
    var source = document.getElementById(id_element), sourceParent = source.offsetParent;

    var bandeauBottom, bandeauTop, windowTop;


    windowTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
    bandeauTop = source.offsetTop;
    while(sourceParent) {
        bandeauTop += sourceParent.offsetTop;
        sourceParent = sourceParent.offsetParent;
    }
    bandeauBottom = bandeauTop + source.offsetHeight;
    /*Prise en compte de la topbar de 51px*/
    windowTop += 51;


    var bandeauVisible= bandeauBottom-windowTop;
    /*console.log(bandeauVisible);*/
    if (bandeauVisible>0) {
        return(bandeauVisible);
    } else {
        return(0);
    }
}


function ScrollSideBar () {
    var windowWidth = getWindowWidth();
    var sidebar = document.getElementById("sidebar");
    if(windowWidth>480) {
        var bandeauVisible = estVisible('universe-bandeau');
        if (bandeauVisible>0) {
            /*console.log('scroll, bandeau visible');*/
            sidebar.style.position = 'fixed';
            sidebar.style.paddingTop=(bandeauVisible+90)+'px';
        } else {
            /*console.log('scroll, bandeau non visible');*/
            sidebar.style.position = 'fixed';
            sidebar.style.paddingTop='90px';
        }
    } else {
        sidebar.style.position = 'relative';
        sidebar.style.paddingTop='30px';
    }
}



function ResizeUniverseTitle() {
    var universeTitle=document.getElementById("universe-name");
    var bandeauHeigh=universeTitle.offsetHeight;
    var windowWidth=getWindowWidth();
    var ratio=bandeauHeigh/windowWidth;
    console.log("ratio avant: "+ratio);
    if (ratio>0.2) {
        var size=4;
        universeTitle.style.fontSize=size+"vw";
        bandeauHeigh=universeTitle.offsetHeight;
        ratio=bandeauHeigh/windowWidth;
        console.log("size : "+size+" ; ratio : "+ratio);
        do {
            size+=1;
            universeTitle.style.fontSize=(size+1)+"vw";
            bandeauHeigh=universeTitle.offsetHeight;
            ratio=bandeauHeigh/windowWidth;
            console.log("size : "+size+" ; ratio : "+ratio);
        } while (ratio < 0.14 );
        universeTitle.style.fontSize=size+"vw";
    }

}

/** Event listener **/

window.onload = function () {
    /*console.log('onload');*/
    paddingProductTable();
    ScrollSideBar();
    ResizeUniverseTitle();
};


addEvent(window, "resize", function(event) {
    /*console.log('resized');*/
    paddingProductTable();
    ScrollSideBar();
});


window.addEventListener("scroll", function(){
    /*console.log('scroll');*/
    ScrollSideBar();
});



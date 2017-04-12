/**
 * Created by cam2 on 12/04/17.
 */
var panier = JSON.parse(window.localStorage.getItem('panier'));
if(panier != null){
    panier = null;
    window.localStorage.setItem('panier', JSON.stringify(panier));
}
$.post(refresh_route, { panier: JSON.parse(window.localStorage.getItem('panier')) })
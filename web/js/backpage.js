/**
 * Created by cam2 on 15/05/17.
 */

if(document.getElementById("backpage") != null)
{
    document.getElementById("backpage").href = JSON.parse(window.localStorage.getItem('backpage'));
}
else
{
    window.localStorage.setItem('backpage', JSON.stringify(window.location.href ));
}
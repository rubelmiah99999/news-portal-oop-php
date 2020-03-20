var cookie = navigator.cookieEnabled;
//cookie is true if cookies are enabled
if(cookie == true) {
    setCookie("enabled", "true", 0);
} else {
    setCookie("enabled", "false", 0);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
} 

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0){
            var v = c.substring(name.length, c.length);
            alert(cname + " = " + v);
            return c.substring(v);
        }
    }
    return "";
}

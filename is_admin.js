function check_admin()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText!="system_admins")
                {
                    document.getElementById("bdy").innerHTML.innerHTML ='<meta http-equiv = "refresh" content = "3; url = login_page.html" />';;
                }
                
            }
        };
    xmlhttp.open("GET","check_user_cat.php?",true);
    xmlhttp.send();
}      
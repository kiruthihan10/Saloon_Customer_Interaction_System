function check_login()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                if (this.responseText=="0")
                {
                    document.getElementById("bdy").innerHTML ='<meta http-equiv = "refresh" content = "3; url = login_page.html" />';;
                }
                
            }
        };
    xmlhttp.open("GET","check_auth.php?",true);
    xmlhttp.send();
}

function check_admin()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText!="system_admins")
                {
                    document.getElementById("bdy").innerHTML ='<meta http-equiv = "refresh" content = "3; url = login_page.html" />';;
                }
                
            }
        };
    xmlhttp.open("GET","check_user_cat.php?",true);
    xmlhttp.send();
}

function check_customer()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText!="customer")
                {
                    document.getElementById("bdy").innerHTML ='<meta http-equiv = "refresh" content = "3; url = login_page.html" />';;
                }
                
            }
        };
    xmlhttp.open("GET","check_user_cat.php?",true);
    xmlhttp.send();
}

function check_employee()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText!="employee")
                {
                    document.getElementById("bdy").innerHTML ='<meta http-equiv = "refresh" content = "3; url = login_page.html" />';;
                }
                
            }
        };
    xmlhttp.open("GET","check_user_cat.php?",true);
    xmlhttp.send();
}

function check_emp_or_cust()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText!="customer" && this.responseText!="employee")
                {
                    document.getElementById("bdy").innerHTML ='<meta http-equiv = "refresh" content = "3; url = login_page.html" />';;
                }
                
            }
        };
    xmlhttp.open("GET","check_user_cat.php?",true);
    xmlhttp.send();
} 

function nav()
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText=="system_admins")
                {
                    document.getElementById("topnav").innerHTML ='<a class="active" href="admin_menu.html">Home</a><a href="saloon_payment.html">Payment</a><a href="employee_update.html">Password</a><a href="employee_data_view.html">Employee</a><a href="change_details.html">Personal</a><a href="saloon_signup.html">Saloon</a><a href="admin_signup.html">Admin</a>';
                }
                else if(this.responseText=="customer")
                {
                    document.getElementById("topnav").innerHTML = '<a class="active" href="customer_menu.html">Home</a><a href="make_appointment.html">New!</a><a href="upcoming_appointment.html">Upcoming</a><a href="change_details.html">Personal</a><a href="View_past_appointments.html">Past</a>'
                }

                else if(this.responseText=="employee")
                {
                    document.getElementById("topnav").innerHTML = '<a class="active" href="Employee_interface.html">Home</a><a href="upcoming_appointment.html">Upcoming</a><a href="change_details.html">Personal</a><a href="employee_signup.html">New Employee</a>'
                }
                
            }
        };
    xmlhttp.open("GET","check_user_cat.php?",true);
    xmlhttp.send();
}
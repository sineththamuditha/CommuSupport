<body>
<link rel="stylesheet" href="/CommuSupport/public/CSS/navbar/sidenav-styles.css">
<link rel="stylesheet" href="/CommuSupport/public/CSS/navbar/main-styles.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="/CommuSupport/public/CSS/charts/charts.css">
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

<div class="sidenav">
    <div class="logo_content">
        <div class="logo">
            <img src="/CommuSupport/public/src/navlogo/CMS_Admin.svg" alt="" class="logo_name">
        </div>
<!--        <i class="material-icons" id="btn">menu</i>-->
    </div>
    <ul class="nav_list">
        <li>
            <a href="/CommuSupport/admin/requests">
                <i class="material-icons">summarize</i>
                <span class="links_name">Requests</span>
            </a>
<!--            <span class="tooltip">Requests</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/events">
                <i class="material-icons">today</i>
                <span class="links_name">Events</span>
            </a>
<!--            <span class="tooltip">Events</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/donations">
                <i class="material-icons">inventory_2</i>
                <span class="links_name">Donations</span>
            </a>
<!--            <span class="tooltip">Donations</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/complaints">
                <i class="material-icons">report_gmailerrorred</i>
                <span class="links_name">Complaints</span>
            </a>
<!--            <span class="tooltip">Complaints</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/donees">
                <i class="material-icons">emoji_people</i>
                <span class="links_name">Donees</span>
            </a>
<!--            <span class="tooltip">Donees</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/donors">
                <i class="material-icons">accessibility_new</i>
                <span class="links_name">Donors</span>
            </a>
<!--            <span class="tooltip">Donors</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/drivers">
                <i class="material-icons">local_shipping</i>
                <span class="links_name">Drivers</span>
            </a>
<!--            <span class="tooltip">Drivers</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/employees">
                <i class="material-icons">badge</i>
                <span class="links_name">Employees</span>
            </a>
<!--            <span class="tooltip">Employees</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/communitycenters">
                <i class="material-icons">emoji_transportation</i>
                <span class="links_name">Community Centers</span>
            </a>
<!--            <span class="tooltip">Community Centers</span>-->
        </li>
        <li>
            <a href="/CommuSupport/admin/communityheadoffices">
                <i class="material-icons">home_work</i>
                <span class="links_name">Community Head Offices</span>
            </a>
<!--            <span class="tooltip">Community Head Offices</span>-->
        </li>

    </ul>
    <div class="logout">
        <form method="post" action="/CommuSupport/logout"><button><i class="material-icons" id="log_out">power_settings_new</i></button></form>
    </div>
</div>
<div class="main">
    {content}
</div>

<script src="/CommuSupport/public/JS/navbar/sidebar-scripts.js"></script>
</body>
</html>


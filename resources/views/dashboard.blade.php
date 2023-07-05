<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Votre sonnette virtuel connecté</title>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/responsive.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    
    <div class="ShellDashboard">

        <div class="ShellDashboard__sidebar">

            <div class="ShellDashboard__sidebar-header">
                <div class="ShellDashboard__sidebar-header-title">ESONNETTE</div>
            </div>
            <div class="ShellDashboard__sidebar-content">
                
                <ul class="SidebarContent__navigation">
                    <li class="SidebarContent__navigation-element">Dashboard</li>
                    <li class="SidebarContent__navigation-element">Mes propriétés</li>
                    <li class="SidebarContent__navigation-element">Mes QRCodes</li>
                    <li class="SidebarContent__navigation-element">Déconnexion</li>
                </ul>

            </div>

        </div>
        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <ul class="ContentHeader__navigation">
                    <li class="ContentHeader__navigation-element">Mon profil</li>
                    <li class="ContentHeader__navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
                </ul>

            </div>
            <div class="ShellDashboard__content-body">TEST DASHBOARD</div>

        </div>

    </div>

</body>
</html>
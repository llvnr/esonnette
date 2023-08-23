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
                <img src="{{ asset("assets/images/logo.png") }}" width="150" class="ShellDashboard__sidebar-header-title" />
            </div>
            <div class="ShellDashboard__sidebar-content">
                
                <ul class="SidebarContent__navigation">
                    <a href="/" class="noDecor"><li class="SidebarContent__navigation-element">Dashboard</li></a>
                    <a href="/propriete" class="noDecor"><li class="SidebarContent__navigation-element">Mes propriétés</li></a>
                    <a href="/parametres" class="noDecor"><li class="SidebarContent__navigation-element">Paramètres</li></a>
                    <a href="/" class="noDecor"><li class="SidebarContent__navigation-element">Déconnexion</li></a>
                </ul>

            </div>

        </div>
        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <div class="ContentHeader">

                    <div class="ContentHeader__colonneLeft">
                        <div class="ContentHeader__colonneLeft-title">DASHBOARD</div>
                    </div>
                    <div class="ContentHeader__colonneRight">

                        <ul class="ContentHeader__colonneRight-navigation">
                            <a href="/profil" class="noDecor"><li class="ContentHeader__colonneRight-navigation-element">Mon profil</li></a>
                            <li class="ContentHeader__colonneRight-navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
                        </ul>

                    </div>

                </div>

            </div>
            <div class="ShellDashboard__content-body">

                <div class="ContentBody__row">

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-title">Content de vous revoir !</div>
                        <div class="ContentBody__row-card-infos">
                            Ici vous pouvez voir toutes les données importantes en un seul endroit !
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">10</div>
                        <div class="ContentBody__row-card-title">Utilisateurs</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'utilisateurs qui gère cette instance.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">5</div>
                        <div class="ContentBody__row-card-title">Propriétés</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre de propriétés associé à cette instance.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">15</div>
                        <div class="ContentBody__row-card-title">Visite(s) totale(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre de visite reçu sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">25</div>
                        <div class="ContentBody__row-card-title">Visite(s) manqué(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre de visite manqué sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">35</div>
                        <div class="ContentBody__row-card-title">Alerte(s) email(s)</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'alertes par email envoyées sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">45</div>
                        <div class="ContentBody__row-card-title">Alerte(s) discord</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'alertes discord envoyés sur l'ensemble des propriétés.
                        </div>
                    </div>

                    <div class="ContentBody__row-card">
                        <div class="ContentBody__row-card-counter">55</div>
                        <div class="ContentBody__row-card-title">Alerte(s) SMS</div>
                        <div class="ContentBody__row-card-infos">
                            Comptabilise le nombre d'alertes SMS envoyés sur l'ensemble des propriétés.
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil - Votre sonnette virtuel connecté</title>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/responsive.css") }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    
    <div class="ShellDashboard">

        <div class="ShellDashboard__sidebar">

            <div class="ShellDashboard__sidebar-header">
                <div class="ShellDashboard__sidebar-header-title">YAKK</div>
            </div>
            <div class="ShellDashboard__sidebar-content">
                
                <ul class="SidebarContent__navigation">
                    <a href="/" class="noDecor"><li class="SidebarContent__navigation-element">Dashboard</li></a>
                    <a href="/propriete" class="noDecor"><li class="SidebarContent__navigation-element">Mes propriétés</li></a>
                    <a href="/qrcode" class="noDecor"><li class="SidebarContent__navigation-element">Mes QRCodes</li></a>
                    <a href="/" class="noDecor"><li class="SidebarContent__navigation-element">Déconnexion</li></a>
                </ul>

            </div>

        </div>
        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <div class="ContentHeader">

                    <div class="ContentHeader__colonneLeft">
                        <div class="ContentHeader__colonneLeft-title">PROFIL</div>
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

                <div class="ContentBody">

                    <div class="ContentBody__colonneUn">

                        <div class="ContentBody__colonneUn-label-username">Nom d'utilisateur *</div>
                        <input type="text" class="ContentBody__colonneUn-input-username" placeholder="Nom d'utilisateur">
    
                        <button class="ContentBody__colonneUn-btnmdf">Modifier</button>

                    </div>
                    <div class="ContentBody__colonneDeux">
    
                        <div class="ContentBody__colonneDeux-label-email">Adresse email * <small class="ContentBody__colonneDeux-confirmation account-status-success">Non confirmé</small></div>
                        <input type="email" class="ContentBody__colonneDeux-input-email" placeholder="Votre adresse email">
    
                        <button class="ContentBody__colonneDeux-btnmdf">Modifier</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
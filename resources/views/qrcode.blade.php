<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes QRCodes - Votre sonnette virtuel connecté</title>
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
                        <div class="ContentHeader__colonneLeft-title">MES QRCODES</div>
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

                <div class="ContentBodyQrcode">

                    @for ($i = 0; $i < 15; $i++)
                        <div class="cardQrCode">

                            <div class="cardQrCode__label-id">1</div>
                            <div class="cardQrCode__label-image"><img src="https://img.icons8.com/?size=40&id=13019&format=png" alt=""></div>
                            <div class="cardQrCode__label-adresse">56 Bis chemin du ruisseau 97421 La rivière</div>
                            <div class="cardQrCode__label-statut">Actif</div>
                            <div class="cardQrCode__label-visitetotal">3 Visite(s) totale(s)</div>
                            <div class="cardQrCode__label-visitemanquer">2 Visite(s) manqué</div>

                        </div>
                    @endfor

                    {{-- <div class="ContentBodyQrcode__colonneUn">
                        <button class="ContentBodyQrcode__colonneUn-btnPropriete">Nouveau</button>
                    </div>
                    <div class="ContentBodyQrcode__colonneDeux">
                        

                        
                    </div> --}}

                </div>

            </div>

        </div>

    </div>

</body>
</html>
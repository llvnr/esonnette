<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle propriété - Votre sonnette virtuel connecté</title>
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
                    <a href="/" class="noDecor"><li class="SidebarContent__navigation-element">Déconnexion</li></a>
                </ul>

            </div>

        </div>
        <div class="ShellDashboard__content">

            <div class="ShellDashboard__content-header">

                <div class="ContentHeader">

                    <div class="ContentHeader__colonneLeft">
                        <div class="ContentHeader__colonneLeft-title">VOIR UNE PROPRIETE</div>
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

                <div class="ContentBodyVoirPropriete">

                    <div class="ContentBodyVoirPropriete__content">
                        <div class="ContentBodyVoirPropriete__content-colonneUn">

                            <div class="ContentColonneUn__label-image">
                                <img src="https://img.icons8.com/?size=100&id=np6r5nc6uNNj&format=png" alt="">
                            </div>
                            <div class="ContentColonneUn__label-content">
                                <div class="ContentColonneUn__label-fullname">Ludovic LEVENEUR</div>
                                <div class="ContentColonneUn__label-adresse">56 bis chemin du ruisseau</div>
                                <div class="ContentColonneUn__label-codepostal">97421</div>
                                <div class="ContentColonneUn__label-ville">La rivière</div>
                            </div>

                        </div>
                        <div class="ContentBodyVoirPropriete__content-colonneDeux">

                            <div class="ContentColonneDeux__label-visite-total"><b>3</b> Visite(s) totale(s)</div>
                            <div class="ContentColonneDeux__label-visite-manquer"><b>2</b> Visite(s) manqué</div>
                            <button class="ContentColonneDeux__btn-enableqr">Activer le QrCode</button>
                            <button class="ContentColonneDeux__btn-disableqr">Désactiver le QrCode</button>

                        </div>
                    </div>


                    {{-- <div class="ContentBodyADDPropriete__label-name">Nom du propriétaire</div>

                    <div class="ContentBodyADDPropriete__label-surname">Prénom du propriétaire</div>

                    <div class="ContentBodyADDPropriete__label-type">Type de propriété</div>
                    
                    <div class="ContentBodyADDPropriete__label-adresse">Adresse de la propriété</div>

                    <div class="ContentBodyADDPropriete__label-codepostal">Code postal</div>

                    <div class="ContentBodyADDPropriete__label-ville">Ville</div> --}}

                </div>

            </div>

        </div>

    </div>

</body>
</html>
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
                <div class="ShellDashboard__sidebar-header-title">YAKK</div>
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

                <div class="ContentHeader">

                    <div class="ContentHeader__colonneLeft">
                        <div class="ContentHeader__colonneLeft-title">AJOUTER UNE PROPRIETE</div>
                    </div>
                    <div class="ContentHeader__colonneRight">

                        <ul class="ContentHeader__colonneRight-navigation">
                            <li class="ContentHeader__colonneRight-navigation-element">Mon profil</li>
                            <li class="ContentHeader__colonneRight-navigation-element"><i class="bi bi-brightness-high-fill"></i></li>
                        </ul>

                    </div>

                </div>

            </div>
            <div class="ShellDashboard__content-body">

                <div class="ContentBodyADDPropriete">

                    <div class="ContentBodyADDPropriete__label-name">Nom du propriétaire</div>
                    <input type="text" class="ContentBodyADDPropriete__input-name" placeholder="Nom du propriétaire">

                    <div class="ContentBodyADDPropriete__label-surname">Prénom du propriétaire</div>
                    <input type="text" class="ContentBodyADDPropriete__input-surname" placeholder="Prénom du propriétaire">

                    <div class="ContentBodyADDPropriete__label-type">Type de propriété</div>
                    <select class="ContentBodyADDPropriete__select-type">
                        <option value="Maison">Maison</option>
                        <option value="Appartement">Appartement</option>
                    </select>

                    <div class="ContentBodyADDPropriete__label-adresse">Adresse de la propriété</div>
                    <input type="text" class="ContentBodyADDPropriete__input-adresse" placeholder="Adresse de la propriété">

                    <div class="ContentBodyADDPropriete__label-codepostal">Code postal</div>
                    <input type="text" class="ContentBodyADDPropriete__input-codepostal" placeholder="Code postal">

                    <div class="ContentBodyADDPropriete__label-ville">Ville</div>
                    <input type="text" class="ContentBodyADDPropriete__input-ville" placeholder="Ville">

                    <button class="ContentBodyADDPropriete__btnadd">Créer</button>


                </div>

            </div>

        </div>

    </div>

</body>
</html>
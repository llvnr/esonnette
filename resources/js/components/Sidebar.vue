<template>

    <div class="ShellDashboard__sidebar">

        <div class="ShellDashboard__sidebar-header">
            <img src="assets/images/logo.png" width="150" class="ShellDashboard__sidebar-header-title" />
        </div>
        <div class="ShellDashboard__sidebar-content">
            
            <ul class="SidebarContent__navigation">
                <router-link to="/" class="noDecor"><li class="SidebarContent__navigation-element">Dashboard</li></router-link>
                <router-link to="/propriete" class="noDecor"><li class="SidebarContent__navigation-element">Mes propriétés</li></router-link>
                <router-link to="/qrcodeditor" class="noDecor"><li class="SidebarContent__navigation-element">Editeur QRCode</li></router-link>
                <router-link to="/connexion" class="noDecor"><li class="SidebarContent__navigation-element">Connexion</li></router-link>
                <router-link to="/inscription" class="noDecor"><li class="SidebarContent__navigation-element">Inscription</li></router-link>
                <router-link to="/" class="noDecor"><li class="SidebarContent__navigation-element">Déconnexion</li></router-link>
            </ul>

        </div>

    </div>

</template>
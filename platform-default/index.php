<!DOCTYPE html>
<html>
<? include 'head.php'; ?>
<body>
    <header>
        <div class="logo bx">
            <h1>Solo Automotoras</h1>
        </div>
        <div id="login-form" class="loginhead">   
            <h3>Ingreso</h3>
            <div class="lgninput">
                <label>Usuario</label>
                <input name="usr" id="login-username" type="text">
            </div>
            <div class="lgninput">
                <label>Clave</label>
                <input name="pwd" id="login-password" type="password">
            </div>
            <div class="lgninput butt"><button onclick="session.login()">Ingresar</button></div>
            <span id="login-message-error" class="error"></span>
            <!--registrate aqui-->
            <div class="regishere">
                <span class="btn" onclick="guest.addVisitanteForm()">REGISTRATE</span>
            </div>
        </div>
    </header>
    <nav>
        <div id="menu-container" class="bx">
        </div>
    </nav>
    <div class="wrap bx cf" id="all_content">
        <div id="catalogo-resultados">
        </div>
        <div id="search-container">
        </div>
    </div>
    <footer>
        <div class="bx">
            www.SoloAutomotoras.cl 2013
        </div>
    </footer>
    
    <? /*                 * ******* para llamadas fancybox ********* */ ?>
    <a id="autostartfancybox" style="display:none" href="#"></a>
    
</body>
</html>
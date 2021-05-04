<!--



<style>
    .admin-add-visitante{
        font-family:Verdana;
        font-size:13px;
        width: 300px;
    }
</style>

<div class="admin-add-visitante">
    <p><b>Registro</b></p><br/>

    <span>Email</span>
    <p><input type="text" id="visitante-email"><p/>
    
    <span>Contraseña</span>
    <p><input type="password" id="visitante-password"><p/>
    
    <span>Repetir Contraseña</span>
    <p><input type="password" id="visitante-password-rep"><p/>
    
    <span>Nombre</span>
    <p><input type="text" id="visitante-nombre"><p/>

    <span>Apellido Paterno</span>
    <p><input type="text" id="visitante-apellidopaterno"><p/>
    
    <span>Apellido Materno</span>
    <p><input type="text" id="visitante-apellidomaterno"><p/>
    
    <span>Rut</span>
    <p><input type="text" id="visitante-rut"><p/>
</div>

<span class="btn rgt" onclick="guest.addVisitante()">Registrarse</span>
<span class="btn rgt" onclick="$.fancybox.close()">Cancelar</span>-->





<div class="registrouser">
    <h3>¡Registráte!</h3>
    <div class="benef">
        <div>
            <img src="include/img/cotizar_registro.jpg">
            <h2>Consulta directamente con las automotoras</h2>
            <p>Podrás consultar directamente con la automotora cualquier aviso publicado por ella.</p>
        </div>
        <div>
            <img src="include/img/ofertasaviso_registro.jpg">
            <h2>Busca una sóla vez, nosotros te avisamos</h2>
            <p>Si buscas y no encuentras un auto que te interese, nosotros te avisamos cuando exista un aviso que se ajuste a tu interés.</p>
        </div>
        <div>
            <img src="include/img/fav_registro.jpg">
            <h2>Avisos Favoritos</h2>
            <p>Los avisos que más te interesen podrás agregarlos a tus favoritos, así podrás llegar a ellos rápidamente y compararlos.</p>
        </div>
        <div>
            <img src="include/img/compartir_registro.jpg">
            <h2>Comparte un aviso</h2>
            <p>Si encuentras un auto que le puede interesar a un amigo o un familiar, compartelo con él.</p>
        </div>
    </div>
    <div class="formreg">       
        <label>
            <strong>Email</strong>
            <input id="visitante-email" type="text">
        </label>
        
        <label>
            <strong>Contraseña</strong>
            <input id="visitante-password" type="password">
        </label>

        <label>
            <strong>Repetir Contraseña</strong>
            <input id="visitante-password-rep" type="password">
        </label>

        <label>
            <strong>Nombre</strong>
            <input id="visitante-nombre" type="text">
        </label>

        <label>
            <strong>Apellido Paterno</strong>
            <input id="visitante-apellidopaterno" type="text">
        </label>

        <label>
            <strong>Apellido Materno</strong>
            <input id="visitante-apellidomaterno" type="text">
        </label>

        <label>
            <strong>Rut</strong>
            <input id="visitante-rut" type="text">
        </label>

        <div class="regbtns">
            <span class="btn rgt" onclick="guest.addVisitante()">Registrarse</span>
            <span class="btn rgt" onclick="$.fancybox.close()">Cancelar</span>
        </div>
    </div>
</div>
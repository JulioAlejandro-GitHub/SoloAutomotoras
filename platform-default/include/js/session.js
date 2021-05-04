
var session = new Session({
    path                :       '',
    container_login     : $("#login-form"),
    message_error       : $("#login-message-error"),      
    username            : $("#login-username"),      
    password            : $("#login-password"),
    loaderLogin         : new Loader({
        container       : $("#login-form"),
        containerClear  : false,
        containerStyle  : "position:relative; top:-53px;"
    }),
    onLogin             : function() {
        menu.drawMenu();
        search.getAutomotoras();
        search.goCatalog();
    },
    onLogout            : function() {
        menu.drawMenu();
        $("#search-container").show();
        search.getAutomotoras();
        search.guestview = null;
        search.goCatalog();
    }
});

session.init();
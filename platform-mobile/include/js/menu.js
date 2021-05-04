
var menu = new Menu({
    path      : '',
    file      : 'app/comun/menu.php',
    container : $('#menu-container'),
    results   : $('#catalogo-resultados'),
    menu      : [
        { 
            object  : $("#menu-search-view-block"), 
            action  : function() {
                $("#search-container").show();
                search.goView('block');
                $("#menu-search-view-block").addClass('selctd');
                $("#menu-search-view-list").removeClass('selctd');
            }
        },
        {
            object  : $("#menu-search-view-list"),
            action  : function() {
                $("#search-container").show();
                search.goView('list');
                $("#menu-search-view-block").removeClass('selctd');
                $("#menu-search-view-list").addClass('selctd');
            }
        },
        {
            object  : $("#menu-admin-automotora"),
            action  : function() {
                $("#search-container").hide();
                menu.goAutomotora();
            }
        },
        {
            object  : $("#menu-admin-search-guestview-block"),
            action  : function() {
                $("#search-container").show();
                search.goGuestView('block');
            }
        },
        {
            object  : $("#menu-admin-search-guestview-list"),
            action  : function() {
                $("#search-container").show();
                search.goGuestView('list');
            }
        }
    ]
});

menu.init();
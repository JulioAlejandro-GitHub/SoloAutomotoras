<head>
    <title>El sitio de Automotoras</title>
    <meta charset="utf-8">
    
    <!-- jquery -->
    <script type="text/javascript" src="include/js/jquery-latest.js"></script>

    <!-- jqueryUI -->
    <script type="text/javascript" src="include/js/jquery-ui-1.10.3/ui/minified/jquery-ui.min.js"></script>
    <link type="text/css" href="include/js/jquery-ui-1.10.3/themes/base/minified/jquery-ui.min.css" media="screen" rel="stylesheet" />
    
    <!-- jquery form -->
    <script type="text/javascript" src="include/js/jquery.form.js"></script>
    <link rel="stylesheet" href="include/css/form.css" />

    <!-- jquery jscroll -->
    <script type="text/javascript" src="include/js/jquery.jscroll.min.js"></script>
    
    <!-- fancybox -->
    <script type="text/javascript" src="include/js/fancybox/jquery.fancybox-1.3.4.js"></script>
    <link type="text/css" href="include/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" rel="stylesheet" />

    <!-- uploader -->
    <script type="text/javascript" src="include/js/uploader/fileuploader.js"></script>
    <link type="text/css" href="include/js/uploader/fileuploader.css" media="screen" rel="stylesheet" />

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="include/css/main.css">
    <link rel="stylesheet" type="text/css" href="include/css/gallery.css" />
    <!--<link rel="stylesheet" type="text/css" href="include/css/backend.css">-->
    <link rel="stylesheet" type="text/css" href="include/css/adm.css">
    <link rel="stylesheet" type="text/css" href="include/css/login.css">
    
    <!-- custom js -->
    <script type="text/javascript" src="include/js/ach.js"></script>
    <script type="text/javascript" src="include/js/contador.js"></script>
    <script type="text/javascript" src="include/js/loader/heartcode-canvasloader-min.js"></script>    
    
    <script type="text/javascript" src="include/js/loader/class.loader.js"></script>
    <link rel="stylesheet" type="text/css" href="include/js/loader/class.loader.css">
    <script type="text/javascript" src="include/js/class.ajax.js"></script>
    <script type="text/javascript" src="include/js/class.automotora.js"></script>
    <script type="text/javascript" src="include/js/class.search.js"></script>
    <script type="text/javascript" src="include/js/class.admin.js"></script>
    <script type="text/javascript" src="include/js/class.user.js"></script>
    <script type="text/javascript" src="include/js/class.guest.js"></script>
    <script type="text/javascript" src="include/js/class.session.js"></script>
    <script type="text/javascript" src="include/js/class.menu.js"></script>
   
    <!-- google maps -->
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            var automotora = new Automotora({
                path    : '',
                section : [
                    { 
                        file       : 'app/comun/formlogin.php',
                        container  : $("#login-form")
                    },
                    { 
                        file       : 'app/comun/menu.php',
                        container  : $("#menu-container")
                    },
                    { 
                        file       : 'app/comun/buscador.php',
                        container  : $("#search-container")
                    }
                ]            
            });
                automotora.init();
        });
    </script>
    
    
    <script>
    var fancyboxOptions =
    {
        transitionIn		:	'fade',
        transitionOut		:	'fade',
        scrolling		:	'no',
        autoDimensions		:	true,
        centerOnScroll		:	true,
        showCloseButton		:	true,
        enableEscapeButton	:	true,
        hideOnOverlayClick	: 	false,
        hideOnContentClick	:	false
    }
    </script>
    
    
    <? /* #############################################  google-analytics.com  ########################################### */ ?>

    
    
</head>
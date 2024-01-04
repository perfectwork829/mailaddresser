/**
Core script to handle the entire theme and core functions
**/
var Layout = function() {

    var layoutImgPath = 'admin/layout5/img/';

    var layoutCssPath = 'admin/layout5/css/';

    var resBreakpointMd = Metronic.getResponsiveBreakpoint('md');

    // handle on page scroll
    var handleHeaderOnScroll = function() {
        if ($(window).scrollTop() > 60) {
            $("body").addClass("page-on-scroll");
        } else {
            $("body").removeClass("page-on-scroll");
        }
    }
    
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#submit_form');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);
            $.validator.addMethod("greaterThan", function (value, element, param) {
                var fromValue = parseInt(value);
                var toValue = parseInt($('#age_from').val());
                console.log('form validation1', fromValue);
                console.log('form validation2', toValue);
                return fromValue > toValue;
            }, "The 'from' age must be greater than the 'to' age.");

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input    
                errorPlacement: function(error, element) {
                    // This function specifies where to place the error message
                    error.appendTo(".age_validation"); // Replace #errorContainer with the ID of the container where you want to display the error message
                    $(".age_validation").show();
                },           
                rules: {
                    'filters[age][to]': {
                        number: true,
                        required: true,
                        'greaterThan': "filters[age][from]"
                    },
                    'filters[age][from]': {
                        required: true,                        
                        number: true
                    }                    
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    $(".age_validation").hide();
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                }
            });


    }

    // Handles active menu to avoid closing click to content

    // handle go to top button
    var handleGo2Top = function () {       
        var Go2TopOperation = function(){
            var CurrentWindowPosition = $(window).scrollTop();// current vertical position
            if (CurrentWindowPosition > 100) {
                $(".go2top").show();
            } else {
                $(".go2top").hide();
            }
        };

        Go2TopOperation();// call headerFix() when the page was loaded
        if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
            $(window).bind("touchend touchcancel touchleave", function(e){
                Go2TopOperation();
            });
        } else {
            $(window).scroll(function() {
                Go2TopOperation();
            });
        }

        $(".go2top").click(function(e) {
            e.preventDefault();
             $("html, body").animate({ scrollTop: 0 }, 600);
        });
    };

    var handleHeaderMenu = function() {
        $('.page-header .navbar-nav > .dropdown-fw, .page-header .navbar-nav > .more-dropdown, .page-header .navbar-nav > .dropdown > .dropdown-menu  > .dropdown').click(function(e) {
            
            if (Metronic.getViewPort().width > resBreakpointMd) {
                if ($(this).hasClass('more-dropdown') || $(this).hasClass('more-dropdown-sub')) {
                    return;
                } else {
                     e.stopPropagation();
                }
            } else {
                e.stopPropagation();
            }
            
            var links = $(this).parent().find('> .dropdown');

            if (Metronic.getViewPort().width < resBreakpointMd) {
                if ($(this).hasClass('open')) {
                    links.removeClass('open');
                } else {
                    links.removeClass('open');
                    $(this).addClass('open');
                    Metronic.scrollTo($(this));
                }
            } else {
                if ($(this).hasClass('more-dropdown'))  {
                    return;
                }
                links.removeClass('open');
                $(this).addClass('open');
                Metronic.scrollTo($(this));
            }
        });

        $('.page-header .navbar-nav .more-dropdown-sub .dropdown-menu, .page-header .navbar-nav .dropdown-sub .dropdown-menu').click(function(){

        });
    };

    // Handles main menu on window resize
    var handleMainMenuOnResize = function() {
        // handle hover dropdown menu for desktop devices only
        var width = Metronic.getViewPort().width;
        var menu = $(".page-header .navbar-nav");
        if (width >= resBreakpointMd && menu.data('breakpoint') !== 'desktop') { 
            menu.data('breakpoint', 'desktop');
            $('[data-hover="extended-dropdown"]', menu).not('.hover-initialized').each(function() { 
                $(this).dropdownHover(); 
                $(this).addClass('hover-initialized'); 
            });
        } else if (width < resBreakpointMd && menu.data('breakpoint') !== 'mobile') {
            menu.data('breakpoint', 'mobile');
            // disable hover bootstrap dropdowns plugin
            $('[data-hover="extended-dropdown"].hover-initialized', menu).each(function() {   
                $(this).unbind('hover');
                $(this).parent().unbind('hover').find('.dropdown-submenu').each(function() {
                    $(this).unbind('hover');
                });
                $(this).removeClass('hover-initialized');    
            });
        }
    };

    return {

        // Main init methods to initialize the layout
        // IMPORTANT!!!: Do not modify the core handlers call order.

        init: function () {            
            handleGo2Top();
            handleHeaderOnScroll();
            handleHeaderMenu();
            handleMainMenuOnResize();
            handleValidation1();
            Metronic.addResizeHandler(handleMainMenuOnResize); // handle main menu on window resize

            // handle minimized header on page scroll
            $(window).scroll(function() {
                handleHeaderOnScroll();
            });
        },

        getLayoutImgPath: function() {
            return Metronic.getAssetsPath() + layoutImgPath;
        },

        getLayoutCssPath: function() {
            return Metronic.getAssetsPath() + layoutCssPath;
        }
    };

}();
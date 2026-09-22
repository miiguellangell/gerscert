(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	var toggleSidebar = function () {
		$('#sidebar').toggleClass('active');
		$('body').toggleClass('sidebar-open');
	};

	$('#sidebarCollapse').on('click', function () {
		toggleSidebar();
	});

	$('#sidebarBackdrop').on('click', function () {
		if ($('body').hasClass('sidebar-open')) {
			toggleSidebar();
		}
	});

	$('#sidebar a').on('click', function () {
		if ($(window).width() < 992 && $('body').hasClass('sidebar-open')) {
			toggleSidebar();
		}
	});

})(jQuery);

const section = $('#main-container'),
  navLinks = $('.nav-link');

$(window).on('load', () => {
	navLinks.each(function() { $(this).removeClass('active'); })
	if (section.hasClass('all-posts')) link(1);
	else if (section.hasClass('add-post')) link(2);
	else if (section.hasClass('all-users')) link(3);
	else if (section.hasClass('add-user')) link(4);
	else if (section.hasClass('view-profile')) link(5);

	function link(idx) { navLinks.eq(idx).addClass('active'); } 
});

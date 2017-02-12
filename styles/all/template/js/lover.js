(function($) {  // Avoid conflicts with other libraries

"use strict";

phpbb.addAjaxCallback('toggle_love', function(data) {
	if (data.toggle_action === 'add')
	{
		$('#likeimg_' + data.toggle_post).removeClass('like').addClass('liked');
		$('#likethis_' + data.toggle_post).removeClass('likebyu').addClass('likedbyu');
		$('#likedthis_' + data.toggle_post).removeClass('ulike').addClass('uliked');
		$('#like_' + data.toggle_post).text('You liked this!');
	}
	else
	{
		$('#likeimg_' + data.toggle_post).removeClass('liked').addClass('like');
		$('#likethis_' + data.toggle_post).removeClass('likedbyu').addClass('likebyu');
		$('#likedthis_' + data.toggle_post).removeClass('uliked').addClass('ulike');
		$('#like_' + data.toggle_post).text('You no longer like this post.');
	}
});

})(jQuery); // Avoid conflicts with other libraries

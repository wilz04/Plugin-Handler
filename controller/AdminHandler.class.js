/**
 * @alias Index.class
 * @author WilC <wilz04@gmail.com>
 * @since 2012
 */
var AdminHandler = {
	
	init: function (sender, e) {
		var removeLink = '<a class="remove" href="#" onclick="return AdminHandler.onRemoveClick($(this), event)">Remove</a>';
		$('a.add').relCopy({append: removeLink});
	},
	
	onRemoveClick: function (sender, e) {
		sender.parent().slideUp(AdminHandler.remove);
		return false;
	},
	
	remove: function () {
		$(this).remove();
	}
	
};

(function(exports, $, bb) {
	$(function() {
		var $window, $body, $document;
		$window = $(window);
		$document = $(document);
		$body = $("body");
	});

	window.Robot = Backbone.Model.extend({urlRoot: "/api/robots", defaults: {"id": null, "name": "", "type": "", "year": ""}});
	window.RobotCollection = Backbone.Collection.extend({model: Robot, url: "/api/robots", parse: function(response) {
			return response.data;
		}});

	window.RobotCollectionView = Backbone.View.extend({el: "#robotList", template: _.template($("#details").html()), initialize: function() {
			var self = this;
			self.coll = new RobotCollection;
			self.coll.comparator = function(model) {
				return-(new Date(model.get("created_at"))).getTime();
			};
			self.coll.fetch({success: function() {
					self.coll.sort();
					self.render();
				}});
		}, render: function() {
			this.$el.html(this.template({robots: this.coll.toJSON()}));
			return this;
		}});
	var AppRouter = Backbone.Router.extend({routes: {"": "list"}, list: function() {
			new RobotCollectionView;
		}});
	var app = new AppRouter;
	Backbone.history.start();
})(this, jQuery, Backbone);
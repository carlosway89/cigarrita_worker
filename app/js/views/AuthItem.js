define(
['text!/templates/AuthItem.php',
'views/AuthItem-item',
'models/AuthItem',
'collections/AuthItem',
'beans',
'channel'],
function(tmpl,AuthItemItem,AuthItemModel,AuthItemCollection,Beans,Channel) {
return Backbone.View.extend({
	template: Handlebars.compile(tmpl),
	beans: new Beans,
	debug: true,
	tagName:'div',
	className: '',
	events: {},
	initialize: function(){},
	show_AuthItem: function() {
		var that=this;
		var div=that.$el.find('#AuthItem');
		that.beans.preloader(div);
		that.collection = new AuthItemCollection();
		that.collection.fetch({
			success: function(model,result,options){
				setTimeout(function(){
					$.each(model.models,function(item,model){
						var view = new AuthItemItem({model:model});
						div.append( view.render().el );
					});
					that.beans.generate_data_table('ListAuthItem');
					div.parent().find('.preloader-div').remove();
 				},200);
			},
			error: function(model,xhr,options){
				console.log(xhr);
			}
		});
	},
	render: function() {
		this.$el.html( Handlebars.compile( tmpl)(this));
		this.show_AuthItem();
		return this;
	}
});
});
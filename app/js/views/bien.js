define(
['text!/templates/bien.php',
'views/bien-item',
'models/bien',
'collections/bien',
'beans',
'channel'],
function(tmpl,bienItem,bienModel,bienCollection,Beans,Channel) {
return Backbone.View.extend({
	template: Handlebars.compile(tmpl),
	beans: new Beans,
	debug: true,
	tagName:'div',
	className: '',
	events: {},
	initialize: function(){},
	show_bien: function() {
		var that=this;
		var div=that.$el.find('#bien');
		that.collection = new bienCollection();
		that.collection.fetch({
			success: function(model,result,options){
				setTimeout(function(){
					$.each(model.models,function(item,model){
						var view = new bienItem({model:model});
						div.append( view.render().el );
					});
					that.beans.generate_data_table('Listbien');
 				},200);
			},
			error: function(model,xhr,options){
				console.log(xhr);
			}
		});
	},
	render: function() {
		this.$el.html( Handlebars.compile( tmpl)(this));
		this.show_bien();
		return this;
	}
});
});
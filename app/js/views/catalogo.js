define(
['text!/templates/catalogo.php',
'views/catalogo-item',
'models/catalogo',
'collections/catalogo',
'beans',
'channel'],
function(tmpl,catalogoItem,catalogoModel,catalogoCollection,Beans,Channel) {
return Backbone.View.extend({
	template: Handlebars.compile(tmpl),
	beans: new Beans,
	debug: true,
	tagName:'div',
	className: '',
	events: {},
	initialize: function(){},
	show_catalogo: function() {
		var that=this;
		var div=that.$el.find('#catalogo');
		that.collection = new catalogoCollection();
		that.collection.fetch({
			success: function(model,result,options){
				setTimeout(function(){
					$.each(model.models,function(item,model){
						var view = new catalogoItem({model:model});
						div.append( view.render().el );
					});
					that.beans.generate_data_table('Listcatalogo');
 				},200);
			},
			error: function(model,xhr,options){
				console.log(xhr);
			}
		});
	},
	render: function() {
		this.$el.html( Handlebars.compile( tmpl)(this));
		this.show_catalogo();
		return this;
	}
});
});
define(
['text!/templates/area.php',
'views/area-item',
'models/area',
'collections/area',
'beans',
'channel'],
function(tmpl,areaItem,areaModel,areaCollection,Beans,Channel) {
return Backbone.View.extend({
	template: Handlebars.compile(tmpl),
	beans: new Beans,
	debug: true,
	tagName:'div',
	className: '',
	events: {},
	initialize: function(){},
	show_area: function() {
		var that=this;
		var div=that.$el.find('#area');
		that.beans.preloader(div);
		that.collection = new areaCollection();
		that.collection.fetch({
			success: function(model,result,options){
				setTimeout(function(){
					$.each(model.models,function(item,model){
						var view = new areaItem({model:model});
						div.append( view.render().el );
					});
					that.beans.generate_data_table('Listarea');
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
		this.show_area();
		return this;
	}
});
});
define(
['text!/templates/catalogo-item.php','beans','channel'],function(tmpl,Beans,Channel) {
return Backbone.View.extend({
	template: Handlebars.compile(tmpl),
	beans: new Beans,
	debug: true,
	tagName:'tr',
	events: {
		'click .delete':'delete'
	},
	delete:function(e){
		console.log('Delete item ID:',this.IDCATALOGO());
		var that = this;
        e=e?e:window.event;
        e.preventDefault();
        // check with user
        var result = confirm('Delete Item?');
            if (result){
             
                that.model.destroy({
                    success: function(model,response,options){
                        that.remove();
                    },
                    error: function(model,response,options){
                    	console.log(response);
                    }
                });
            }
        
        return false;
	},
	initialize: function(){},
	IDCATALOGO:function(){ return this.model.get('IDCATALOGO')?this.model.get('IDCATALOGO'):'null'; },
	CAT_descripcion:function(){ return this.model.get('CAT_descripcion')?this.model.get('CAT_descripcion'):'null'; },
	CAT_codigo:function(){ return this.model.get('CAT_codigo')?this.model.get('CAT_codigo'):'null'; },
	CAT_unidad:function(){ return this.model.get('CAT_unidad')?this.model.get('CAT_unidad'):'null'; },
	CAT_existencia:function(){ return this.model.get('CAT_existencia')?this.model.get('CAT_existencia'):'null'; },
	render: function() {
		this.$el.html( Handlebars.compile( tmpl)(this));
		return this;
	}
});
});
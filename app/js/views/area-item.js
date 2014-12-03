define(
['text!/templates/area-item.php','beans','channel'],function(tmpl,Beans,Channel) {
return Backbone.View.extend({
	template: Handlebars.compile(tmpl),
	beans: new Beans,
	debug: true,
	tagName:'tr',
	events: {
		'click .delete':'delete'
	},
	delete:function(e){
		var that = this;
        e=e?e:window.event;
        e.preventDefault();
        // check with user
        var result = confirm('Delete Item?');
            if (result){
             	that.model.set({id:that.model.attributes.IDUSUARIO});
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
	IDAREA:function(){ return this.model.get('IDAREA')?this.model.get('IDAREA'):'null'; },
	ARE_codigo:function(){ return this.model.get('ARE_codigo')?this.model.get('ARE_codigo'):'null'; },
	ARE_nombre:function(){ return this.model.get('ARE_nombre')?this.model.get('ARE_nombre'):'null'; },
	render: function() {
		this.$el.html( Handlebars.compile( tmpl)(this));
		return this;
	}
});
});
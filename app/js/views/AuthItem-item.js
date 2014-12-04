define(
['text!/templates/AuthItem-item.php','beans','channel'],function(tmpl,Beans,Channel) {
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
             	that.model.set({id:that.model.attributes.name});
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
	name:function(){ return this.model.get('name')?this.model.get('name'):'null'; },
	type:function(){ return this.model.get('type')?this.model.get('type'):'null'; },
	description:function(){ return this.model.get('description')?this.model.get('description'):'null'; },
	bizrule:function(){ return this.model.get('bizrule')?this.model.get('bizrule'):'null'; },
	data:function(){ return this.model.get('data')?this.model.get('data'):'null'; },
	render: function() {
		this.$el.html( Handlebars.compile( tmpl)(this));
		return this;
	}
});
});
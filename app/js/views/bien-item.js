define(
['text!/templates/bien-item.php','beans','channel'],function(tmpl,Beans,Channel) {
return Backbone.View.extend({
	template: Handlebars.compile(tmpl),
	beans: new Beans,
	debug: true,
	tagName:'tr',
	events: {},
	initialize: function(){},
	IDBIEN:function(){ return this.model.get('IDBIEN')?this.model.get('IDBIEN'):'null'; },
	BIE_stockActual:function(){ return this.model.get('BIE_stockActual')?this.model.get('BIE_stockActual'):'null'; },
	BIE_stockMinimo:function(){ return this.model.get('BIE_stockMinimo')?this.model.get('BIE_stockMinimo'):'null'; },
	BIE_caracteristica:function(){ return this.model.get('BIE_caracteristica')?this.model.get('BIE_caracteristica'):'null'; },
	BIE_marca:function(){ return this.model.get('BIE_marca')?this.model.get('BIE_marca'):'null'; },
	IDCATALOGO:function(){ return this.model.get('IDCATALOGO')?this.model.get('IDCATALOGO'):'null'; },
	render: function() {
		this.$el.html( Handlebars.compile( tmpl)(this));
		return this;
	}
});
});
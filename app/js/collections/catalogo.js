define(['models/catalogo'],function (Model) {
  				    return Backbone.Collection.extend({
  				        url: function(){
  				            return 'api/index/catalogo';
  				        },
  				        limit: 0,
  				        model: Model,
  				        defaults: {
  				            id: 1
  				        },
  				        initialize: function(){
  		
  				        }
  				    });
  				});
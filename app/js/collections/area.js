define(['models/area'],function (Model) {
  				    return Backbone.Collection.extend({
  				        url: function(){
  				            return 'api/index/area';
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
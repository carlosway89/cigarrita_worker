define(['models/bien'],function (Model) {
  				    return Backbone.Collection.extend({
  				        url: function(){
  				            return 'api/index/bien';
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
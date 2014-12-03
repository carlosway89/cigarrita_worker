define(['models/AuthItem'],function (Model) {
  				    return Backbone.Collection.extend({
  				        url: function(){
  				            return 'api/index/AuthItem';
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
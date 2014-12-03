 define([
     'router',
     'globals',
     'beans',
     'channel'
     ], function(AppRouter,Globals,Beans,Channel){
     var initialize = function(){
         var beans = new Beans;
         var debug = false;
         var $this = this;

        AppRouter.initialize();
            
        
    };
     return {
         initialize: initialize
     };
     // What we return here will be used by other modules
});
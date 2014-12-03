// Filename: router.js
 define([
     'beans',
     'views/home',
     'views/bien',
     'models/parse',
     'channel'
     ], function(
        Beans,
        Home,
        ParseModel,
        Channel
     ){
        var AppRouter = Backbone.Router.extend({
            beans: new Beans,
            debug: true,
            routes: {
                'home': 'home',   // default page reload to home
            },


            home: function(){

                /**
                 * Send a clear-last-view event to Channel, so that any view can clean
                 * up after itself
                 */
            
                    var view = new Home({
                        el: $('div.view-container')
                    });

                    
            },


        });
        var initialize = function(){

                /**
                 * Now that we've loaded both APIs, we can proceed to begin routing...
                 */
                var app_router = new AppRouter;
                
                app_router.on('route:defaultAction', function(actions){

                    /**
                     * We don't know this view, so show a 404
                     */
                    require(['views/four-oh-four'],function(FourOhFour){

                        var $div = $('div.view-container');
                        $div.addClass( 'container-message container');

                        new FourOhFour({
                            el: $div
                        });

                    });

                });

                /**
                 * Set default route
                 */
                if ( ! window.location.hash.length ) window.location.hash = '#home';
                Backbone.history.start();

     };
 return {
     initialize: initialize
    };
 });
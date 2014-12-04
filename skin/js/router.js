 define([
     'beans',
     'channel'
     ], function(
        Beans,
        Channel
     ){
        var AppRouter = Backbone.Router.extend({
            beans: new Beans,
            debug: true,
            routes: {
                '{{table}}': '{{table}}',
                '{{table}}_new': '{{table}}_new',
                '{{table}}/:id': '{{table}}_edit',
                'welcome':'welcome'
            },
            welcome: function(){
                /**
                 * Send a clear-last-view event to Channel, so that any view can clean
                 * up after itself
                 */

                require(['views/welcome'],function(welcome){
                    var view = new welcome({
                        el: $('body')
                    });

                    view.render();
                });           
            },
            table_edit: function(id){
                /**
                 * Send a clear-last-view event to Channel, so that any view can clean
                 * up after itself
                 */
                require(['views/table-edit-form'],function(table){
                    var view = new table({
                        el: $('div.view-container'),
                        id:id
                    });

                    // view.render();
                });                           
            },
            table_new: function(){
                /**
                 * Send a clear-last-view event to Channel, so that any view can clean
                 * up after itself
                 */
                require(['views/table-new-form'],function(table){
                    var view = new table({
                        el: $('div.view-container'),
                    });

                    view.render();
                });                           
            },
            table: function(){
                /**
                 * Send a clear-last-view event to Channel, so that any view can clean
                 * up after itself
                 */
                require(['views/table'],function(table){
                    var view = new table({
                        el: $('div.view-container')
                    });

                    view.render();
                });           
            }
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
                if ( ! window.location.hash.length ) window.location.hash = '#welcome';
                Backbone.history.start();
     };
 return {
     initialize: initialize
    };
 });
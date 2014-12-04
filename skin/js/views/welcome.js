define([
    'text!/templates/welcome.php'
],
    function(tmpl) {
        return Backbone.View.extend({
            template: Handlebars.compile(tmpl),
            events: {
            },
            initialize: function() {
                this.render();
            },
            render: function() {
                this.$el.html( Handlebars.compile( tmpl)(this));
                return this;
            }
        });
    }
);

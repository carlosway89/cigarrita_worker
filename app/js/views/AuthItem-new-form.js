define([
			    'text!/templates/AuthItem-new-form.php',
			    'channel',
			    'models/AuthItem'
			],
			    function(tmpl,Channel,Model) {
			        return Backbone.View.extend({

			            // toggle debugging
			            debug: false,

			            // jQuery Events
			            events: {
			                'submit':'save_model'
			            },
			            initialize: function( options ) {

			                // Normalize...
			                options = typeof(options)!='undefined'?options:{};

			            },

			            render: function() {

			                var that = this;

			                this.$el.html( Handlebars.compile( tmpl)(this));

			                
			                return this;
			            },

			            /**             *
			             * @returns {*} JSON of data from Form
			             */
			            get_data: function(){

			                data = {};

			                this.$el.find('.form-values').each(function(){

			                    data[ $(this).attr('id')] = $(this).val();

			                });
			                return data;
			            },

			            /**
			             * Save Model, using form values
			             */
			            save_model: function(event){

			            	event.preventDefault();

			                this.model = new Model;

			                this.model.save( this.get_data(),{

			                    success: function(model,result,options){


			                    }
			                })
			            }
			        });
			    }
			);
			
define([
			    'text!/templates/AuthItem-edit-form.php',
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

			                var that=this;
				            this.model=new Model({id:options.id})

				            this.model.fetch({
				            	success:function(){
				            		that.render();
				            	},
				            	error:function(){
				            	}
				            });
			            },
			            render: function() {

			                var that = this;

			                this.$el.html( Handlebars.compile( tmpl)(this));

			                
			                return this;
			            },	name:function(){ return this.model.get('name')?this.model.get('name'):'null'; },
	type:function(){ return this.model.get('type')?this.model.get('type'):'null'; },
	description:function(){ return this.model.get('description')?this.model.get('description'):'null'; },
	bizrule:function(){ return this.model.get('bizrule')?this.model.get('bizrule'):'null'; },
	data:function(){ return this.model.get('data')?this.model.get('data'):'null'; },

			            /***
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
			            	event.stopPropagation();

			                this.model.save( this.get_data(),{

			                    success: function(model,result,options){


			                    }
			                });
							
			            }
			        });
			    }
			);
			
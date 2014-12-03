<?php 

include('config.php');

class generator_model{


	private $el='$el';

	public $host=DB_HOST_M;
	public $user=DB_USER_M;
	public $password=DB_PASS_M;
	public $database=DB_NAME_M;

	public $message;




	public function __construct() {
		// echo 'hello';
		// Conectando, seleccionando la base de datos
		if (!mysql_connect($this->host, $this->user, $this->password)) {
		    echo 'No se pudo conectar a mysql';
		    exit;
		}
		mysql_select_db($this->database) or die('No se pudo seleccionar la base de datos');

  	}

  	public function model($table){

  		$model="define([],function () {
	        return Backbone.Model.extend({
	            defaults: {
	            },
	            urlRoot: 'api/index/".$table."',
	            initialize: function () {
	            }
	        });
		});";

		return $model;
  	}
  	public function collection($table){

  		$collection="define(['models/".$table."'],function (Model) {
  				    return Backbone.Collection.extend({
  				        url: function(){
  				            return 'api/index/".$table."';
  				        },
  				        limit: 0,
  				        model: Model,
  				        defaults: {
  				            id: 1
  				        },
  				        initialize: function(){
  		
  				        }
  				    });
  				});";

		return $collection;
  	}

  	public function model_js($items,$table){

		$model_javascript="define(\n['text!/templates/".$table.".php',\n'views/".$table."-item',\n'models/".$table."',\n'collections/".$table."',\n'beans',\n'channel'],\n".
		    "function(tmpl,".$table."Item,".$table."Model,".$table."Collection,Beans,Channel) {\n".
		        "return Backbone.View.extend({\n".
		            "\ttemplate: Handlebars.compile(tmpl),\n".
		            "\tbeans: new Beans,\n".
		            "\tdebug: true,\n".
		            "\ttagName:'div',\n".
		            "\tclassName: '',\n".
		            "\tevents: {},\n".
		            "\tinitialize: function(){},\n";
		$model_javascript=$model_javascript."\tshow_$table: function() {\n".
		                "\t\tvar that=this;\n".
              			"\t\tvar div=that.$this->el.find('#".$table."');\n".
						"\t\tthat.beans.preloader(div);\n".
              			"\t\tthat.collection = new ".$table."Collection();\n".              
			              "\t\tthat.collection.fetch({\n".
			                  "\t\t\tsuccess: function(model,result,options){\n".
			                     "\t\t\t\tsetTimeout(function(){\n".
			                        "\t\t\t\t\t$.each(model.models,function(item,model){\n".
			                            "\t\t\t\t\t\tvar view = new ".$table."Item({model:model});\n".
			                            "\t\t\t\t\t\tdiv.append( view.render().el );\n".
			                        "\t\t\t\t\t});\n".
			                        "\t\t\t\t\tthat.beans.generate_data_table('List".$table."');\n". 
			                        "\t\t\t\t\tdiv.parent().find('.preloader-div').remove();\n".                
			                    " \t\t\t\t},200);\n".               
			                  "\t\t\t},\n".
			                  "\t\t\terror: function(model,xhr,options){\n".
			                      "\t\t\t\tconsole.log(xhr);\n".
			                  "\t\t\t}\n\t\t});\n".
		    			"\t},\n";

		$model_javascript=$model_javascript."\trender: function() {\n".
		                "\t\tthis.$this->el.html( Handlebars.compile( tmpl)(this));\n".
		                "\t\tthis.show_$table();\n".
		                "\t\treturn this;\n\t}\n".
		    "});\n});";

		return $model_javascript;
	
	}

	public function model_item_js($items,$table){

		$model_javascript="define(\n['text!/templates/".$table."-item.php','beans','channel'],".
		    "function(tmpl,Beans,Channel) {\n".
		        "return Backbone.View.extend({\n".
		            "\ttemplate: Handlebars.compile(tmpl),\n".
		            "\tbeans: new Beans,\n".
		            "\tdebug: true,\n".
		            "\ttagName:'tr',\n".
		            "\tevents: {\n\t\t'click .delete':'delete'\n\t},\n\tdelete:function(e){
		var that = this;
        e=e?e:window.event;
        e.preventDefault();
        // check with user
        var result = confirm('Delete Item?');
            if (result){
             	that.model.set({id:that.model.attributes.$items[0]});
                that.model.destroy({
                    success: function(model,response,options){
                        that.remove();
                    },
                    error: function(model,response,options){
                    	console.log(response);
                    }
                });
            }
        
        return false;
	},\n".
		            "\tinitialize: function(){},\n";

		            foreach ($items as $key => $value) {
		            	$model_javascript=$model_javascript."\t$value:function(){ return this.model.get('".$value."')?this.model.get('".$value."'):'null'; },\n";
		            }

		            
		$model_javascript=$model_javascript."\trender: function() {\n".
		                "\t\tthis.$this->el.html( Handlebars.compile( tmpl)(this));\n".
		                "\t\treturn this;\n\t}\n".
		    "});\n});";

		return $model_javascript;
	
	}

	public function new_form_js($items,$table){

		$new_form="define([
			    'text!/templates/$table-new-form.php',
			    'channel',
			    'models/$table'
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

			                this.$this->el.html( Handlebars.compile( tmpl)(this));

			                
			                return this;
			            },

			            /**             *
			             * @returns {*} JSON of data from Form
			             */
			            get_data: function(){

			                data = {};

			                this.$this->el.find('.form-values').each(function(){

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
			";

		return $new_form;
	}

	public function edit_form_js($items,$table){

		$new_form="define([
			    'text!/templates/$table-edit-form.php',
			    'channel',
			    'models/$table'
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

			                this.$this->el.html( Handlebars.compile( tmpl)(this));

			                
			                return this;
			            },";

					foreach ($items as $key => $value) {
		            	$new_form=$new_form."\t$value:function(){ return this.model.get('".$value."')?this.model.get('".$value."'):'null'; },\n";
		            }				

			           $new_form=$new_form."
			            /***
			             * @returns {*} JSON of data from Form
			             */
			            get_data: function(){

			                data = {};

			                this.$this->el.find('.form-values').each(function(){

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
			";

		return $new_form;
	}

	public function model_item_template($items,$table){

		$model_template="";
		
		foreach ($items as $key => $value) {
        	$model_template=$model_template."<td>{{this.$value}}</td>\n";
        }
        $model_template=$model_template."<td><a href='#usuario/{{this.$items[0]}}' class='edit text-success'><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;<a href='#' class='delete text-danger'><i class='glyphicon glyphicon-trash'></i></a></td>\n";

		return $model_template;
	
	}

	public function model_template($items,$table){

		$model_template="<table id='List".$table."' class='table table-bordered'>\n".
      	"\t<thead>\n".
        	"\t\t<tr>\n";
        foreach ($items as $key => $value) {
        	$model_template=$model_template."\t\t\t<th>$value</th>\n";
        } 
        $model_template=$model_template."\t\t\t<th>Options</th>\n\t\t</tr>\n".
      	"\t</thead>\n".
      	"\t<tbody id='".$table."'></tbody>\n".
    	"</table>";
		
		 

		return $model_template;
	
	}
	public function new_form_template($items,$table){

		$new_form="<h3>Create New $table</h3>
			<br>
			<form id='save_form' class='form-horizontal' role='form'>";

			foreach ($items as $key => $value) {
				$new_form=$new_form."
			  <div class='form-group'>
			    <label for='$value' class='col-sm-2 control-label'>$value</label>
			    <div class='col-sm-8'>
			      <input type='text' class='form-control form-values' id='$value' placeholder='Enter $value' required>
			    </div>
			  </div>";
	        }

			$new_form=$new_form."
			  <div class='form-group'>
			    <div class='col-sm-offset-2 col-sm-10'>
			      <button type='submit' class='btn btn-primary'>Guardar</button>
			      <button id='Cancel' type='reset' class='btn btn-default' style='margin-left:20px'>Reset</button>
			    </div>
			  </div>
			</form>";

		return $new_form;
	}

	public function edit_form_template($items,$table){

		$edit_form="<h3>Edit $table</h3>
			<br>
			<form id='edit_form' class='form-horizontal' role='form'>";

			foreach ($items as $key => $value) {
				$edit_form=$edit_form."
			  <div class='form-group'>
			    <label for='$value' class='col-sm-2 control-label'>$value</label>
			    <div class='col-sm-8'>
			      <input type='text' class='form-control form-values' id='$value' placeholder='Enter $value' value='{{this.$value}}' required>
			    </div>
			  </div>";
	        }

			$edit_form=$edit_form."
			  <div class='form-group'>
			    <div class='col-sm-offset-2 col-sm-10'>
			      <button type='submit' class='btn btn-primary'>Editar</button>
			      <button id='Cancel' type='reset' class='btn btn-default' style='margin-left:20px'>Reset</button>
			    </div>
			  </div>
			</form>";

		return $edit_form;
	}

	public function database_table($table){



		
		$column=array();
		// Realizar una consulta MySQL
		$query = 'SELECT * FROM '.$table;
		$result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());


		// $array;
		// Imprimir los resultados en HTML
		
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		    $array=$line;
		}

		foreach ($array as $col=>$val) {
			$column[]= $col;
			// echo $col;
			// echo '<br>';
		}
		
		
		mysql_free_result($result);

		return $column;

		// Cerrar la conexión
		// mysql_close($link);

	}

	public function database_info(){



		$sql = "SHOW TABLES FROM $this->database";
		$resultado = mysql_query($sql);

		if (!$resultado) {
		    echo "Error de BD, no se pudieron listar las tablas\n";
		    echo 'Error MySQL: ' . mysql_error();
		    exit;
		}

		while ($fila = mysql_fetch_row($resultado)) {

			$row[]=$fila[0];
		    // echo "Tabla: {$fila[0]}\n";
		}

		// print_r($row);
		echo json_encode($row);
		mysql_free_result($resultado);
		// echo 'muestra';
	}

	public function creator($model,$type,$app){

		try {

			switch ($type) {
				case 'view-item-js':
					$control = fopen("../../$app/js/views/$model-item.js","w+");
					$this->message="<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/js/views/$model-item.js</b>  se genero correctamente<br>";
					break;
				case 'view-js':
					$control = fopen("../../$app/js/views/$model.js","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/js/views/$model.js</b>  se genero correctamente<br>";
					break;
				case 'item-template':
					$control = fopen("../../$app/templates/$model-item.php","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/templates/$model-item.php</b>  se genero correctamente<br>";
					break;
				case 'model-template':
					$control = fopen("../../$app/templates/$model.php","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/templates/$model.php</b>  se genero correctamente<br>";
					break;
				case 'model':
					$control = fopen("../../$app/js/models/$model.js","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/js/models/$model.js</b>  se genero correctamente<br>";
					break;
				case 'collection':
					$control = fopen("../../$app/js/collections/$model.js","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/js/collections/$model.js</b>  se genero correctamente<br>";
					break;
				case 'new-form-template':
					$control = fopen("../../$app/templates/$model-new-form.php","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/templates/$model-new-form.php</b>  se genero correctamente<br>";
					break;
				case 'new-form-js':
					$control = fopen("../../$app/js/views/$model-new-form.js","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/js/collections/$model-new-form.js</b>  se genero correctamente<br>";
					break;
				case 'edit-form-template':
					$control = fopen("../../$app/templates/$model-edit-form.php","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/templates/$model-edit-form.php</b>  se genero correctamente<br>";
					break;
				case 'edit-form-js':
					$control = fopen("../../$app/js/views/$model-edit-form.js","w+");
					$this->message=$this->message."\n<i class='glyphicon glyphicon-ok text-success'></i> <b>$app/js/collections/$model-edit-form.js</b>  se genero correctamente<br>";
					break;		
				default:
					break;
			}
			
			if($control == false){
			  die("No se ha podido crear el archivo.");
			}
			
		} catch (Exception $e) {
			echo $e;
		}


		return $control;


	}

	public function write($table,$app='cigarrita/app'){

		
		$items=$this->database_table($table);


		$model_content=$this->model_item_js($items,$table);
		$file=$this->creator($table,'view-item-js',$app);
		fputs($file, $model_content);

		$model_content=$this->model_js($items,$table);
		$file=$this->creator($table,'view-js',$app);
		fputs($file, $model_content);

		$model_content=$this->model_item_template($items,$table);
		$file=$this->creator($table,'item-template',$app);
		fputs($file, $model_content);

		$model_content=$this->model_template($items,$table);
		$file=$this->creator($table,'model-template',$app);
		fputs($file, $model_content);


		$model_content=$this->model($table);
		$file=$this->creator($table,'model',$app);
		fputs($file, $model_content);

		$model_content=$this->collection($table);
		$file=$this->creator($table,'collection',$app);
		fputs($file, $model_content);

		$model_content=$this->new_form_template($items,$table);
		$file=$this->creator($table,'new-form-template',$app);
		fputs($file, $model_content);

		$model_content=$this->new_form_js($items,$table);
		$file=$this->creator($table,'new-form-js',$app);
		fputs($file, $model_content);

		$model_content=$this->edit_form_template($items,$table);
		$file=$this->creator($table,'edit-form-template',$app);
		fputs($file, $model_content);

		$model_content=$this->edit_form_js($items,$table);
		$file=$this->creator($table,'edit-form-js',$app);
		fputs($file, $model_content);

		fclose($file);

		echo $this->message;
	}

}

?>

<h3>Edit AuthItem</h3>
			<br>
			<form id='edit_form' class='form-horizontal' role='form'>
			  <div class='form-group'>
			    <label for='name' class='col-sm-2 control-label'>name</label>
			    <div class='col-sm-8'>
			      <input type='text' class='form-control form-values' id='name' placeholder='Enter name' value='{{this.name}}' required>
			    </div>
			  </div>
			  <div class='form-group'>
			    <label for='type' class='col-sm-2 control-label'>type</label>
			    <div class='col-sm-8'>
			      <input type='text' class='form-control form-values' id='type' placeholder='Enter type' value='{{this.type}}' required>
			    </div>
			  </div>
			  <div class='form-group'>
			    <label for='description' class='col-sm-2 control-label'>description</label>
			    <div class='col-sm-8'>
			      <input type='text' class='form-control form-values' id='description' placeholder='Enter description' value='{{this.description}}' required>
			    </div>
			  </div>
			  <div class='form-group'>
			    <label for='bizrule' class='col-sm-2 control-label'>bizrule</label>
			    <div class='col-sm-8'>
			      <input type='text' class='form-control form-values' id='bizrule' placeholder='Enter bizrule' value='{{this.bizrule}}' required>
			    </div>
			  </div>
			  <div class='form-group'>
			    <label for='data' class='col-sm-2 control-label'>data</label>
			    <div class='col-sm-8'>
			      <input type='text' class='form-control form-values' id='data' placeholder='Enter data' value='{{this.data}}' required>
			    </div>
			  </div>
			  <div class='form-group'>
			    <div class='col-sm-offset-2 col-sm-10'>
			      <button type='submit' class='btn btn-primary'>Editar</button>
			      <button id='Cancel' type='reset' class='btn btn-default' style='margin-left:20px'>Reset</button>
			    </div>
			  </div>
			</form>
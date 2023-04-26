	<!-- Expense delete modal -->
					<div id="expense_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Delete Expense ?</h3>
					</div>
					<input type="hidden" value="<?php echo $exp_id; ?>" class="input-block-level"  name="expense_id">
					<div class="modal-body">
					<div class="alert alert-danger">
					<p>Are you sure you want to delete the expense?</p>
					</div>
					</div>
					<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
					<button name="delete_expense" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
					</div>
					</div>
	<!-- Income delete modal -->
					<div id="income_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Delete Income ?</h3>
					</div>
					<input type="hidden" value="<?php echo $inc_id; ?>" class="input-block-level"  name="income_id">
					<div class="modal-body">
					<div class="alert alert-danger">
					<p>Are you sure you want to delete the income?</p>
					</div>
					</div>
					<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
					<button name="delete_income" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
					</div>
					</div>
	<!-- Salary delete modal -->
					<div id="salary_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Delete Employee ?</h3>
					</div>
					<input type="hidden" value="<?php echo $emp_id; ?>" class="input-block-level"  name="salary_id">
					<div class="modal-body">
					<div class="alert alert-danger">
					<p>Are you sure you want to delete the Salary?</p>
					</div>
					</div>
					<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
					<button name="delete_salary" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
					</div>
					</div>
					
	<!-- Category delete modal -->
					<div id="category_delete" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel">Delete Category ?</h3>
					</div>
					<input type="hidden" value="<?php echo $cat_id; ?>" class="input-block-level"  name="category_id">
					<div class="modal-body">
					<div class="alert alert-danger">
					<p>Are you sure you want to delete this Category?</p>
					</div>
					</div>
					<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
					<button name="delete_category" class="btn btn-danger"><i class="icon-check icon-large"></i> Yes</button>
					</div>
					</div>
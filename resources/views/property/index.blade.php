@extends('layouts.main')

@section('content')
<div class="col-md-12">
	<div class="widget">
		<header class="widget-header">
			<h4 class="widget-title">Responsive, Keyboard Navigation</h4>
		</header>
		<hr class="widget-separator">
		<div class="widget-body">
			<div id="responsive-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
				<div class="row">
					<div class="col-sm-6">
						<div class="dataTables_length" id="responsive-datatable_length">
							<label>Show 
								<select name="responsive-datatable_length" aria-controls="responsive-datatable" class="form-control input-sm">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select> entries
							</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div id="responsive-datatable_filter" class="dataTables_filter">
							<!-- <label>Search:
								<input type="search" class="form-control input-sm" placeholder="" aria-controls="responsive-datatable">
							</label> -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div style="position: absolute; height: 1px; width: 0px; overflow: hidden;">
							<input type="text" tabindex="0">
						</div>
						<table id="responsive-datatable" data-plugin="DataTable" data-options="{
									ajax: '../api/json/dataTable.json',
									responsive: true,
									keys: true
								}" class="table table-striped dataTable dtr-inline collapsed" cellspacing="0" width="100%" role="grid" aria-describedby="responsive-datatable_info"	style="width: 100%; position: relative;">
							<thead>
								<tr role="row">
									<th class="sorting_asc" tabindex="0" aria-controls="responsive-datatable" rowspan="1" colspan="1" style="width: 50px;" aria-label="Name: activate to	sort column descending" aria-sort="ascending">Name</th>
									<th class="sorting" tabindex="0" aria-controls="responsive-datatable" rowspan="1" colspan="1" style="width: 68px;" aria-label="Position: activate to sort column ascending">Position</th>
									<th class="sorting" tabindex="0" aria-controls="responsive-datatable" rowspan="1" colspan="1" style="width: 41px;" aria-label="Office: activate to sort column ascending">Office</th>
									<th class="sorting" tabindex="0" aria-controls="responsive-datatable" rowspan="1" colspan="1" style="width: 33px;" aria-label="Extn.: activate to sort column ascending">Extn.</th>
									<th class="sorting" tabindex="0" aria-controls="responsive-datatable" rowspan="1" colspan="1" style="width: 54px;" aria-label="Start date: activate to sort column ascending">Start date</th>
								 	<th class="sorting" tabindex="0" aria-controls="responsive-datatable" rowspan="1" colspan="1" style="width: 50px; display: none;" aria-label="Salary: activate to sort column ascending">Salary</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th rowspan="1" colspan="1">Name</th>
									<th rowspan="1" colspan="1">Position</th>
									<th rowspan="1" colspan="1">Office</th>
									<th rowspan="1" colspan="1">Extn.</th>
									<th rowspan="1" colspan="1">Start date</th>
									<th rowspan="1" colspan="1" style="display: none;">Salary</th>
								</tr>
							</tfoot>
							<tbody>
								<tr role="row" class="odd">
									<td class="sorting_1" tabindex="0">Airi Satou</td>
									<td>Accountant</td>
									<td>Tokyo</td>
									<td>5407</td>
									<td>2008/11/28</td>
									<td style="display: none;">$162,700</td>
								</tr>
								<tr role="row" class="even">
									<td class="sorting_1" tabindex="0">Angelica Ramos</td>
									<td>Chief Executive Officer (CEO)</td>
									<td>London</td>
									<td>5797</td>
									<td>2009/10/09</td>
									<td style="display: none;">$1,200,000</td>
								</tr>
								<tr role="row" class="odd">
									<td class="sorting_1" tabindex="0">Ashton Cox</td>
									<td>Junior Technical Author</td>
									<td>San Francisco</td>
									<td>1562</td>
									<td>2009/01/12</td>
									<td style="display: none;">$86,000</td>
								</tr>
								<tr role="row" class="even">
									<td class="sorting_1" tabindex="0">Bradley Greer</td>
									<td>Software Engineer</td>
									<td>London</td>
									<td>2558</td>
									<td>2012/10/13</td>
									<td style="display: none;">$132,000</td>
								</tr>
								<tr role="row" class="odd">
									<td class="sorting_1" tabindex="0">Brenden Wagner</td>
									<td>Software Engineer</td>
									<td>San Francisco</td>
									<td>1314</td>
									<td>2011/06/07</td>
									<td style="display: none;">$206,850</td>
								</tr>
								<tr role="row" class="even">
									<td class="sorting_1" tabindex="0">Brielle Williamson</td>
									<td>Integration Specialist</td>
									<td>New York</td>
									<td>4804</td>
									<td>2012/12/02</td>
									<td style="display: none;">$372,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="responsive-datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
					</div>
					<div class="col-sm-7">
						<div class="dataTables_paginate paging_simple_numbers" id="responsive-datatable_paginate">
							<ul class="pagination">
								<li class="paginate_button previous disabled" id="responsive-datatable_previous">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="0" tabindex="0">Previous</a>
								</li>
								<li class="paginate_button active">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="1" tabindex="0">1</a>
								</li>
								<li class="paginate_button ">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="2" tabindex="0">2</a>
								</li>
								<li class="paginate_button ">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="3" tabindex="0">3</a>
								</li>
								<li class="paginate_button ">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="4" tabindex="0">4</a>
								</li>
								<li class="paginate_button ">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="5" tabindex="0">5</a>
								</li>
								<li class="paginate_button ">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="6" tabindex="0">6</a>
								</li>
								<li class="paginate_button next" id="responsive-datatable_next">
									<a href="#" aria-controls="responsive-datatable" data-dt-idx="7" tabindex="0">Next</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
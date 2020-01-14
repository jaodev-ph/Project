
  <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"  >

            <div class="container">
            	<div style="margin: 10%;">
            		<h2 class="text-center">ITS BARCODE GENERATOR</h2>
            		<form class="form-horizontal" method="post" action="..\php\its_barcode.php" target="_blank">
            			<div class="form-group">
            				<label class="control-label col-sm-2" for="product">Ip Address:</label>
            				<div class="col-sm-10">
            					<input autocomplete="OFF" type="text" class="form-control" id="product" name="product" maxlength="15" onkeypress="numberOnly(event)">
            				</div>
            			</div>
            			<div class="form-group">
            				<label class="control-label col-sm-2" for="product_id">Name:</label>
            				<div class="col-sm-10">
            					<input autocomplete="OFF" type="text" class="form-control" id="product_id" name="product_id">
            				</div>
            			</div>
            			<div class="form-group">
            				<label class="control-label col-sm-2" for="print_qty">Barcode Quantity</label>
            				<div class="col-sm-10">          
            					<input autocomplete="OFF" type="print_qty" class="form-control" id="print_qty"  name="print_qty">
            				</div>
            			</div>

            			<div class="form-group">
            				<div class="col-sm-offset-2 col-sm-10">
            					<button type="submit" class="btn btn-default">Submit</button>
            				</div>
            			</div>
            		</form>
            	</div>
            </div>
          </div>
        </div>
  </main>

  <script type="text/javascript">
  	function numberOnly(evt){

        var ch = String.fromCharCode(evt.which);

        if(!(/[0-9 || .]/.test(ch)))
        {
          evt.preventDefault();
        }
      }
  </script>



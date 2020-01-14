<main class="mdl-layout__content mdl-color--grey-100">
  <div class="mdl-grid demo-content">
    <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid" name="mainten" >
      <div class="col-md-12">
               <label for="usr">Maintenance</label>
              <select class="form-control" name="maintenance" id="maintenance">
                <option></option>
                <option>Feeder ID</option>
                <option>Feeder Parts</option>
<!--                 <option>Feeder Size</option>
                <option>Feeder Type</option>
                <option>Feeder Plant</option> -->
                
              </select>
      </div>

      <form id="myform">
      <div name="id" id="id" hidden="">
        <?php include_once("../public/imms/feedermaintenanceid.php"); ?>
      </div>
      <div name="plant" id="plant" hidden="">
        
      </div>
      <div name="parts" id="parts" hidden="">
        <?php include_once("../public/imms/feedermaintenanceparts.php"); ?>
      </div>
      <div name="size" id="size" hidden="">
        
      </div>
      <div name="type" id="type" hidden="">
        
      </div>
      </form>
    </div>
  </div>
</main>


<script src="../assets/js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
  
  
  var value = sessionStorage.getItem("mainte")
  
  if (value=="Feeder ID")
  {
    document.getElementById("id").hidden = false;
    document.getElementById("parts").hidden = true;
    document.getElementById("size").hidden = true;
    document.getElementById("type").hidden = true;
    document.getElementById("plant").hidden = true;
  }
  else if (value=="Feeder Size")
  {
    document.getElementById("size").hidden = false;
    document.getElementById("parts").hidden = true;
    document.getElementById("id").hidden = true;
    document.getElementById("type").hidden = true;
    document.getElementById("plant").hidden = true;
  }
  else if (value=="Feeder Type")
  {
    document.getElementById("type").hidden = false;
    document.getElementById("parts").hidden = true;
    document.getElementById("id").hidden = true;
    document.getElementById("size").hidden = true;
    document.getElementById("plant").hidden = true;
  }
  else if (value=="Feeder Parts")
  {
    document.getElementById("parts").hidden = false;
    document.getElementById("size").hidden = true;
    document.getElementById("id").hidden = true;
    document.getElementById("type").hidden = true;
    document.getElementById("plant").hidden = true;
  }
  else if (value=="Feeder Plant")
  {
    document.getElementById("plant").hidden = false;
    document.getElementById("parts").hidden = true;
    document.getElementById("id").hidden = true;
    document.getElementById("type").hidden = true;
    document.getElementById("size").hidden = true;
  }
  
  $("#maintenance").change(function(){
    
    document.getElementById("myform").reset();
    if(document.getElementById("maintenance").value == "Feeder ID")
    {
      sessionStorage.setItem("mainte", document.getElementById("maintenance").value);
      document.getElementById("id").hidden = false;
      document.getElementById("parts").hidden = true;
      document.getElementById("size").hidden = true;
      document.getElementById("type").hidden = true;
      document.getElementById("plant").hidden = true;
      
    }
    else if(document.getElementById("maintenance").value == "Feeder Size")
    {
      sessionStorage.setItem("mainte", document.getElementById("maintenance").value);
      document.getElementById("size").hidden = false;
      document.getElementById("parts").hidden = true;
      document.getElementById("id").hidden = true;
      document.getElementById("type").hidden = true;
      document.getElementById("plant").hidden = true;
      
    }
    else if(document.getElementById("maintenance").value == "Feeder Type")
    {

      sessionStorage.setItem("mainte", document.getElementById("maintenance").value);
      document.getElementById("type").hidden = false;
      document.getElementById("parts").hidden = true;
      document.getElementById("id").hidden = true;
      document.getElementById("size").hidden = true;
      document.getElementById("plant").hidden = true;

    }
    else if(document.getElementById("maintenance").value == "Feeder Parts")
    {
      sessionStorage.setItem("mainte", document.getElementById("maintenance").value);
      document.getElementById("parts").hidden = false;
      document.getElementById("size").hidden = true;
      document.getElementById("id").hidden = true;
      document.getElementById("type").hidden = true;
      document.getElementById("plant").hidden = true;

    }
    else if(document.getElementById("maintenance").value == "Feeder Plant")
    {
      sessionStorage.setItem("mainte", document.getElementById("maintenance").value);
      document.getElementById("plant").hidden = false;
      document.getElementById("parts").hidden = true;
      document.getElementById("id").hidden = true;
      document.getElementById("type").hidden = true;
      document.getElementById("size").hidden = true;

    }


  });

});

</script>

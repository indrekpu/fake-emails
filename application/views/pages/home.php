<script>
    $(document).ready(function(){
        var date = new Date();
        document.getElementById("date_span").innerHTML = date.toString();
    });
</script>
<p style="padding-bottom: 4ex"></p> 
<div style="font-size: 12px;">
    <span>Tänane kuupäev: </span>
    <span id="date_span"></span>
</div>
<div class="container">
    <h1 class="text-center">FAKE EMAILS</h1>
    <h2 class="text-center">Tuvasta võltsitud e-kirjad kiiresti ja mugavalt </h2>

    <p style="padding-bottom: 8ex"></p> 
    <div class="container-fluid">
         <div class="row">

            <div class="col-md-4 col-md-offset-1"><img src="<?php echo base_url(); ?>/assets/img/emails.jpg" class="img-responsive" alt="Fake-emailsiga"></div>
            <div id="home_desc_list" class="col-*-*">
                <p class="text-center">Fake-emailsiga:</p>
                 <ul>
                    <li>tuvasta e-mailide tegelik saatmisaeg</li>
                    <li>tuvasta e-mailide saatmiskoht</li>
                </ul> 
            </div>
        </div>
    </div>

    <p style="padding-bottom: 4ex"></p> 

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-md-offset-1"> Proovi järele kiirelt ja lihtsalt:  </div>
            <div class="col-*-*"> 
                <button id="home_button" onclick="location='analyse'">Vii mind tuvasta!</button>
            </div>      
        </div>
    </div>



</div>


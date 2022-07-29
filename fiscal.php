<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<style type="text/css">

    .myTable{
		border-collapse:collapse;
		border-spacing:0; 
        text-align: center;
        width: 80%;
        margin: 0 auto;
    }
    .myTable td{
        border: 1px solid;
        padding: 5px;
    }

    .myTable th{
        border: 1px solid;
        padding: 5px;
    }

    @media print{
        html, body {
		visibility: hidden;
		height:100vh; 
		margin: 0 !important; 
		padding: 0 !important;
		overflow: hidden;
		}
        .myTable{
            visibility: visible;
            position: absolute;
			border-collapse:collapse;
			border-spacing:0; 
            left: 0;
            top: 0;
            width: 100%;
            margin: 0 auto;
        }
    }

    @page{
        size: auto;
    }

</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Generate Report</h2>
       <div class="block copyblock">
        <?php 
            
            $checkForm = false;

            if (isset($_POST['date1']) && isset($_POST['date2'])) {

                if (empty($_POST['date1']) || empty($_POST['date2'])) {
                   echo "<p style='color:red;text-align:center;'>Field must not be empty.</p>";
                }else if($_POST['date1'] > $_POST['date2']){
                    echo "<p style='color:red;text-align:center;'>Start date must be less than end date.</p>";
                }else{
                    $checkForm = true;
                }

            }



        ?>

         <form action="" method="post">
            <p style="text-align:center;" id="error"></p>
            <table class="form" cellpadding="0" cellspacing="0"> 
                <tr>
                    <td>
                        <label>Start Date</label>
                    </td>
                    <td>
                        <input type="date" onchange="range()" name="date1" id="date1" onblur="emptValid(this.id, 'errdate1')" class="medium" />
                        <small style="display:block;" id="errdate1"></small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>End Date</label>
                    </td>
                    <td>
                        <input type="date" name="date2" onchange="range()" id="date2" onblur="emptValid(this.id, 'errdate2')" class="medium" />
                         <small style="display:block;" id="errdate2"></small>
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <br>
        <hr>
        <br>

        <div id="tableShow"></div>

        

        
    </div>
</div>

<script type="text/javascript">
    
    function range(){
        var date1 = $("#date1").val();
        var date2 = $("#date2").val();
        if (date1 !== "" && date2 !== "") {

            if (date1 > date2) {
                $("#error").html("Invalid date range.").css("color","red");
                 $("#tableShow").html("");
            }else{
                 $.ajax({
                    url : "getReportData.php",
                    method: "post",
                    data : {date1:date1,date2:date2},
                    dataType : "html",
                    success : function(data){
                        $("#tableShow").html(data);
                    }
                });
                $("#error").html("").css("color","");
            }

        }
    }

</script> 

<?php include "inc/admin_footer.php"; ?>

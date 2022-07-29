<?php include "inc/admin_header.php"; ?>
<?php include "inc/admin_sidebar.php"; ?>
<style type="text/css">

    .myTable{
        text-align: center;
        width: 80%;
        margin: 0 auto;
		border-collapse:collapse;
		border-spacing:0;
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
		
		@page{
        size: auto;
		}
    }

   

</style>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Income expenditure report</h2>
       <div class="block copyblock">

         <form action="" method="post">
            <table class="form" cellpadding="0" cellspacing="0"> 
                <tr>
                    <td>
                        <label>Select Type</label>
                    </td>
                    <td>
                        <select name="select_type" id="select_type">
                            <option value="">Select type</option>
                            <option value="in">Incomes</option>
                            <option value="out">Expenditures</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Select Sub Type</label>
                    </td>
                    <td>
                        <select name="voucher_type_id" id="voucher_type_id">
                           <option value="">Select sub type</option>
       
                       </select>
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <br>
        <hr>
        <br>
        <div id="tableShow">
            
        </div>

               
    </div>
</div>

<script type="text/javascript">
    $("#select_type").change(function(){

        var select_type = $(this).val();

        $.ajax({
            url : "getReportData.php",
            method: "post",
            data : {select_type:select_type},
            dataType : "html",
            success : function(data){
                $("#voucher_type_id").html(data);
            }
        });

    });

    $("#voucher_type_id").change(function(){
        var select_type_test    = $("#select_type").val();
        var voucher_type_id     = $("#voucher_type_id").val();
            $.ajax({
                url : "getReportData.php",
                method: "post",
                data : {voucher_type_id:voucher_type_id, select_type_test:select_type_test},
                dataType : "html",
                success : function(data){
                   $("#tableShow").html(data);
                }
            });
    });



</script>
        
<?php include "inc/admin_footer.php"; ?>

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
        <h2>Account wise report</h2>
       <div class="block copyblock">

         <form action="" method="post">
            <table class="form" cellpadding="0" cellspacing="0"> 
                <tr>
                    <td>
                        <label>Select Account</label>
                    </td>
                    <td>
                        <select name="posting_head_id" id="posting_head_id">
                           <option value="">Select Account</option>
        <?php
                $sql = "SELECT * FROM  ledger_posting_head ORDER BY posting_head_name ASC";
                $results = $db->select($sql);
                if ($results) {
                while($rows = $results->fetch_assoc()){
        ?>
            <option value="<?php echo $rows['ledger_posting_head_id']; ?>"><?php echo $rows['posting_head_name']; ?></option>
        <?php
            }}
        ?>

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
    

    $("#posting_head_id").change(function(){

        var posting_head_id = $(this).val();

        $.ajax({
            url : "getReportData.php",
            method: "post",
            data : {posting_head_id:posting_head_id},
            dataType : "html",
            success : function(data){
                $("#tableShow").html(data);
            }
        });

    });


</script>
        
<?php include "inc/admin_footer.php"; ?>

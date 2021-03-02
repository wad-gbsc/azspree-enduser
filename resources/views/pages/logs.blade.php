<!DOCTYPE html>
<html>
    <head>
        <title>Reports</title>
        
      <style type="text/css">
            body{
			font-family: calibri;
		}
		.qrcode{
			width: 100px;
			height: 100px;
		}
        .logodh{
			width: auto;
			height: 50px;
		}
		/* td.header{
			text-transform: uppercase;
			font-Total Kg: bold;
			font-size: 15pt;
		}*/
		.field{
            font-size: 16px; 
            text-transform: capitalize;
            text-align: justify;
            font-weight: bold;
		}
		 .top{
			border-top: 1px solid black;
            margin-top: 10%;
            margin-bottom: 10%;
		}
		table td.report_header{
			font-size: 26px;
		}
        .track{
            text-align: center;
        }
        </style>
    </head>
    <body>

        <table width="100%" >
        <tr class="border">
			<td colspan="4" class="header report_header" style="font-size: 24pt; font-family: Times new roman;">
                <img src="brands_try/azspreelogo.png" class="logodh">
            </td>
        </tr> 
        </table>
        <table width="100%" >
            <tr class="border">
                <td colspan="12" class="header report_header" style="font-size: 14pt; font-family: Times new roman;">
                    <center><b>INVOICE</b></center>
                </td>
                <br><br>
            </tr>
            <tr class="border">
                <td class="border" colspan="10">
                        <span>Invoice To.</span>
                        <br>
                        <span class="field">Name: Juan Dela Cruz</span>
                        <br>
                        <span>Account Name: Juan Dela Cruz</span>
                        <br>
                        <span>Bank Account No.: 00123123</span>
                        <br>
                        <span>Bank Name & Branch: BDO San Fernando</span>
                        <br>
                        <span>&nbsp;</span>
                </td>
                <td  class="border" colspan="2" style="text-align:right;">
                    <span>Date Prepared :  {{date("Y-m-d")}}</span>
                    <br>
                    <span><?php date_default_timezone_set("Asia/Manila"); echo "Time Prepared :" . date("h:i:sa"); ?></span>
                    <br>
                    <span></span>
                    <br>
                    <span></span>
                    <br>
                    <span></span>
                    <br>
                    <span>&nbsp;</span>
                </td>
            </tr>
        </table>

        </div>
        
        <table width="100%" >
            <tr>
                <td colspan="6">
                    <span class="field">product name</span>
                    <br><br>
                </td>
                <td colspan="1">
                    <span class="field">Quantity</span>
                    <br><br>
                </td>
                <td colspan="2" style="text-align: right;">
                    <span class="field">unit cost</span>
                    <br><br>
                </td> 
                <td colspan="3" style="text-align: right;">
                    <span class="field">amount</span>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="top"></td>
            </tr>
            <tr>
                <td colspan="6">
                    <span>BLK LIP</span>
                    <br><br><br><br>
                </td>
                <td colspan="1">
                    <span>1</span>
                    <br><br><br><br>
                </td>
                <td colspan="2" style="text-align: right;">
                    <span>150</span>
                    <br><br><br><br>
                </td>
                <td colspan="3" style="text-align: right;">
                    <span>150</span>
                    <br><br><br><br>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="top"></td>
            </tr>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="6">
                   &nbsp;
                </td>
                <td colspan="4">
                    <span>Sub-Total</span>
                    <br>
                    <span>Shipping Fee</span>
                    <br>
                    <span>Transaction Fee</span>
                    <br>
                    <span>Bank Fee</span>
                    <br>
                    <span>Packaging Fee</span>
                    <br>
                    <span><b>GRAND TOTAL</b></span>
                    <br><br><br><br>
                </td>
                <td colspan="2" style="text-align: right;">
                    <span>150.00</span>
                    <br>
                    <span>- 0.00</span>
                    <br>
                    <span>- 3.36</span>
                    <br>
                    <span>- 25.00</span>
                    <br>
                    <span>- 3.00</span>
                    <br>
                    <span><b>118.64<b></span>
                    <br><br><br><br>
                </td>
            </tr>
            <tr>
                <td colspan="12"><br>&nbsp;<br><br>&nbsp;<br></td>
            </tr>
            <tr>
                <td colspan="12">
                    <center>
                        <span>For more information, please contact us at https://www.facebook.com/AZSpree</span>
                    </center>
                    <br><br>
                </td>
            </tr>
        </table>
        <br>

        <div style="text-align:center;">
            <small>***** NOTHING TO FOLLOW *****</small>
        </div>
         <br>
         <br>
         <br>

        <div style="text-align:right;">
            <span class="top"  >&emsp;&emsp;&emsp; Prepared by &emsp;&emsp;&emsp;</span>
        </div>
    </body>
</html>

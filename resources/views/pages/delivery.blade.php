<!DOCTYPE html>
<html>
    <head>
        <title>Delivery Receipt</title>
        
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
			height: auto;
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
    <body style="overflow-x:auto;">
        <table width="100%" >
            <tr>
                <td colspan="12">
                    <center>
                        <span class="field">Delivery Receipt</span>
                    </center>
                    <br><br>
                </td>
            </tr>
		<tr >
			<td colspan="11">
                <br><br><img src="brands_try/azspreelogo.png" class="logodh">
                {{-- <span text-transform: uppercase;>Pampanga, Philippines</span> --}}
            </td>
            <td colspan="1" style="text-align: right;">
                    <img src="brands_try/qrcodee.png" class="qrcode">
			</td>
        </tr>
        <tr>
			<td colspan="12">&nbsp;</td>
		</tr>
        <tr>
			<td colspan="12" class="top"></td>
		</tr>
        </table>
        <table width="100%" >
            <tr>
                <td colspan="4">
                    <span class="field">Ordered by</span>
                    <br>
                    <span>Name:</span>
                    <br>
                    <span>Email:</span>
                    <br>
                    <span>Address:</span>
                    <br>
                    <span>&nbsp;</span>
                    <br><br><br><br>
                </td>
                <td colspan="4">
                    <span class="field">Order details</span>
                    <br>
                    <span>Order No:</span>
                    <br>
                    <span>Invoice No:</span>
                    <br>
                    <span>Invoice Date:</span>
                    <br>
                    <span>Payment Type:</span>
                    <br><br><br><br>
                </td>
                <td colspan="4">
                    <span class="field">delivered to</span>
                    <br>
                    <span>Name:</span>
                    <br>
                    <span>Email:</span>
                    <br>
                    <span>Address:</span>
                    <br>
                    <span>&nbsp;</span>
                    <br><br><br><br>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="top"></td>
            </tr>
        </table>
        <table width="100%" >
            <tr>
                <td colspan="2">
                    <span class="field">product code</span>
                    <br><br>
                </td>
                <td colspan="4">
                    <span class="field">description</span>
                    <br><br>
                </td>
                <td colspan="2" style="text-align: right;">
                    <span class="field">unit price</span>
                    <br><br>
                </td> 
                <td colspan="1" style="text-align: right;">
                    <span class="field">discount</span>
                    <br><br>
                </td>
                <td colspan="3" style="text-align: right;">
                    <span class="field">total price</span>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td colspan="12" class="top"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span>BLK lipstick with lip gloss </span>
                    <br><br><br><br>
                </td>
                <td colspan="4">
                    <span>BLK lipstick with lip gloss</span>
                    <br><br><br><br>
                </td>
                <td colspan="2" style="text-align: right;">
                    <span>150</span>
                    <br><br><br><br>
                </td>
                <td colspan="1" style="text-align: right;">
                    <span>0</span>
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
                <td colspan="8">&nbsp;</td>
                <td colspan="2">
                    <span>Shipping Fee</span>
                    <br>
                    <span>Shipping Fee Disc.</span>
                    <br>
                    <span><b>GRAND TOTAL</b></span>
                    <br><br><br><br>
                </td>
                <td colspan="2" style="text-align: right;">
                    <span>0.00</span>
                    <br>
                    <span>0.00</span>
                    <br>
                    <span>0.00</span>
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
    </body>
</html>

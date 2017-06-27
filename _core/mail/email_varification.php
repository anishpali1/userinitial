
<div>
    <table width="575" border="0" cellspacing="5" align="center" style="margin:0 auto;font-family:Arial, Helvetica, sans-serif; border-top:11px solid #32c5d2;">
   
    <tr>
        <td colspan="3" style="text-align: start; padding: 0 0 0px;"><p style="margin: 5px 0 10px; ">Dear <?php echo ucwords($user_info['full_name']);?>,</p>
      
          <p style="line-height: 24px; margin-bottom: 0;">Please click below link to varify your account with us.</p></td>
    </tr>
    <tr>
      <td colspan="3" style="text-align: start; padding: 0 0 0px;"><p style="margin: 5px 0 10px; "> </p>
      
          <a href="<?= $activation_url; ?>" style="line-height: 24px; margin-bottom: 0;color: #32c5d2; font-size: 14px; font-weight: bold;"><?= $activation_url; ?></a></td>
    </tr>
    <tr>
    	<td></td>
    </tr>
    
    
  </table>
  <table width="100%">
    <tr>
      <td colspan="3" style="border-bottom: 1px solid #32c5d2; padding: 15px 0 5px;"></td>
    </tr>
  </table>
  
</div>


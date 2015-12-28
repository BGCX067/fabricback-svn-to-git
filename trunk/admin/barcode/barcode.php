
      <table class="box" style="display:none;" > 
         <tr> 
            <td align="right">Code:</td> 
            <td><input id="codeInput" name="codeInput" value="<? echo $roll_id_bar; ?> " size="13" /></td> 
         </tr> 
         <tr> 
            <td align="right">Desc:</td> 
            <td><input id="descInput" name="descInput" value="<?  echo $serial_num ?>" size="22" /></td> 
         </tr> 
         <tr> 
            <td align="right">&nbsp;</td> 
            <td><input id="displayBtn" name="displayBtn" type="button" value="Display" /></td> 
         </tr> 
      </table> 
 
      <div class="barcodeContainer"> 
         <div class="barcode" id="EAN-13"> 
            <div id="EAN-13_desc" class="descDisplay">&nbsp;</div> 
            <div class="quietZone"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div class="leader"> 
               <div class="bitOn"></div> 
               <div class="bitOff"></div> 
               <div class="bitOn"></div> 
            </div> 
            <div id="EAN-13_digit01" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit02" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit03" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit04" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit05" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit06" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div class="separator" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOn"></div> 
               <div class="bitOff"></div> 
               <div class="bitOn"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit07" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit08" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit09" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit10" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit11" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_digit12" class="digit"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div class="trailer"> 
               <div class="bitOn"></div> 
               <div class="bitOff"></div> 
               <div class="bitOn"></div> 
            </div> 
            <div class="quietZone"> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
               <div class="bitOff"></div> 
            </div> 
            <div id="EAN-13_countryCode" class="codeDisplay">1</div> 
            <div id="EAN-13_group1" class="codeDisplay">234567</div> 
            <div id="EAN-13_group2" class="codeDisplay">890128</div> 
         </div> 
      </div> 
      
      

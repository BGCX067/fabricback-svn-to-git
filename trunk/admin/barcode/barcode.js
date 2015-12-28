// JavaScript Document


      <!-- The script code --> 
         /* Syntactical sugar to support object-oriented JavaScript. Code and 
         explanations may be found at the following address: 
         
         http://www.crockford.com/javascript/inheritance.html */
         
         Function.prototype.method = function (name, func) 
         {
             this.prototype[name] = func;
             return this;
         };
         
         Function.method('inherits', function (parent) 
         {
             var d = 0;
             var p = (this.prototype = new parent());
             
             this.method('base', function base(name) 
             {
                 var f;
                 var t = d;
                 var v = parent.prototype;
                 
                 if (t) 
                 {
                     while (t) 
                     {
                         v = v.constructor.prototype;
                         t -= 1;
                     }
                     
                     f = v[name];
                 } 
                 else 
                 {
                     f = p[name];
                     
                     if (f == this[name]) 
                     {
                         f = v[name];
                     }
                 }
                 
                 d += 1;
                 var r = f.apply(this, Array.prototype.slice.apply(arguments, [1]));
                 d -= 1;
                 return r;
             });
             
             return this;
         });
 
         Function.method('swiss', function (parent) 
         {
             for (var i = 1; i < arguments.length; ++i) 
             {
                 var name = arguments[i];
                 this.prototype[name] = parent.prototype[name];
             }
             
             return this;
         });
 
 
         /* This method formats a string using a supplied format string and a 
         variable number of parameters. It is based on the ECMA CLR (common-
         language runtime) class System.String's static method Format. */
         
         /* This function becomes a static method of the String object. */ 
         String.format = function(formatString) 
         { 
            if (arguments.length < 2) 
            { 
               return formatString; 
            } 
 
            /* Each JavaScript function has an implicit object named arguments that is 
            an array of the parameters passed to the function each time it is called. 
            The following line makes a reference to the arguments object so that it can 
            be used by the lambda function passed to the replace method, since it will 
            be available in the lambda's lexical scope. */ 
            var replArray = arguments; 
            
            /* Perform a regular-expression replacement of format placeholders. The 
            second parameter is a lambda function that is called on each regex match and 
            returns the appropriate replacement value. For example, {0} should be replaced 
            by element 1 in the replArray array, {1} by element 2, and so on. */ 
            return formatString.replace( 
               /\{(\d+)\}/g, 
               function(match, i) 
               { 
                  /* The '+' prefix operator converts a string to a numeric value. */ 
                  return replArray[+i + 1]; 
               } 
               ); 
         } 
 
        
         /* I found the information I needed to write this script in an article 
         on CodeProject (http://www.codeproject.com/csharp/EAN_13_Barcodes.asp) that 
         showed how to create a barcode in C#. The check-digit calculation is lifted 
         pretty much as-is from that article; the rest of the code is original. */
      
         function createAttribute(name, value)
         {
            var attr = document.createAttribute(name);
            attr.nodeValue = value;
            return attr;
         }
         
         
         function BarCodeUI(nodeID)
         {
            var self = this;
            
            var codeInputID = "codeInput";
            var descInputID = "descInput";
            var displayBtnID = "displayBtn";
            var countryDispID = String.format("{0}_countryCode", nodeID);
            var group1DispID = String.format("{0}_group1", nodeID);
            var group2DispID = String.format("{0}_group2", nodeID);
            var descDispID = String.format("{0}_desc", nodeID);
            
            var codeInput = document.getElementById(codeInputID);
            var descInput = document.getElementById(descInputID);
            
            var countryDisp = document.getElementById(countryDispID).firstChild;
            var group1Disp = document.getElementById(group1DispID).firstChild;
            var group2Disp = document.getElementById(group2DispID).firstChild;
            var descDisp = document.getElementById(descDispID).firstChild;
            var displayBtn = document.getElementById(displayBtnID);
            
           /* IDs of the HTML elements used to display the encoded digits. */
           var digits = 
            [
               "",
               String.format("{0}_digit01", nodeID),
               String.format("{0}_digit02", nodeID),
               String.format("{0}_digit03", nodeID),
               String.format("{0}_digit04", nodeID),
               String.format("{0}_digit05", nodeID),
               String.format("{0}_digit06", nodeID),
               String.format("{0}_digit07", nodeID),
               String.format("{0}_digit08", nodeID),
               String.format("{0}_digit09", nodeID),
               String.format("{0}_digit10", nodeID),
               String.format("{0}_digit11", nodeID),
               String.format("{0}_digit12", nodeID)
            ];
            
 
            BarCodeUI.method('GetCodeInput', function()
            {
               return codeInput.value;
            });
               
 
            BarCodeUI.method('SetCodeInput', function(value)
            {
               codeInput.value = value;
            });
               
 
            BarCodeUI.method('SetDigit', function(pos, pattern)
            {
               var digitNode = document.getElementById(digits[pos]);
               var bits = digitNode.getElementsByTagName("div");
               
               for (var j = 0; j < bits.length; ++j)
               {
                  bits[j].setAttributeNode(
                     createAttribute(
                        "class", 
                        pattern[j] ? "bitOn" : "bitOff"
                        )
                     );
               }
            });
               
 
            BarCodeUI.method('DisplayText', function()
            {  
               var code = codeInput.value;
               var countryCode = code.charAt(0);
               var group1 = code.substring(1, 7);
               var group2 = code.substring(7, 13);
               
               countryDisp.nodeValue = countryCode;
               group1Disp.nodeValue = group1;
               group2Disp.nodeValue = group2;
               descDisp.nodeValue = descInput.value;
               
               codeInput.focus();
            });
         
 
            BarCodeUI.method('NodeID', function()
            {
               return nodeID;
            });
               
 
            BarCodeUI.method('GetCode', function()
            {
               return codeInput.value;
            });
               
 
            BarCodeUI.method('GetDesc', function()
            {
               return descInput.value;
            });
               
 
            BarCodeUI.method('WireEvents', function()
            {
               codeInput.onkeydown = function(event) { BarCodeUI.onEditorKeyDown(event); };
               codeInput.onkeyup = function(event) { BarCodeUI.onEditorKeyUp(event); };
               // displayBtn.onclick = function(event) { BarCodeUI.
            });
            
 
            BarCodeUI.lengthCheckScheduled = 0;
            BarCodeUI.lengthCheckTimeout = 100;
            
 
            BarCodeUI.testLength = function()
            {
               if (BarCodeUI.lengthCheckScheduled)
               {
                  clearTimeout(BarCodeUI.lengthCheckScheduled);
               }
               
               BarCodeUI.lengthCheckScheduled = 0;
               
               var length = codeInput.value.length;
               var isInvalid = (length < 11 || length > 13) || parseInt(codeInput.value) == NaN;
               
               document.getElementById('displayBtn').disabled = isInvalid;
               return isInvalid;
            }
 
            BarCodeUI.onEditorKeyDown = function(event)
            {
               if (BarCodeUI.lengthCheckScheduled)
               {
                  clearTimeout(BarCodeUI.lengthCheckScheduled);
                  BarCodeUI.lengthCheckScheduled = setTimeout(
                     "BarCodeUI.testLength()", 
                     BarCodeUI.lengthCheckTimeout
                     );
               }
            }
            
            BarCodeUI.onEditorKeyUp = function(event)
            {
               if (event.charCode)
               {
                  key = event.charCode;
               }
               else
               {
                  key = event.keyCode;
               }
               
               /*               
               if ( checkLength && 
                     (
                        // Left parent, right paren, or SHIFT-Ins
                        (event.shiftKey && (key == 57 || key == 48 || key == 45)) || 
                        // Ctrl-V
                        (event.ctrlKey && key == 86) || 
                        // Backspace or Del
                        (key == 8 || key == 46)
                     )
                  )
               {
               */
                  if (BarCodeUI.lengthCheckScheduled)
                  {
                     clearTimeout(BarCodeUI.lengthCheckScheduled);
                  }
                  
                  BarCodeUI.lengthCheckScheduled = setTimeout(
                     "BarCodeUI.testLength()", 
                     BarCodeUI.lengthCheckTimeout
                     );
               /*
               }
               */
            }
 
 
         };
 
         /* I plan to do a significant amount of refactoring to add support for 
         additional symbologies. First, I'll make the following class a base class and 
         specialize it for specific symbologies (EAN-8, UPC-A, etc.). Then I'll probably 
         separate the HTML/UI input interface from the output interface. */
         
         /* Define the application object. */
         function BarCodeGenerator()
         {
            /* Private data members. */
            var self = this;
 
            /* Public method that generates the barcode. */
            BarCodeGenerator.method("Generate", function(ui)
            {
               var retVal = 0;
               var code = ui.GetCodeInput();
               
               code = code + this.CalculateChecksumDigit(code);
               ui.SetCodeInput(code);
               
               for (var i = 1; i < code.length; ++i)
               {
                  // ui.SetDigit(i, pattern);                  
               }
               
               ui.DisplayText();                  
               
               return retVal;
            });
            
            /* */
            BarCodeGenerator.method("CalculateChecksumDigit", function(code)
            {
                var checkSum = 0; 
                return checkSum;
            });
            
         }
         
         /* Define the application object. */
         function EAN13Generator()
         {
            /* Bit patterns for digits. Each digit takes up seven lines in a 
            barcode. A zero corresponds to a blank line, and a one corresponds to 
            a filled line. */
            
            /* Odd-parity left-hand digits. */
            var odd = 
               [
                  [0,0,0,1,1,0,1], // 0
                  [0,0,1,1,0,0,1], // 1
                  [0,0,1,0,0,1,1], // 2
                  [0,1,1,1,1,0,1], // 3
                  [0,1,0,0,0,1,1], // 4
                  [0,1,1,0,0,0,1], // 5
                  [0,1,0,1,1,1,1], // 6
                  [0,1,1,1,0,1,1], // 7
                  [0,1,1,0,1,1,1], // 8
                  [0,0,0,1,0,1,1]  // 9
               ];
         
            /* Even-parity left-hand digits. */
            var even = 
               [
                  [0,1,0,0,1,1,1], // 0
                  [0,1,1,0,0,1,1], // 1
                  [0,0,1,1,0,1,1], // 2
                  [0,1,0,0,0,0,1], // 3
                  [0,0,1,1,1,0,1], // 4
                  [0,1,1,1,0,0,1], // 5
                  [0,0,0,0,1,0,1], // 6
                  [0,0,1,0,0,0,1], // 7
                  [0,0,0,1,0,0,1], // 8
                  [0,0,1,0,1,1,1]  // 9
               ];
         
            /* Right-hand digits. */
            var right = 
               [
                  [1,1,1,0,0,1,0], // 0
                  [1,1,0,0,1,1,0], // 1
                  [1,1,0,1,1,0,0], // 2
                  [1,0,0,0,0,1,0], // 3
                  [1,0,1,1,1,0,0], // 4
                  [1,0,0,1,1,1,0], // 5
                  [1,0,1,0,0,0,0], // 6
                  [1,0,0,0,1,0,0], // 7
                  [1,0,0,1,0,0,0], // 8
                  [1,1,1,0,1,0,0]  // 9
               ];
               
            /* Digit parity is determined by the first digit of the code. This 
            array corresponds to the possible values of the code and uses the 
            parity tables described above. */
            var parity = 
               [
                  [ odd,  odd,  odd,  odd,  odd,  odd ], // 0
                  [ odd,  odd, even,  odd, even, even ], // 1
                  [ odd,  odd, even, even,  odd, even ], // 2
                  [ odd,  odd, even, even, even,  odd ], // 3
                  [ odd, even,  odd,  odd, even, even ], // 4
                  [ odd, even, even,  odd,  odd, even ], // 5
                  [ odd, even, even, even,  odd,  odd ], // 6
                  [ odd, even,  odd, even,  odd, even ], // 7
                  [ odd, even,  odd, even, even,  odd ], // 8
                  [ odd, even, even,  odd, even,  odd ]  // 9
               ];
               
            /* Private data members. */
                   
            var self = this;
 
            /* Public method that executes the script application. */
            EAN13Generator.method("Generate", function(ui)
            {
               var retVal = 0;
               var code = ui.GetCodeInput();
               
               if (code.length > 12)
               {
                  code = code.substring(0, 12);
               }
               else if (code.length == 11)
               {
                  code = "0" + code;
               }
               
               code = code + this.CalculateChecksumDigit(code);
               ui.SetCodeInput(code);
               
               var parityDigit = parseInt(code.charAt(0));
               var parityTable = parity[parityDigit];
               
               for (var i = 1; i < code.length; ++i)
               {
                  var num = +code.charAt(i);
                  var pattern = null; // parityTable[0][0];
                  
                  if (i < 7)
                  {
                     pattern = parityTable[i - 1][num];
                  }
                  else
                  {
                     pattern = right[num];
                  }
 
                  ui.SetDigit(i, pattern);                  
               }
               
               ui.DisplayText();                  
               
               return retVal;
            });
            
            /* As mentioned above, this was borrowed from 
            http://www.codeproject.com/csharp/EAN_13_Barcodes.asp */
            EAN13Generator.method("CalculateChecksumDigit", function(code)
            {
                var sum = 0;
                var digit = 0;
 
                /* Calculate the checksum digit here. */
                for (var i = code.length; i >= 1; --i)
                {
                    digit = parseInt(code.substring( i - 1, i ) );
 
                    /* This appears to be backwards but the EAN-13 checksum must be calculated
                    this way to be compatible with UPC-A. */
                    if ( i % 2 == 0 )
                    {   /* odd */
                        sum += digit * 3;
                    }  
                    else 
                    {   /* even */
                        sum += digit * 1; 
                    }
                }
                
                var checkSum = ( 10 - ( sum % 10 ) )  % 10; 
                return checkSum;
            });
            
            EAN13Generator.inherits(BarCodeGenerator);
         }
         
         var barcodeObjects = null;
         
         function window_onload()
         {
            barcodeObjects = 
            {
               "EAN-13": { generator: new EAN13Generator(), ui: new BarCodeUI("EAN-13") }
               // "UPC-A": new BarCodeUI("UPC-A")
            };
 
            barcodeObjects["EAN-13"].ui.WireEvents();
            var displayBtn = document.getElementById("displayBtn");
            displayBtn.onclick = function() { barcodeObjects['EAN-13'].generator.Generate(barcodeObjects['EAN-13'].ui); };
            barcodeObjects["EAN-13"].generator.Generate(barcodeObjects["EAN-13"].ui);
         }
         
         window.onload = window_onload;

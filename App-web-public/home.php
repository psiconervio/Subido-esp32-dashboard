<!-- // home.php PHP/HTML code to display DHT11 sensor data and control LEDs state.*/ -->
<!DOCTYPE HTML>
<html>
  <head>
    <title>Laboratorio de Innovacion Social</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}
      .topnav {overflow: hidden; background-color: #0c6980; color: white; font-size: 1.2rem;}
      .content {padding: 5px; }
      .card {background-color: white; box-shadow: 0px 0px 10px 1px rgba(140,140,140,.5); border: 1px solid #0c6980; border-radius: 15px;}
      .card.header {background-color: #0c6980; color: white; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border-top-right-radius: 12px; border-top-left-radius: 12px;}
      .cards {max-width: 700px; margin: 0 auto; display: grid; grid-gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));}
      .reading {font-size: 1.3rem;}
      .packet {color: #bebebe;}
      .temperatureColor {color: #fd7e14;}
      .humidityColor {color: #1b78e2;}
      .statusreadColor {color: #702963; font-size:12px;}
      .LEDColor {color: #183153;}
      
      /*Interruptor de palanca / Toggle Switch */
      .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
      }

      .switch input {display:none;}

      .sliderTS {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #D3D3D3;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
      }

      .sliderTS:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: #f7f7f7;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
      }

      input:checked + .sliderTS {
        background-color: #00878F;
      }

      input:focus + .sliderTS {
        box-shadow: 0 0 1px #2196F3;
      }

      input:checked + .sliderTS:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
      }

      .sliderTS:after {
        content:'OFF';
        color: white;
        display: block;
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 70%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
      }

      input:checked + .sliderTS:after {  
        left: 25%;
        content:'ON';
      }

      input:disabled + .sliderTS {  
        opacity: 0.3;
        cursor: not-allowed;
        pointer-events: none;
      }
      /* ----------------------------------- */
    </style>
  </head>
  
  <body>
    <div class="topnav">
      <h3>Laboratorio de Innovacion Social</h3>
    </div>
    <br>
    <!-- MONITOREO Y CONTROL DE PANTALLAS _ -->
    <div class="content">
      <div class="cards">
        
        <!-- == MONITOREO_ESP32_01== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_01</h3>
          </div>
          
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURA</h4>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span></p>
          
          <p class="statusreadColor"><span>Estado lectura Sensor DHT11 : </span><span id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>
        <!-- ====================================================================== -->
        
        <!-- == Control LEDs1========================== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">CONTROL</h3>
          </div>
          
          <!-- Buttons for controlling the LEDs on Slave 2.  -->
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 1</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_01" onclick="GetTogBtnLEDState('ESP32_01_TogLED_01')">
            <div class="sliderTS"></div>
          </label>
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 2</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_01_TogLED_02" onclick="GetTogBtnLEDState('ESP32_01_TogLED_02')">
            <div class="sliderTS"></div>
          </label>
          <!-- *********************************************************************** -->
        </div>  
        <!-- ===================================================== -->
        
      </div>
            <div class="cards">
        
        <!-- == MONITOREO_ESP32_02 == -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_02</h3>
          </div>
          
          <!-- Displays the humidity and temperature values received from ESP32. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> Temperatura</h4>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_02_Temp"></span> &deg;C</span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP32_02_Humd"></span> &percnt;</span></p>
          <!-- *********************************************************************** -->
          
          <p class="statusreadColor"><span>Estado Read Sensor DHT11 : </span><span id="ESP32_02_Status_Read_DHT11"></span></p>
        </div>
        <!-- ================================================================ -->
        
        <!-- == Control Leds 2========= -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">CONTROL</h3>
          </div>
          
          <!-- Botones para controlar los LED en Slave 2.  -->
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 1</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_02_TogLED_01" onclick="GetTogBtnLEDState('ESP32_02_TogLED_01')">
            <div class="sliderTS"></div>
          </label>
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 2</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_02_TogLED_02" onclick="GetTogBtnLEDState('ESP32_02_TogLED_02')">
            <div class="sliderTS"></div>
          </label>
          <!-- *********************************************************************** -->
        </div>  
        <!-- ======================================================== -->
        </div>
            <div class="cards">
        
        <!-- == MONITOREO_ESP32_03=== -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_03</h3>
          </div>
          
          <!-- Displays the humidity and temperature values received from ESP32. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> Temperatura</h4>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_03_Temp"></span> &deg;C</span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP32_03_Humd"></span> &percnt;</span></p>
          <h4 class="anemometro_title"> <i class="fas fa-tint"></i>Anemometro</h4>
          <p class="anemometro"><span id="ESP32_03_anemometro"></span></p>
          <!-- *********************************************************************** -->
          
          <p class="statusreadColor"><span>Estado Read Sensor DHT11 : </span><span id="ESP32_03_Status_Read_DHT11"></span></p>
        </div>
        <!-- ============================================================================= -->
        
        <!-- == Control LEDs 3 == -->
        <div class="card">
          <div class="card header">
            <h3 style="font-size: 1rem;">CONTROL</h3>
          </div>
          
          <!-- Botones para controlar los LED en Slave 2.  -->
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 1</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_03_TogLED_01" onclick="GetTogBtnLEDState('ESP32_03_TogLED_01')">
            <div class="sliderTS"></div>
          </label>
          <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 2</h4>
          <label class="switch">
            <input type="checkbox" id="ESP32_03_TogLED_02" onclick="GetTogBtnLEDState('ESP32_03_TogLED_02')">
            <div class="sliderTS"></div>
          </label>
          <!-- *********************************************************************** -->
        </div>  
        <!-- ========================================================== -->
      </div>
    </div>
    
    <br>
    
    <div class="content">
      <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <h3 style="font-size: 0.7rem;">LAST TIME RECEIVED DATA FROM ESP32 [ <span id="ESP32_01_LTRD"></span> ]</h3>
            <button onclick="window.open('recordtable.php', '_blank');">Open Record Table</button>
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
      </div>
    </div>
    <!-- ____________________________________________________________________ -->
    
    <script>
      //PRIMER SCRIPT------------------------------------------------------------
      document.getElementById("ESP32_01_Temp").innerHTML = "NN"; 
      document.getElementById("ESP32_01_Humd").innerHTML = "NN";
      document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
      document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
      //------------------------------------------------------------
      
      Get_Data("esp32_01");
      
      setInterval(myTimer, 10000);
      
      //------------------------------------------------------------
      function myTimer() {
        Get_Data("esp32_01");
      }
      //------------------------------------------------------------
      
      function Get_Data(id) {
           var xmlhttp;
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            if (myObj.id == "esp32_01") {
              document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
              document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
              document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
              document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
              if (myObj.LED_01 == "ON") {
                document.getElementById("ESP32_01_TogLED_01").checked = true;
              } else if (myObj.LED_01 == "OFF") {
                document.getElementById("ESP32_01_TogLED_01").checked = false;
              }
              if (myObj.LED_02 == "ON") {
                document.getElementById("ESP32_01_TogLED_02").checked = true;
              } else if (myObj.LED_02 == "OFF") {
                document.getElementById("ESP32_01_TogLED_02").checked = false;
              }
            }
          }
        };
        xmlhttp.open("POST","getdata.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id);
			}
      
      //------------------------------------------------------------
      function GetTogBtnLEDState(togbtnid) {
        if (togbtnid == "ESP32_01_TogLED_01") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("esp32_01","LED_01",togbtncheckedsend);
        }
        if (togbtnid == "ESP32_01_TogLED_02") {
          var togbtnchecked = document.getElementById(togbtnid).checked;
          var togbtncheckedsend = "";
          if (togbtnchecked == true) togbtncheckedsend = "ON";
          if (togbtnchecked == false) togbtncheckedsend = "OFF";
          Update_LEDs("esp32_01","LED_02",togbtncheckedsend);
        }
      }
      //------------------------------------------------------------
      
      function Update_LEDs(id,lednum,ledstate) {
				if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("demo").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("POST","updateLEDs.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id="+id+"&lednum="+lednum+"&ledstate="+ledstate);
			}
 
    </script>

    <script> // segundo script------------------------------------------------------------------------ 
    document.getElementById("ESP32_02_Temp").innerHTML = "NN"; 
    document.getElementById("ESP32_02_Humd").innerHTML = "NN";
    document.getElementById("ESP32_02_Status_Read_DHT11").innerHTML = "NN";
    //document.getElementById("ESP32_02_LTRD").innerHTML = "NN";
    //se necesita usar otra variable xmlhttp a xmlhttpp
    obtenerData("esp32_02");
    
    setInterval(myTimer, 10000);
    
    function myTimer() {
      obtenerData("esp32_02");
    }
    
    function obtenerData(id) {
        console.log("se esta ejecutando ObtenerData")
      var xmlhttpp;
      if (window.XMLHttpRequest) {
        xmlhttpp = new XMLHttpRequest();
      } else {
        xmlhttpp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttpp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Respuesta del servidor:", this.responseText);
          var myObjDOS = JSON.parse(this.responseText);
          if (myObjDOS.id == "esp32_02") {
            document.getElementById("ESP32_02_Temp").innerHTML = myObjDOS.temperature;
            document.getElementById("ESP32_02_Humd").innerHTML = myObjDOS.humidity;
            document.getElementById("ESP32_02_Status_Read_DHT11").innerHTML = myObjDOS.status_read_sensor_dht11;
            //document.getElementById("ESP32_02_LTRD").innerHTML = "Time : " + myObjDOS.ls_time + " | Date : " + myObjDOS  .ls_date + " (dd-mm-yyyy)";
            if (myObjDOS.LED_01 == "ON") {
              document.getElementById("ESP32_02_TogLED_01").checked = true;
            } else if (myObjDOS.LED_0DOS == "OFF") {
              document.getElementById("ESP32_02_TogLED_01").checked = false;
            }
            if (myObjDOS.LED_02 == "ON") {
              document.getElementById("ESP32_02_TogLED_02").checked = true;
            } else if (myObjDOS.LED_02 == "OFF") {
              document.getElementById("ESP32_02_TogLED_02").checked = false;
            }
          }
        }
      };
      xmlhttpp.open("POST", "getdataDOS.php", true);
      xmlhttpp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttpp.send("id=" + id);
    }
    
    function GetTogBtnLEDStatee(togbtnid) {
      if (togbtnid == "ESP32_02_TogLED_01") {
        var togbtnchecked = document.getElementById(togbtnid).checked;
        var togbtncheckedsend = "";
        if (togbtnchecked == true) togbtncheckedsend = "ON";
        if (togbtnchecked == false) togbtncheckedsend = "OFF";
        Update_LEDss("esp32_02", "LED_01", togbtncheckedsend);
      }
      if (togbtnid == "ESP32_02_TogLED_02") {
        var togbtnchecked = document.getElementById(togbtnid).checked;
        var togbtncheckedsend = "";
        if (togbtnchecked == true) togbtncheckedsend = "ON";
        if (togbtnchecked == false) togbtncheckedsend = "OFF";
        Update_LEDss("esp32_02", "LED_02", togbtncheckedsend);
      }
    }
    
    function Update_LEDss(id, lednum, ledstate) {
      var xmlhttp;
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //document.getElementById("demo").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("POST", "updateLEDs.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("id=" + id + "&lednum=" + lednum + "&ledstate=" + ledstate);
    }
    </script>
    
    <script> //------------------------/ tercer script/------------------------------------------------ 
    //trabajar con este script para enviar bien los datos, del anemomeotr
    document.getElementById("ESP32_03_Temp").innerHTML = "NN"; 
    document.getElementById("ESP32_03_Humd").innerHTML = "NN";
    document.getElementById("ESP32_03_Status_Read_DHT11").innerHTML = "NN";
    //document.getElementById("ESP32_03_LTRD").innerHTML = "NN";
    document.getElementById("ESP32_03_anemometro").innerHTML ="NN";

    //se necesita usar otra variable xmlhttp a xmlhttpp
    obtenerDataa("esp32_03");
    
    setInterval(myTimer, 10000);
    
    function myTimer() {
      obtenerDataa("esp32_03");
    }
    
    function obtenerDataa(id) {
        console.log("se esta ejecutando ObtenerData")
      var xmlhttppp;
      if (window.XMLHttpRequest) {
        xmlhttppp = new XMLHttpRequest();
      } else {
        xmlhttppp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttppp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Respuesta del servidor:", this.responseText);
          var myObjTRES = JSON.parse(this.responseText);
          if (myObjTRES.id == "esp32_03") {
            document.getElementById("ESP32_03_Temp").innerHTML = myObjTRES.temperature;
            document.getElementById("ESP32_03_Humd").innerHTML = myObjTRES.humidity;
            document.getElementById("ESP32_03_Status_Read_DHT11").innerHTML = myObjTRES.status_read_sensor_dht11;
            //se agrego esta linea de abajo
            document.getElementById("ESP32_03_anemometro").innerHTML = myObjTRES.anemometro;
            document.getElementById("ESP32_03_LTRD").innerHTML = "Time : " + myObjTRES.ls_time + " | Date : " + myObjTRES  .ls_date + " (dd-mm-yyyy)";
            if (myObjTRES.LED_01 == "ON") {
              document.getElementById("ESP32_03_TogLED_01").checked = true;
            } else if (myObjTRES.LED_0TRES == "OFF") {
              document.getElementById("ESP32_03_TogLED_01").checked = false;
            }
            if (myObjTRES.LED_02 == "ON") {
              document.getElementById("ESP32_03_TogLED_02").checked = true;
            } else if (myObjTRES.LED_02 == "OFF") {
              document.getElementById("ESP32_03_TogLED_02").checked = false;
            }
          }
        }
      };
      xmlhttppp.open("POST", "getdataTRES.php", true);
      xmlhttppp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttppp.send("id=" + id);
    }
    
    function GetTogBtnLEDStatee(togbtnid) {
      if (togbtnid == "ESP32_03_TogLED_01") {
        var togbtnchecked = document.getElementById(togbtnid).checked;
        var togbtncheckedsend = "";
        if (togbtnchecked == true) togbtncheckedsend = "ON";
        if (togbtnchecked == false) togbtncheckedsend = "OFF";
        Update_LEDss("esp32_03", "LED_01", togbtncheckedsend);
      }
      if (togbtnid == "ESP32_03_TogLED_02") {
        var togbtnchecked = document.getElementById(togbtnid).checked;
        var togbtncheckedsend = "";
        if (togbtnchecked == true) togbtncheckedsend = "ON";
        if (togbtnchecked == false) togbtncheckedsend = "OFF";
        Update_LEDss("esp32_03", "LED_02", togbtncheckedsend);
      }
    }
    
    function Update_LEDss(id, lednum, ledstate) {
      var xmlhttp;
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //document.getElementById("demo").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("POST", "updateLEDs.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send("id=" + id + "&lednum=" + lednum + "&ledstate=" + ledstate);
    }
    </script>

  </body>
</html>


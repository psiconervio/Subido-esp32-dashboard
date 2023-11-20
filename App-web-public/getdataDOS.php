<?php
  include 'database.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];
    if ($id == "Esp32_02") {
        $myObjDOS = (object)array();
    
        //........................................ 
        $pdo = Database::connect();
        // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
        // This table is used to store DHT11 sensor data updated by ESP32. 
        // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
        // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
        $sql = 'SELECT * FROM esp32_table_dht11_leds_update1 WHERE id="' . $id . '"';
      //  if( $id == "ESP32_02"){
        foreach ($pdo->query($sql) as $row) {
          $date = date_create($row['date']);
          $dateFormat = date_format($date,"d-m-Y");
          
          $myObjDOS->id = $row['id'];
          $myObjDOS->temperature = $row['temperature'];
          $myObjDOS->humidity = $row['humidity'];
          $myObjDOS->status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
          $myObjDOS->LED_01 = $row['LED_01'];
          $myObjDOS->LED_02 = $row['LED_02'];
          $myObjDOS->ls_time = $row['time'];
          $myObjDOS->ls_date = $dateFormat;
          
          $myJSONDOS = json_encode($myObjDOS);
          
          echo $myJSONDOS;
    
         }}
        Database::disconnect();
    }
 
?>
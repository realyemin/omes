   <table class="table table-bordered table-hover table-striped">
    <tr>
      <th colspan="4">Sunucu Ayarları</th>
    </tr>
    <tr>
      <td>Sunucu Ip(Server):</td>
      <td>
		<input type="text"
		class="form-control"		
		name="ServerIP" 
		value="<?php echo $ServerIP; ?>">
      </td>
    </tr>
	    <tr>
      <td>Sunucuya veri gönderme portu:</td>
      <td>
		<input type="number"
		class="form-control"		
		name="PORT_Gonderici" 
		value="<?php echo $PORT_Gonderici; ?>">
      </td>
    </tr>
	    <tr>
      <td>Sunucuya veri alma portu:</td>
      <td>
		<input type="number"
		class="form-control"		
		name="PORT_Alici" 
		value="<?php echo $PORT_Alici; ?>">
      </td>
    </tr>
	    <tr>
      <td>Otomatik IP:</td>
      <td>
		<label class="switch">
        <input name="OtoIP" type="checkbox" value="true" <?php if($OtoIP){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label>
      </td>
    </tr>
	    <tr>
      <td>Veritabanı Adı:</td>
      <td>
		<input type="text"
		class="form-control"		
		name="dbName" 
		value="<?php echo $dbName; ?>">
      </td>
    </tr>
	    <tr>
      <td>Sunucu Kullanıcı:</td>
      <td>
		<input type="text"
		class="form-control"		
		name="dbUserName" 
		value="<?php echo $dbUserName; ?>">
      </td>
    </tr>
	    <tr>
      <td>Sunucu Parola:</td>
      <td>
		<input type="text"
		class="form-control"		
		name="dbPassword" 
		value="<?php echo $dbPassword; ?>">
      </td>
    </tr>
  </table>
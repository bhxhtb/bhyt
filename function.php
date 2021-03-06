<?php
Function dangnhap() {
	Global $username,$password;
	$user = array(
		'username' => $username,
		'password' => $password
	);
	$param = json_encode($user);
	$url = 'http://egw.baohiemxahoi.gov.vn/api/token/take';
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$result = curl_exec($ch);
	curl_close($ch);
	return json_decode($result, true);
}	
Function LichsuKB($mathe) {
	Global $username,$password,$access_token,$id_token;
	$param = json_encode($mathe);	
	$url = "http://egw.baohiemxahoi.gov.vn/api/egw/NhanLichSuKCB2018?token=$access_token&id_token=$id_token&username=$username&password=$password";
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$result = curl_exec($ch);
	curl_close($ch);	
	return json_decode($result, true);
}
Function LichsuKB595($mathe) {
	Global $username,$password,$access_token,$id_token;
	if ($mathe["gioiTinh"] <> "1") $mathe["gioiTinh"] = "2";
	$param = json_encode($mathe);	
	$url = "https://egw.baohiemxahoi.gov.vn/api/egw/KQNhanLichSuKCB2019?token=$access_token&id_token=$id_token&username=$username&password=$password";
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$result = curl_exec($ch);
	curl_close($ch);	
	return json_decode($result, true);
}
Function ketquacheckthe($maketqua) {
	Global $maketquacheckthe;
	if (array_key_exists($maketqua, $maketquacheckthe)) {
		return $maketquacheckthe[$maketqua];
	} else {
		return "M?? k???t qu??? ch??a bi???t - li??n h??? v???i BHXH m??($maketqua)";
	}
}
Function thongtinhanhchinhthe($result) {
	if($result["hoTen"]){
        Echo "<div>
	<strong>Th??ng tin h??nh ch??nh (K???t qu??? tr??? v??? t??? BHXH) </strong><br>
	Th??ng b??o: $result[ghiChu] <br>
	H??? v?? t??n: $result[hoTen] <br>
	Gi???i t??nh: $result[gioiTinh] <br>
	?????a ch???: $result[diaChi] <br>
	N??i ??K KCB B??: $result[maDKBD] - {$thongtincskcb->ten}<br>
	Gi?? tr??? th??? t???: $result[gtTheTu] <br>
	Gi?? tr??? th??? ?????n: $result[gtTheDen] <br>
	M?? khu v???c: $result[maKV] <br>
	Ng??y ????? 5 n??m: $result[ngayDu5Nam] <br>
	C?? quan BHXH: $result[cqBHXH] <br>
	M?? s??? BHXH: $result[maSoBHXH] <br>
	M?? th??? c??: $result[maTheCu] <br>
	M?? th??? m???i: $result[maTheMoi] <br>
	Gi?? tr??? th??? m???i t???: $result[gtTheTuMoi] <br>
	Gi?? tr??? th??? m???i ?????n: $result[gtTheDenMoi] <br>
	</div>";
	}
}
Function thongtinlichsukcb($result) {
	global $ketqua, $tinhtrang;
	if(is_array($result["dsLichSuKCB2018"])){
	echo "<br><strong>L???ch s??? KCB</strong>
	<table>
	<tr align='center'>
	<td style='font-weight:bold;'><center><h4>M?? h??? s??</center></h4></td>
	<td style='font-weight:bold;'><center><h4>C?? s??? KCB</center></h4></td>
	<th style='font-weight:bold;'><center><h4>Ng??y v??o</center></h4></th>
	<th style='font-weight:bold;'><center><h4>Ng??y ra</center></h4></th>
	<th style='font-weight:bold;'><center><h4>T??nh tr???ng</center></h4></th>
	<th style='font-weight:bold;'><center><h4>K???t qu??? ??i???u tr???</center></h4></th>
	</tr";
	foreach ($result["dsLichSuKCB2018"] as $ls) {
		echo "
		<tr align='center'>
		<td><center>" . $ls["maHoSo"] . "</center></td>
		<td><center>" . $ls["maCSKCB"]. "</center></td>
		<td><center>". date('d/m/Y H:i', strtotime($ls['ngayVao']))."</center></td>
		<td><center>". date(' d/m/Y H:i', strtotime($ls['ngayRa']))."</center></td>
		<td><center>" . $tinhtrang[$ls["tinhTrang"]] . "</center></td>
		<td><center>" . $ketqua[$ls["kqDieuTri"]] . "</center></td>
		</tr>";				
	}
	echo "</table>";			
	}
}

Function ketquacheckthe595($maketqua) {
	Global $maketquacheckthe595;
	if (array_key_exists($maketqua, $maketquacheckthe595)) {
		return $maketquacheckthe595[$maketqua];
	} else {
		return "M?? k???t qu??? ch??a bi???t - li??n h??? v???i BHXH m??($maketqua)";
	}
}
Function ChitietHS($maHoSo) {
	Global $username,$password,$access_token,$id_token;
	$url = "http://egw.baohiemxahoi.gov.vn/api/egw/nhanHoSoKCBChiTiet?token=$access_token&id_token=$id_token&username=$username&password=$password&maHoSo=$maHoSo";
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, "");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$result = curl_exec($ch);	
	return json_decode($result, true);
}
?>

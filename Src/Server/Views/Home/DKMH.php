<input id="txtTimKiem" type="text">
<input onclick="timKiem()" type="button" value="Tìm Kiếm">
<table class="table table-bordered table-light">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Mã MH</th>
            <th scope="col">Tên Môn Học</th>
            <th scope="col">NHM</th>
            <th scope="col">STC</th>
            <th scope="col">Sĩ số</th>
            <th scope="col">CL</th>
            <th scope="col">Thứ</th>
            <th scope="col">Tiết BD</th>
            <th scope="col">Tiết KT</th>
            <th scope="col">Phòng</th>
            <th scope="col">Giảng viên</th>
            <th scope="col">Tuần</th>
        </tr>
    </thead>
    <tbody>

        <?php
            $t = $data["data"][0]['ID_DSMH'];
            $countList = array();

            // Đếm số lần xuất hiện của ID_DSMH và lưu vào mảng $countList
            foreach ($data["data"] as $key => $value) {
                $idDSMH = $value["ID_DSMH"];
                if (isset($countList[$idDSMH])) {
                    $countList[$idDSMH]++;
                } else {
                    $countList[$idDSMH] = 1;
                }
            }
        ?>
        <?php  foreach ($data["data"] as $key => $value) { ?>

        <tr>

            <?php $checkdkmh = false; 
                $het = false;
                if($value["conLai"] == 0){
                    $het=true;
                }
                if ($countList[$value["ID_DSMH"]] > 1) { ?>

            <th scope="row" rowspan="<?php echo $countList[$value["ID_DSMH"]]; ?>">

                <?php foreach ($data["dsmhdk"] as $v) {
                    
                    if($v["IDHP"]==$value["ID_DSMH"]){
                        $checkdkmh = true;
                    }
                    
                }  
                foreach ($data["dsmhdl"] as $v) {
                    
                    if($v["ID_DSMH"]==$value["ID_DSMH"]){
                        $checkdkmh = true;
                    }
                    
                }  
                
                
                
                if($checkdkmh == true){
                    if($het==false){
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)' checked>";
                    }
                    else{
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)' checked disabled>";
                    }
                    
                }
                else{
                    if($het==false){
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)'  >";
                    }
                    else{
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)' disabled >";
                    }
                    
                }
                ?>


            </th>
            <td rowspan="<?php echo $countList[$value["ID_DSMH"]]; ?>"><?php  echo $value["ID_MONHOC"]  ?></td>
            <td rowspan="<?php echo $countList[$value["ID_DSMH"]]; ?>"><?php  echo $value["TEN"]  ?></td>
            <td rowspan="<?php echo $countList[$value["ID_DSMH"]]; ?>"><?php  echo $value["ID_DSMH"]  ?></td>
            <td rowspan="<?php echo $countList[$value["ID_DSMH"]]; ?>"><?php  echo $value["TIN_CHI"]  ?></td>
            <td rowspan="<?php echo $countList[$value["ID_DSMH"]]; ?>"><?php  echo $value["SL_SV"]  ?></td>
            <td rowspan="<?php echo $countList[$value["ID_DSMH"]]; ?>"><?php  echo $value["conLai"]  ?></td>

            <?php  $countList[$value["ID_DSMH"]] = -1 ?>

            <?php }
            if($countList[$value["ID_DSMH"]] == 1) { ?>

            <th scope="row">
                <?php 
                $checkdk = 0;
                foreach ($data["dsmhdk"] as $v) {
                    
                    if($v["IDHP"]==$value["ID_DSMH"]){
                        $checkdk = 1;
                    }
                    
                }  
                foreach ($data["dsmhdl"] as $v) {
                    
                    if($v["ID_DSMH"]==$value["ID_DSMH"]){
                        $checkdk = 1;
                    }
                    
                }  
                
                if($checkdk == 1){
                    if($het==false){
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)' checked>";
                    }
                    else{
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)' checked disabled>";
                    }
                }
                else{
                    if($het==false){
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)'  >";
                    }
                    else{
                        echo "
                        <input type='checkbox' name='checkbox1' value=' ".$value["ID_DSMH"]."'
                            onchange='handleCheckboxChange(this)' disabled >";
                    }
                        
                }
                
                
                ?>
            </th>
            <td><?php  echo $value["ID_MONHOC"]  ?></td>
            <td><?php  echo $value["TEN"]  ?></td>
            <td><?php  echo $value["ID_DSMH"]  ?></td>
            <td><?php  echo $value["TIN_CHI"]  ?></td>
            <td><?php  echo $value["SL_SV"]  ?></td>
            <td><?php  echo $value["conLai"]  ?></td>

            <?php } ?>

            <td><?php  echo $value["THU"]  ?></td>
            <td><?php  echo $value["TIET_BAT_DAU"]  ?></td>
            <td><?php  echo $value["TIET_KET_THUC"]  ?></td>
            <td><?php  echo $value["LOP"]  ?></td>
            <td><?php  echo $value["tenGV"]  ?></td>
            <td><?php  echo $value["TUANHOC"]  ?></td>



        </tr>
        <?php } ?>
    </tbody>
</table>

<h1>Danh Sach Mon Hoc Da Chon</h1>
<div>
    <button onclick="luuDK()">Luu Dang Ky</button>
    <button onclick="xoaDK()">Xoa</button>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ma MH</th>
            <th scope="col">Ten Mon Hoc</th>
            <th scope="col">NMH</th>
            <th scope="col">STC</th>
            <th scope="col">Hoc Phi</th>
            <th scope="col">Trang Thai Mon Hoc</th>
            <th scope="col"></th>

        </tr>
    </thead>
    <tbody id="dsmhdk">
        <?php 
        $i = 1;
        foreach ($data["dsmhdk"] as $key => $value) { 
            
        ?>
        <tr>

            <th scope="row"><?php echo $i;$i=$i+1;  ?></th>
            <td><?php echo $value["ID"] ?></td>
            <td><?php echo $value["TEN"] ?></td>
            <td><?php echo $value["IDHP"] ?></td>
            <td><?php echo $value["TIN_CHI"] ?></td>
            <td><?php echo $value["hocPhi"] ?></td>
            <td>Chưa lưu vào CSDL</td>
            <td><input type="checkbox" class="cbMH" value="<?php echo $value["IDHP"] ?>"></td>


        </tr>
        <?php  }  ?>

        <?php 
        foreach ($data["dsmhdl"] as $key => $value) { 
            
        ?>
        <tr>

            <th scope="row"><?php echo $i;$i=$i+1;  ?></th>
            <td><?php echo $value["ID"] ?></td>
            <td><?php echo $value["TEN"] ?></td>
            <td><?php echo $value["ID_DSMH"] ?></td>
            <td><?php echo $value["TIN_CHI"] ?></td>
            <td><?php echo $value["hocPhi"] ?></td>
            <td>Đã lưu vào CSDL</td>
            <td><input type="checkbox" class="cbMH" value="<?php echo $value["ID_DSMH"] ?>"></td>

        </tr>
        <?php  }  ?>

    </tbody>
</table>










<script>
var dsmhdk = document.getElementById("dsmhdk")

function timKiem() {
    var text = document.getElementById("txtTimKiem").value
    window.location.href = "http://localhost/Home/DKMH?ma=" + text;
}

function giaoDien(dsmh, dsmhdl) {
    var html = ""
    var i = 1
    dsmh.forEach(e => {
        var ten = e.TEN
        var id = e.ID
        var idhp = e.IDHP
        var tinchi = e.TIN_CHI
        var hocphi = e.hocPhi
        html += `
        <tr>

            <th scope="row">${i}</th>
            <td>${ten}</td>
            <td>${id}</td>
            <td>${idhp}</td>
            <td>${tinchi}</td>
            <td>${hocphi}</td>
            <td>Chưa lưu vào CSDL</td>
            <td><input type="checkbox" class="cbMH" value="${idhp}"></td>
            

        </tr>
        `
        i = i + 1
    });

    dsmhdl.forEach(e => {
        var ten = e.TEN
        var id = e.ID
        var idhp = e.ID_DSMH
        var tinchi = e.TIN_CHI
        var hocphi = e.hocPhi
        html += `
        <tr>

            <th scope="row">${i}</th>
            <td>${ten}</td>
            <td>${id}</td>
            <td>${idhp}</td>
            <td>${tinchi}</td>
            <td>${hocphi}</td>
            <td>Đã lưu vào CSDL</td>
            <td><input type="checkbox" class="cbMH" value="${idhp}"></td>
            

        </tr>
        `
        i = i + 1
    });


    dsmhdk.innerHTML = html


}


function handleCheckboxChange(checkbox) {

    if (checkbox.checked) {
        var ID_DSMH = checkbox.value;
        const data = {
            id_dsmh: ID_DSMH,

        };

        fetch("http://localhost/Home/themMH", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data["error"] != null) {
                    alert(data["error"])
                    window.location.href = "http://localhost/Home/DKMH";
                }
                giaoDien(data["dsmhdk"], data["dsmhdl"])
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    } else {
        var ID_DSMH = checkbox.value;
        const data = {
            id_dsmh: ID_DSMH,
        };

        fetch("http://localhost/Home/xoaMH", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data["error"] != null) {
                    alert(data["error"])
                }
                giaoDien(data["dsmhdk"], data["dsmhdl"])

            })
            .catch((error) => {
                console.error("Error:", error);
            });


    }
}

function luuDK() {
    var checkboxes = document.getElementsByClassName("cbMH");
    var selectedValues = [];
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type === "checkbox" && checkboxes[i].checked) {
            var value = checkboxes[i].value;
            selectedValues.push(value);
        }
    }

    console.log("Các giá trị đã được chọn:", selectedValues);
    const data = {
        id_dsmh: selectedValues,
    };
    fetch("http://localhost/Home/luuMH", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data["error"] != null) {
                alert(data["error"])
            }
            giaoDien(data["dsmhdk"], data["dsmhdl"])
        })
        .catch((error) => {
            console.error("Error:", error);
        });

}

function xoaDK() {
    var checkboxes = document.getElementsByClassName("cbMH");
    var selectedValues = [];
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].type === "checkbox" && checkboxes[i].checked) {
            var value = checkboxes[i].value;
            selectedValues.push(value);
        }
    }

    console.log("Các giá trị đã được chọn:", selectedValues);
    const data = {
        id_dsmh: selectedValues,
    };
    fetch("http://localhost/Home/xoaDK", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data["error"] != null) {
                alert(data["error"])
            }
            giaoDien(data["dsmhdk"], data["dsmhdl"])
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
</script>
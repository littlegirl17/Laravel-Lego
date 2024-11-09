let province;
let selectProvince;

fetch(
    "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json"
)
    .then((res) => res.json())
    .then((data) => {
        // console.log(data);
        //gán dữ liệu dưới dạng mảng cho "tinh"
        province = Array.from(data);

        province.map(
            (value) =>
                (document.getElementById(
                    "province"
                ).innerHTML += `<option value='${value.Id}'>${value.Name}</option>`)
        );
    })
    .catch((error) => {
        console.error("Error data", error);
    });

// bắt sự kiện thay đổi cho thẻ  select  của tỉnh/thành phố
document.getElementById("province").addEventListener("change", function () {
    // Lấy giá trị của tỉnh/thành phố được chọn
    let provinceId = this.value; //value này chính là cái Id

    //Tìm tỉnh thành đc chọn trong danh sách tỉnh thành đã fetch ra
    selectProvince = province.find((tinhthanh) => tinhthanh.Id === provinceId);

    //nếu tỉnh được chọn tồn tại
    if (selectProvince) {
        let districtSelect = document.getElementById("district");
        let wardsSelect = document.getElementById("ward");

        //xóa tất cả tùy chọn hiện có trong thẻ select : nghĩa là khi chưa chọn thì show Quận/Huyện lên, chọn rồi thì xóa nó đi
        districtSelect.innerHTML =
            "<option selected disabled>Quận/Huyện</option>";
        wardsSelect.innerHTML = "<option selected disabled>Phường/Xã</option>";

        //Duyệt qua danh sách các quận huyện của tỉnh/city
        selectProvince.Districts.forEach((district) => {
            // Thêm tùy chọn mới cho mỗi quận/huyện
            districtSelect.innerHTML += `<option value='${district.Id}'>${district.Name}</option>`;
        });
    }
});

//bắt sự kiện thay đổi cho thẻ select của quận huyện
document.getElementById("district").addEventListener("change", function () {
    let districtId = this.value;

    let selectDistrict = selectProvince.Districts.find(
        (district) => district.Id === districtId
    );

    if (selectDistrict) {
        let wardsSelect = document.getElementById("ward");

        wardsSelect.innerHTML = "<option selected disabled>Phường/Xã</option>";

        //nếu selectDistrict nàu tồn tại (quận huyện) thì mình foreach ra đẻ lấy phường xã
        selectDistrict.Wards.forEach((ward) => {
            wardsSelect.innerHTML += `<option value='${ward.Id}' >${ward.Name}</option>`;
        });
    }
});

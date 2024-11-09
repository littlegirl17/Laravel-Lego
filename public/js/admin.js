var alertMessage = document.querySelectorAll("#alert-message");
alertMessage.forEach((item) => {
    setTimeout(() => {
        item.classList.add("fade-out-left");
        setTimeout(() => {
            item.style.display = "none";
        }, 500);
    }, 3000);
});

/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

const sidebarItems = document.querySelectorAll(".sidebar-item");

sidebarItems.forEach((item) => {
    item.addEventListener("click", () => {
        // Xóa lớp active từ tất cả các mục
        sidebarItems.forEach((el) => el.classList.remove("active"));

        // Thêm lớp active cho mục hiện tại
        item.classList.add("active");
    });
});

/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            document.getElementById("preview").innerHTML =
                '<img src="' +
                event.target.result +
                '" width="300" height="300" />';
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}

document.getElementById("HinhAnh").addEventListener("change", function () {
    imagePreview(this);
});
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
$(document).ready(function () {
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function (event) {
                $(fileInput)
                    .closest(".custom-file")
                    .find(".previewImages")
                    .html(
                        '<img src="' +
                            event.target.result +
                            '" width="300" height="300"/>'
                    );
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    // Gán sự kiện cho input file mới
    $(document).on("change", ".imageInputJS", function () {
        imagePreview(this);
    });
});
/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
function toggleSlug() {
    const offSlug = document.getElementById("off_slug");
    const slugInput = document.getElementById("slug");

    if (offSlug.checked) {
        slugInput.removeEventListener("keyup", ChangeToSlug);
    } else {
        slugInput.addEventListener("keyup", ChangeToSlug);
    }
}

function ChangeToSlug() {
    const offSlug = document.getElementById("off_slug");
    const inputElement = document.getElementById("slug");

    // Kiểm tra nếu phần tử input tồn tại và không null
    if (!inputElement) {
        console.error("Không tìm thấy phần tử 'slug'.");
        return;
    }
    if (offSlug.checked) return; // Không làm gì nếu checkbox được chọn

    var slug;

    //Lấy text từ thẻ input title
    slug = document.getElementById("slug").value;
    slug = slug.toLowerCase();
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
    slug = slug.replace(/đ/gi, "d");
    //Xóa các ký tự đặt biệt
    slug = slug.replace(
        /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
        ""
    );
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, "-");
    slug = slug.replace(/\-\-\-\-/gi, "-");
    slug = slug.replace(/\-\-\-/gi, "-");
    slug = slug.replace(/\-\-/gi, "-");
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = "@" + slug + "@";
    slug = slug.replace(/\@\-|\-\@|\@/gi, "");
    //In slug ra textbox có id “slug”
    document.getElementById("convert_slug").value = slug;
}

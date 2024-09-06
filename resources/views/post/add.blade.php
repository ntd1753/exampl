<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <script src="https://cdn.tiny.cloud/1/ju9oytkgovjt42g1goz4bbx8ah5w7br05qbg396440cuw7ty/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tinymce.init({
            selector: 'textarea#content',
            plugins: ' anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
            file_picker_callback(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight

                tinymce.activeEditor.windowManager.openUrl({
                    url: '/file-manager/tinymce5',
                    title: 'Laravel File manager',
                    width: x * 0.8,
                    height: y * 0.8,
                    onMessage: (api, message) => {
                        console.log(message)
                        let url = message.content; // Lấy ra url của file ảnh
                        url = url.replace(/^.*\/\/[^\/]+/, ''); // Xóa domain ảnh
                        console.log(url);
                        message.content = url // Gán lại url cho ảnh
                        callback(message.content, {
                            text: message.text
                        })
                    },

                })
            }

        });
        tinymce.init({
            selector: 'textarea#Seo',
            height: 300,
            toolbar: 'undo redo',
            content_css: false,
            menu: false,
            menubar: false,
        });
    </script>
</head>

<body>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add Post
        </h2>
    </div>
    <form id="postForm" enctype="multipart/form-data">

        @csrf
        <div class="intro-y box p-5 mt-5">
            <div class=" p-5">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">Post Category</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <select id="category" class="w-full mt-2 p-2 border 2" name="category_id">

                                    <option value="1"> blog homestay</option>
                                    <option value="2"> blog thiên nhiên</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-10">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">Link Preview Image</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1 relative">
                                <input type="file" name="images" accept="image/*" class="w-full border-2 p-2 "
                                    id="button-up-image" required>

                            </div>
                        </div>
                    </div>
                    <div class="mt-5 ">
                        <div class="ml-5 font-medium w-full">
                            Preview Image
                        </div>
                        <div>
                            <img src="https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg"
                                id="img_preview" class="ml-5 mt-5 h-50 w-50">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="intro-y box p-5 mt-5 grid grid-cols-2 gap-4">
            <div>
                <div class="">
                    <label for="reviewName" class="">Tiêu đề bài viết:</label><br>
                    <input type="text" class="w-full mt-2 p-2 border-2" id="reviewName" name="name"
                        placeholder="Nhập tiêu đề bài viết ..." required>
                </div>

                <div class="mt-3">
                    <label for="description">Slug bài viết:</label><br>
                    <input type="text" class="w-full mt-2 p-2 border-2" id="description" name="slug"
                        placeholder="Nhập description.....">
                </div>
                <div class="mt-3">
                    <label for="content">Mô tả:</label><br>
                    <textarea class="w-full mt-2 p-2 border-2" id="content" name="description" placeholder="Nhập nội dung ....."></textarea>
                </div>
            </div>
            <div>
                <div class="">
                    <label for="reviewName" class="">SEO title:</label>
                    <input type="text" class="w-full mt-2 p-2 border-2" id="seo_title" name="seo_title"
                        placeholder="Nhập tiêu đề bài viết ...">
                </div>
                <div class="mt-3">
                    <label for="description">SEO keyword:</label>
                    <input type="text" class="w-full mt-2 p-2 border-2" id="seo_keyword" name="seo_keywords"
                        placeholder="Nhập description.....">
                </div>
                <div class="mt-3">
                    <label for="content">SEO description:</label>
                    {{--                    <input type="text" class="w-full mt-2 p-2 border-2" id="content" name="content" placeholder="Nhập nội dung ....." > --}}
                    <textarea class="w-full mt-2 p-2 border-2" id="Seo" name="seo_description" placeholder="Nhập nội dung ....."></textarea>
                </div>
            </div>
        </div>
        <div class="intro-y box p-5 mt-5">
            <label for="content">Nội dung bài viết:</label>
            <textarea class="w-full mt-2 p-2 border-2" id="content" name="content" placeholder="Nhập nội dung ....."></textarea>
        </div>
        <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
            <button type="submit" class="btn py-3 btn-primary w-full md:w-52">Save</button>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#button-up-image').click(function() {
                $('#upload-image').click();
            });
        });
        $(document).ready(function() {
            // Khi file trong input 'upload-image' thay đổi
            $('#button-up-image').change(function(event) {
                // Lấy file được chọn đầu tiên
                var file = event.target.files[0];
                // Tạo đối tượng FileReader
                var reader = new FileReader();
                // Định nghĩa hàm onload để xử lý sau khi file được đọc
                reader.onload = function(e) {
                    // Cập nhật thuộc tính 'src' của thẻ img với dữ liệu ảnh
                    $('#img_preview').attr('src', e.target.result);

                };

                // Đọc dữ liệu của file đã chọn
                reader.readAsDataURL(file);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function() {
            $('#postForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của form

                var formData = new FormData(this); // Tạo đối tượng FormData để chứa dữ liệu

                // Thêm CSRF token vào FormData nếu không được tự động thêm
                formData.append('_token', $('input[name="_token"]').val());

                $.ajax({
                    url: '{{ route('post.store') }}', // Đường dẫn tới route xử lý form
                    method: 'POST', // Phương thức gửi
                    data: formData, // Dữ liệu được gửi
                    processData: false, // Không xử lý dữ liệu vì đã dùng FormData
                    contentType: false, // Không thiết lập kiểu nội dung, tự động thiết lập bởi FormData
                    success: function(response) {
                        if (response.success) {
                            window.location.href='{{ route('post.index') }}';
                            // Có thể thêm hành động khác như chuyển hướng
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += value + '\n';
                        });
                        alert('Đã có lỗi xảy ra: \n' + errorMessage);
                    }
                });
            });
        });
    </script>


</body>

</html>

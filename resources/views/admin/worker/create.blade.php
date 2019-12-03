@extends('admin.layout.index')
@section('css')
    <style>
        *{margin: 0;padding: 0;}
        li{list-style-type: none;}
        a,input{outline: none;-webkit-tap-highlight-color:rgba(0,0,0,0);}
        #choose{display: none;}
        canvas{width: 100%;border: 1px solid #000000;}
        #upload_a{display: block;margin: 10px;height: 30px;text-align: center;line-height: 30px;border: 1px solid;border-radius: 5px;cursor: pointer;}
        #upload_b{display: block;margin: 10px;height: 30px;text-align: center;line-height: 30px;border: 1px solid;border-radius: 5px;cursor: pointer;}
        .touch{background-color: #ddd;}
        .img-list{margin: 10px 5px;}
        .img-list_a li{position: relative;display: inline-block;width: 150px;height: 150px;margin: 5px 5px 20px 5px;border: 1px solid rgb(100,149,198);background: #fff no-repeat center;background-size: cover;}
        .img-list_b li{position: relative;display: inline-block;width: 150px;height: 150px;margin: 5px 5px 20px 5px;border: 1px solid rgb(100,149,198);background: #fff no-repeat center;background-size: cover;}
        .progress_w{position: absolute;width: 100%;height: 20px;line-height: 20px;bottom: 0;left: 0;background-color:rgba(100,149,198,.5);}
        .progress span{display: block;width: 0;height: 100%;background-color:rgb(100,149,198);text-align: center;color: #FFF;font-size: 13px;}
        .size{position: absolute;width: 100%;height: 15px;line-height: 15px;bottom: -18px;text-align: center;font-size: 13px;color: #666;}
        .tips{display: block;text-align:center;font-size: 13px;margin: 10px;color: #999;}
        .pic-list{margin: 10px;line-height: 18px;font-size: 13px;}
        .pic-list a{display: block;margin: 10px 0;}
        .pic-list a img{vertical-align: middle;max-width: 30px;max-height: 30px;margin: -4px 0 0 10px;}
    </style>
    <link href="{{asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">



@endsection
@section('contend_head')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">我要派单</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">首页</a></li>
                                <li class="breadcrumb-item active" aria-current="page">发布需求</li>
                            </ol>
                        </nav>
                    </div>
                    {{--<div class="col-lg-6 col-5 text-right">--}}
                    {{--<a href="#" class="btn btn-sm btn-neutral">New</a>--}}
                    {{--<a href="#" class="btn btn-sm btn-neutral">Filters</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
@endsection
@section('contend')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-wrapper">
                <!-- Form controls -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">发布需求</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-md-8 center">
                        <form id="work_form">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="text-align: center;">

                                        <input type="file" id="card_a" accept="image/*" multiple>
                                        <ul class="img-list_a"></ul>
                                        <a id="upload_a">上传身份证正面照图片</a>
                                        {{--<label class="form-control-label" for="">项目名称</label>--}}
                                        {{--<input type="text" class="form-control" name="project_name" id="project_name" placeholder="项目名称">--}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" style="text-align: center;">
                                        <input type="file" id="card_b" accept="image/*" multiple>
                                        <ul class="img-list_b"></ul>
                                        <a id="upload_b">上传身份证反面照图片</a>
                                    </div>
                                </div>
                                <div class="pic-list">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>身份证号码 <span style="color: red">*</span></label>
                                <input type="text" name="card_num" id="card_num" class="form-control" placeholder="请输入身份证号码" required value="{{old('card_num')}}">
                            </div>
                            <div class="form-group">
                                <label>姓名 <span style="color: red">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="请输入姓名" required value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label>年龄 <span style="color: red">*</span></label>
                                <input type="text" name="age" id="age" class="form-control" placeholder="请输入年龄" required value="{{old('age')}}">
                            </div>
                            <div class="form-group">
                                <label>性别<span style="color: red">*</span></label>
                                <select class="form-control" name="sex" id="sex" >
                                    <option value="">请选择</option>
                                    <option value="1">男</option>
                                    <option value="2">女</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>手机 <span style="color: red">*</span></label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="请输入手机" required value="{{old('phone')}}">
                            </div>
                            <div class="form-group">
                                <label>邮箱</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="请输入邮箱" required value="{{old('email')}}">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">项目省分 </label>
                                        <select class="form-control" id="s_province" name="s_province" ></select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">市 </label>
                                        <select class="form-control" id="s_city" name="s_city" ></select> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group " >
                                        <label class="form-control-label">县 </label>
                                        <select class="form-control" id="s_county" name="s_county" ></select> 
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>施工技能 <span style="color: red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="tec" id="tec" type="radio" value="1">
                                    <label class="form-check-label">贴瓷砖</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="tec" id="tec" type="radio" value="2">
                                    <label class="form-check-label">除甲醛</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="tec" id="tec" type="radio" value="3">
                                    <label class="form-check-label">保洁</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="tec" id="tec" type="radio" value="4">
                                    <label class="form-check-label">瓦工</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="tec" id="tec" type="radio" value="5">
                                    <label class="form-check-label">油工</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="tec" id="tec" type="radio" value="6">
                                    <label class="form-check-label">水暖工</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>工作年限 <span style="color: red">*</span></label>
                                <input type="text" name="work_age" id="work_age" class="form-control" placeholder="工作年限" required value="{{old('work_age')}}">
                            </div>
                            <div class="form-group">
                                <label>其他工作技能</label>
                                <textarea class="form-control" name="tec_text" id="tec_text" rows="3" placeholder="其他工作技能" ></textarea>
                            </div>



                        </form>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="submit()">提交</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.zh-CN.min.js')}}"></script>
    <script src="{{asset('assets/vendor/moment/min/moment-with-locales.min.js')}}"></script>
    <script src="{{asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/js/area.js')}}" type="text/javascript"></script>
    <script type="text/javascript">_init_area();</script>
    <script type="text/javascript">

        var Gid  = document.getElementById ;

        var showArea = function(){

            Gid('show').innerHTML = "<h3>省" + Gid('s_province').value + " - 市" +

                Gid('s_city').value + " - 县/区" +

                Gid('s_county').value + "</h3>"

        }

        // Gid('s_county').setAttribute('onchange','showArea()');

    </script>
    <script>

        function submit() {

            var card_a = $('#card_as').val();
            var card_b = $('#card_bs').val();
            var card = $('#card_num').val();
            var name = $('#name').val();
            var age = $('#age').val();
            var sex = $('#sex').val();
            var phone = $('#phone').val();
            var province = $('#s_province').val();
            var city = $('#s_city').val();
            var county = $('#s_county').val();
            var work_age = $('#work_age').val();
            var tec = $('#tec').val();
            if(card_a === '') {
                toastr.warning('请上传身份证正面');
                return false;
            }
            if(card_b === '') {
                toastr.warning('请上传身份证反面');
                return false;
            }
            if(card === '') {
                toastr.warning('身份证号码不能为空');
                return false;
            }
            if(name === '') {
                toastr.warning('用户名不能为空');
                return false;
            }
            if(age === '') {
                toastr.warning('年龄不能为空');
                return false;
            }
            if(sex === '') {
                toastr.warning('性别不能为空');
                return false;
            }
            if(phone === '') {
                toastr.warning('电话不能为空');
                return false;
            }
            if(province === '省份') {
                toastr.warning('省分不能为空');
                return false;
            }
            if(city === '地级市') {
                toastr.warning('城市不能为空');
                return false;
            }
            if(county === '市、县级市') {
                toastr.warning('不能为空');
                return false;
            }
            if(work_age === '') {
                toastr.warning('工作年限不能为空');
                return false;
            }
            if(tec === '') {
                toastr.warning('工作年限不能为空');
                return false;
            }
            var formData = new FormData($('#work_form')[0]);

            $.ajax({
                type: 'POST',
                url: 'store',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                success : function (data) {
                    Swal.fire({
                        title: data.message,
                        type: 'success',
                        focusConfirm: false, //聚焦到确定按钮
                        showCloseButton: true,//右上角关闭
                        // timer: 2000
                    })
                },
                error : function (data) {
                    var json = JSON.parse(data.responseText);
                    toastr.warning(json.message);
                    // Swal.fire({
                    //     title: '错误',
                    //     text: json.message,
                    //     type: 'warning',
                    //     showCancelButton: true,
                    //     confirmButtonColor: '#3085d6',
                    //     cancelButtonColor: '#d33',
                    //     showConfirmButton:false,
                    //     cancelButtonText:'取消'
                    // });
                    return false;
                }
            })
        }
    </script>
    <script>
        var card_a = document.getElementById("card_a");
        var card_b = document.getElementById("card_b");
        //    用于压缩图片的canvas
        var canvas = document.createElement("canvas");
        var ctx = canvas.getContext('2d');
        //    瓦片canvas
        var tCanvas = document.createElement("canvas");
        var tctx = tCanvas.getContext("2d");
        var maxsize = 100 * 1024;
        function getID(me){
            var $id = $(me).attr("id")
            console.log($id)
        }
        $("#upload_a").on("click", function() {
            card_a.click();
        })
        $("#upload_b").on("click", function() {
            card_b.click();
        })
            .on("touchstart", function() {
                $(this).addClass("touch")
            })
            .on("touchend", function() {
                $(this).removeClass("touch")
            });

        card_a.onchange = function() {
            if (!this.files.length) return;
            var files = Array.prototype.slice.call(this.files);
            console.log(files.length)

            if (files.length > 1) {
                layer.msg("最多同时只可上传1张图片", 0);
                // alert("最多同时只可上传1张图片");
                return false;
            }

            files.forEach(function(file, i) {
                if (!/\/(?:jpeg|png|gif)/i.test(file.type)) return;
                var reader = new FileReader();
                var li = document.createElement("li");
//          获取图片大小
                var size = file.size / 1024 > 1024 ? (~~(10 * file.size / 1024 / 1024)) / 10 + "MB" : ~~(file.size / 1024) + "KB";
                li.innerHTML = '<div class="progress_w"><span></span></div><div class="size">' + size + '</div>';
                $(".img-list_a").append($(li));
                reader.onload = function() {
                    var result = this.result;
                    var img = new Image();
                    img.src = result;
                    $(li).css("background-image", "url(" + result + ")");
                    //如果图片大小小于100kb，则直接上传
                    if (result.length <= maxsize) {
                        img = null;
                        var imgaa = img_a();
                        console.log(imgaa)
                        upload(result, file.type, $(li),imgaa);
                        return;
                    }
//      图片加载完毕之后进行压缩，然后上传
                    if (img.complete) {
                        callback();
                    } else {
                        img.onload = callback;
                    }

                    function callback() {
                        var data = compress(img);
                        var imgaa = img_a();
                        // console.log(card_a.id)
                        upload(data, file.type, $(li),imgaa);
                        img = null;
                    }
                };
                reader.readAsDataURL(file);
            })
        };
        card_b.onchange = function() {
            if (!this.files.length) return;
            var files = Array.prototype.slice.call(this.files);
            if (files.length > 1) {
                layer.msg("最多同时只可上传1张图片", 0);
                // alert("最多同时只可上传1张图片");
                return false;
            }
            files.forEach(function(file, i) {
                if (!/\/(?:jpeg|png|gif)/i.test(file.type)) return;
                var reader = new FileReader();
                var li = document.createElement("li");
//          获取图片大小
                var size = file.size / 1024 > 1024 ? (~~(10 * file.size / 1024 / 1024)) / 10 + "MB" : ~~(file.size / 1024) + "KB";
                li.innerHTML = '<div class="progress_w"><span></span></div><div class="size">' + size + '</div>';
                $(".img-list_b").append($(li));
                reader.onload = function() {
                    var result = this.result;
                    var img = new Image();
                    img.src = result;
                    $(li).css("background-image", "url(" + result + ")");
                    //如果图片大小小于100kb，则直接上传
                    if (result.length <= maxsize) {
                        img = null;
                        var imgbb = img_b();
                        upload(result, file.type, $(li),imgbb);
                        return;
                    }
//      图片加载完毕之后进行压缩，然后上传
                    if (img.complete) {
                        callback();
                    } else {
                        img.onload = callback;
                    }
                    function callback() {
                        var data = compress(img);
                        var imgbb = img_b();
                        upload(data, file.type, $(li),imgbb);
                        img = null;
                    }
                };
                reader.readAsDataURL(file);
            })
        };
        function img_a() {
            var img_a = document.getElementById("card_a");
            return img_a.id;
        }
        function img_b() {
            var img_b = document.getElementById("card_b");
            return img_b.id;
        }
        //    使用canvas对大图片进行压缩
        function compress(img) {
            var initSize = img.src.length;
            var width = img.width;
            var height = img.height;
            //如果图片大于四百万像素，计算压缩比并将大小压至400万以下
            var ratio;
            if ((ratio = width * height / 4000000) > 1) {
                ratio = Math.sqrt(ratio);
                width /= ratio;
                height /= ratio;
            } else {
                ratio = 1;
            }
            canvas.width = width;
            canvas.height = height;
//        铺底色
            ctx.fillStyle = "#fff";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            //如果图片像素大于100万则使用瓦片绘制
            var count;
            if ((count = width * height / 1000000) > 1) {
                count = ~~(Math.sqrt(count) + 1); //计算要分成多少块瓦片
//            计算每块瓦片的宽和高
                var nw = ~~(width / count);
                var nh = ~~(height / count);
                tCanvas.width = nw;
                tCanvas.height = nh;
                for (var i = 0; i < count; i++) {
                    for (var j = 0; j < count; j++) {
                        tctx.drawImage(img, i * nw * ratio, j * nh * ratio, nw * ratio, nh * ratio, 0, 0, nw, nh);
                        ctx.drawImage(tCanvas, i * nw, j * nh, nw, nh);
                    }
                }
            } else {
                ctx.drawImage(img, 0, 0, width, height);
            }
            //进行最小压缩
            var ndata = canvas.toDataURL('image/jpeg', 0.1);
            console.log('压缩前：' + initSize);
            console.log('压缩后：' + ndata.length);
            console.log('压缩率：' + ~~(100 * (initSize - ndata.length) / initSize) + "%");
            tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0;
            return ndata;
        }
        //    图片上传，将base64的图片转成二进制对象，塞进formdata上传
        function upload(basestr, type, $li,img_id) {
            var text = window.atob(basestr.split(",")[1]);
            var buffer = new Uint8Array(text.length);
            var pecent = 0, loop = null;
            for (var i = 0; i < text.length; i++) {
                buffer[i] = text.charCodeAt(i);
            }
            var blob = getBlob([buffer], type);
            var xhr = new XMLHttpRequest();
            var formdata = getFormData();
            formdata.append('imagefile', blob);
            formdata.append('img_id', img_id);
            xhr.open('post', '/admin/worker/image/upload');
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="_token"]').attr('content'));
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var jsonData = JSON.parse(xhr.responseText);
                    console.log(jsonData);
                    var imagedata = jsonData[0] || {};
                    var text = imagedata.path ? '上传成功' : '上传失败';
                    console.log(text + '：' + imagedata.path);
                    clearInterval(loop);
                    //当收到该消息时上传完毕
                    $li.find(".progress_w span").animate({'width': "100%"}, pecent < 95 ? 200 : 0, function() {
                        $(this).html(text);
                    });
                    if(jsonData.img_id === 'card_as')
                    {
                        document.getElementById("card_a").style.display = "none";
                        document.getElementById("upload_a").style.display = "none";
                    }
                    if(jsonData.img_id === 'card_bs')
                    {
                        document.getElementById("card_b").style.display = "none";
                        document.getElementById("upload_b").style.display = "none";
                    }
                    if (!imagedata.path) return;
                    // $(".pic-list").append('<a href="' + imagedata.path + '">' + imagedata.name + '（' + imagedata.size + '）<img src="' + imagedata.path + '" /></a>');
                    $(".pic-list").append('<input type="hidden" id="'+jsonData.img_id+'" name="'+jsonData.img_id+'" value="'+jsonData.data.img+'" />');

                }
            };
            //数据发送进度，前50%展示该进度
            xhr.upload.addEventListener('progress_w', function(e) {
                if (loop) return;
                pecent = ~~(100 * e.loaded / e.total) / 2;
                $li.find(".progress_w span").css('width', pecent + "%");
                if (pecent == 50) {
                    mockProgress();
                }
            }, false);
            //数据后50%用模拟进度
            function mockProgress() {
                if (loop) return;
                loop = setInterval(function() {
                    pecent++;
                    $li.find(".progress_w span").css('width', pecent + "%");
                    if (pecent == 99) {
                        clearInterval(loop);
                    }
                }, 100)
            }
            xhr.send(formdata);
        }
        /**
         * 获取blob对象的兼容性写法
         * @param buffer
         * @param format
         * @returns {*}
         */
        function getBlob(buffer, format) {
            try {
                return new Blob(buffer, {type: format});
            } catch (e) {
                var bb = new (window.BlobBuilder || window.WebKitBlobBuilder || window.MSBlobBuilder);
                buffer.forEach(function(buf) {
                    bb.append(buf);
                });
                return bb.getBlob(format);
            }
        }
        /**
         * 获取formdata
         */
        function getFormData() {
            var isNeedShim = ~navigator.userAgent.indexOf('Android')
                && ~navigator.vendor.indexOf('Google')
                && !~navigator.userAgent.indexOf('Chrome')
                && navigator.userAgent.match(/AppleWebKit\/(\d+)/).pop() <= 534;
            return isNeedShim ? new FormDataShim() : new FormData()
        }
        /**
         * formdata 补丁, 给不支持formdata上传blob的android机打补丁
         * @constructor
         */
        function FormDataShim() {
            console.warn('using formdata shim');
            var o = this,
                parts = [],
                boundary = Array(21).join('-') + (+new Date() * (1e16 * Math.random())).toString(36),
                oldSend = XMLHttpRequest.prototype.send;
            this.append = function(name, value, filename) {
                parts.push('--' + boundary + '\r\nContent-Disposition: form-data; name="' + name + '"');
                if (value instanceof Blob) {
                    parts.push('; filename="' + (filename || 'blob') + '"\r\nContent-Type: ' + value.type + '\r\n\r\n');
                    parts.push(value);
                }
                else {
                    parts.push('\r\n\r\n' + value);
                }
                parts.push('\r\n');
            };
            // Override XHR send()
            XMLHttpRequest.prototype.send = function(val) {
                var fr,
                    data,
                    oXHR = this;
                if (val === o) {
                    // Append the final boundary string
                    parts.push('--' + boundary + '--\r\n');
                    // Create the blob
                    data = getBlob(parts);
                    // Set up and read the blob into an array to be sent
                    fr = new FileReader();
                    fr.onload = function() {
                        oldSend.call(oXHR, fr.result);
                    };
                    fr.onerror = function(err) {
                        throw err;
                    };
                    fr.readAsArrayBuffer(data);
                    // Set the multipart content type and boudary
                    this.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
                    XMLHttpRequest.prototype.send = oldSend;
                }
                else {
                    oldSend.call(this, val);
                }
            };
        }
    </script>
@endsection
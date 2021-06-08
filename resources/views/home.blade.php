@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #393300;
        }

        h1#headerNames {
            margin-top: 10%;
            color: rgb(39, 34, 34);
            font-family: Georgia, serif;
            font-size: 40px;
            text-align: center;
            cursor: pointer;
        }

        .button {
            /* width: 150px; */
            /* margin: auto; */
            padding: 5px;
            background: #1fa91f;
            border: 3px solid #fff;
            border-radius: 10px;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            cursor: pointer;
        }

        #stopButton {
            background: #ff0000;
            display: none;
        }

        #timerWrapper {
            margin: 50px 0;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 50px;
            text-align: center;
            opacity: 0;
            transition: opacity 1s;
        }

        #timerWrapper.visible {
            opacity: 1;
        }

        #timesUp {
            padding-top: 20%;
            background-color: red;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 100px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            display: none;
        }

        #timesUp a {
            margin: 100px auto;
            font-size: 15px;
            position: absolute;
            bottom: 50px;
            left: 0;
            right: 0;
            display: none;
        }

        #timesUp.backgroundRed {
            background-color: #333;
        }

        @media only screen and (max-width: 600px) {
            h1 {
                font-size: 50px;
            }
        }

    </style>
    <script>
        function addPost() {
            $("#post_id").val('');
            $("#name").val('');
            $("#tel").val('');
            $("#username").val('');
            $("#text_addcus").html("เพิ่มรายชื่อ");
            $('#post-modal').modal('show');
        }

        function resetInput() {
            $('#nameError').text("");
            $('#usernameError').text("");
            $('#telError').text("");
        }
        var countRow = 0;

        function createPost() {
            Swal.fire({
                title: 'คุณแน่ใจใช่หรือไม่?',
                text: "คุณต้องการบันทีกใช่หรือไม่?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    var name = $("#name").val();
                    var tel = $("#tel").val();
                    var username = $("#username").val();
                    var id = $("#post_id").val();
                    // console.log(name,username,post_id,tel);
                    resetInput();

                    let _url = '{{ route('magate.custommer.addOrUpdate') }}';
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: _url,
                        type: "POST",
                        data: {
                            id: id,
                            username: username,
                            tel: tel,
                            name: name,
                            _token: _token,
                        },
                        success: function(res) {
                            // console.log("สำเร็จ");

                            if (id != "") {
                                $("#table_crud #row_" + id + " td:nth-child(2)").html(res.data.name);
                                $("#table_crud #row_" + id + " td:nth-child(3)").html(res.data
                                .username);
                                $("#table_crud #row_" + id + " td:nth-child(4)").html(res.data.tel);

                                $("#table_random #row_" + id + " td:nth-child(1)").html(res.data.name);
                                $("#table_random #row_" + id + " td:nth-child(2)").html(res.data
                                    .username);
                                $("#table_random #row_" + id + " td:nth-child(3)").html(res.data.tel);
                            } else {
                                $('#table_crud tbody').prepend("<tr id='row_" + res.data.id + "'" +
                                    ">" +

                                    "<th id='td_choese" +
                                    "' class='align-middle' hidden='true'>" +
                                    "<div align='center'>" +
                                    "<input type='checkbox' class='form-check' name='select'" +
                                    "id='select_input' value='" + res.data.id + "'>" +
                                    "</div>" +
                                    "</th>" +

                                    "<td>" + res.data.name + "</td>" +
                                    "<td>" + res.data.username + "</td>" +
                                    "<td>" + res.data.tel + "</td>" +
                                    "<td align='center'>" +
                                    "<a href='javascript:void(0)' class='btn btn-warning'" +
                                    "data-id='" + res.data.id +
                                    "' onclick='editPost(event.target)' id='btn_edit'>แก้ไข</a> " +
                                    " <a href='javascript:void(0)' class='btn btn-danger'" +
                                    "data-id='" + res.data.id +
                                    "' onclick='deletePost(event.target)' id='btn_delete'>ลบ</a>" +
                                    "</td>" +
                                    "</tr>"
                                );
                            }
                            Swal.fire(
                                'สำเร็จ!',
                                'ข้อมูลของท่านถูกบันทึกเรียบร้อยแล้ว',
                                'success'
                            )
                            $('#post-modal').modal('hide');
                            countRow++;
                        },
                        error: function(err) {
                            console.log("ไม่สำเร็จ");
                            $('#nameError').text(err.responseJSON.errors.name);
                            $('#usernameError').text(err.responseJSON.errors.username);
                            $('#telError').text(err.responseJSON.errors.tel);
                        }
                    });
                }
            })

        }

        function editPost(event) {
            var id = $(event).data("id");
            let _url = "/magate/custommer/getData/" + id;
            text_addcus
            $("#text_addcus").html("แก้ไขรายชื่อ");
            resetInput();
            $.ajax({
                url: _url,
                type: "GET",
                success: function(res) {
                    //console.log(_url);
                    if (res) {
                        $("#post_id").val(res.id);
                        $("#name").val(res.name);
                        $("#tel").val(res.tel);
                        $("#username").val(res.username);
                        $('#post-modal').modal('show');
                    }
                }
            });
        }

        function deletePost(event) {
            Swal.fire({
                title: 'คูณแน่ใจใช่หรือไม่?',
                text: "คุณต้องการลบข้อมูลใช่หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(event).data("id");
                    let _url = "/magate/custommer/delete/" + id;
                    let _token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: _url,
                        type: "DELETE",
                        data: {
                            _token: _token,
                        },
                        success: function(res) {
                            console.log(res);
                            if (res.code == '200') {
                                $("#row_" + id).remove();
                                Swal.fire(
                                    'สำเร็จ!',
                                    'ข้อมูลถูกลบเรียบร้อยแล้ว',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'ไม่สำเร็จ!',
                                    res.error,
                                    'error'
                                )
                            }

                        }

                    });
                }
            })

        }

        function modalRandomClick() {
            $('#exampleModalCenter').modal('show');
        }


        function showTable_Crud(e) {
            var name = e.innerHTML;
            // console.log(name);
            if (name == "แสดง") {
                document.getElementById("card_adduser").hidden = false;
                e.innerHTML = "ซ่อน"
            } else {
                document.getElementById("card_adduser").hidden = true;
                e.innerHTML = "แสดง"

            }
        }

    </script>

    <script>
        function showInputChouse(event) {
            var create_new_post = document.getElementById("create-new-post");
            var btn_chouse = document.getElementById("btn_chouse");
            var delete_select = document.getElementById("delete_select");
            var chk = btn_chouse.getAttribute("status");
            var reset_select = document.getElementById("reset_select");
            var select_all = document.getElementById("select_all");
            if (chk == 0) {
                document.getElementById("th_choese").hidden = false;
                $("[id='td_choese']").prop('hidden', false);
                $("[id='th_choese']").prop('hidden', false);
                $("[id='btn_delete']").prop('hidden', true);

                // console.log("fwf")
                //ปุ่มยกเลิก
                btn_chouse.innerHTML = "ยกเลิก";
                btn_chouse.setAttribute("status", "1");
                btn_chouse.setAttribute("class", "btn btn-warning");
                //ปุ้มเพิ่มรรายชื่อ
                create_new_post.hidden = true;
                //ปุ่มลบทั้งหมด
                delete_select.hidden = false;
                //reset
                reset_select.hidden = false;
                //เลือกทั้งหมด
                select_all.hidden = false;

            } else {

                document.getElementById("th_choese").hidden = true;
                $("[id='td_choese']").prop('hidden', true);
                $("[id='th_choese']").prop('hidden', true);
                $("[id='btn_delete']").prop('hidden', false);

                //เลือก
                btn_chouse.innerHTML = "เลือก";
                btn_chouse.setAttribute("status", "0");
                btn_chouse.setAttribute("class", "btn btn-info");
                //ปุ้มเพิ่มรรายชื่อ
                create_new_post.hidden = false;
                //ปุ่มลบทั้งหมด
                delete_select.hidden = true;
                //reset
                reset_select.hidden = true;
                //เลือกทั้งหมด
                select_all.hidden = true;
                this.reset_select();
            }

            console.log(chk);

        }

        function select_delete() {
            var arr = [];
            var _url = "{{ route('magate.custommer.delete_all') }}";
            let _token = $('meta[name="csrf-token"]').attr('content');
            $("input:checkbox[name=select]:checked").each(function() {
                arr.push({
                    id: $(this).val()
                });
            });
            var filtarr = arr.filter(function(el) {
                return el != null;
            });
            //  console.log(arr);

            if (filtarr.length > 0) {
                Swal.fire({
                    title: 'คุณแน่ใจใช่หรือไม่?',
                    text: "คุณต้องการลบข้อมูลที่เลือกใช่หรือไม่?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: _url,
                            data: {
                                _token: _token,
                                pass: filtarr,
                            },
                            success: function(res) {
                                console.log("Sucess");
                                if (res.code == '200') {
                                    var response = res.data;
                                    // console.log(response[0].id);
                                    for (let i = 0; i < response.length; i++) {
                                        $("#row_" + response[i].id).remove();
                                        // console.log(response[i].id)
                                    }
                                    Swal.fire(
                                        'สำเร็จ!',
                                        res.message,
                                        'success'
                                    )
                                }
                            },
                            error: function(err) {
                                Swal.fire(
                                    'เกิดข้อผิดพลาด!',
                                    "เกิดข้อผิดพลาดบางอย่าง",
                                    'error',
                                )
                            }
                        });
                    }
                })
            } else {
                Swal.fire(
                    'มีข้อผิดพลาด!',
                    "คุณยังไม่ได้เลือกรายการ",
                    'warning'
                )
            }

        }

        function select_all() {
            $("[id='select_input']").prop('checked', true);
        }

        function reset_select() {
            $("[id='select_input']").prop('checked', false);

        }

    </script>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="mb-3 d-flex justify-content-between">
                    <a href="javascript:void(0)" class="btn btn-secondary" onclick="showTable_Crud(this)">แสดง</a>
                    <a href="javascript:void(0)" id="btnModalRan" class="btn btn-warning" onclick="modalRandomClick()">
                        สุ่มรายชื่อ
                    </a>
                </div>
                <div class="card mb-3 border-secondary text-white" style="background-color: #91810B">
                    <div class="card-header">{{ __('เพิ่มรายชื่อ') }}</div>
                    <div class="card-body" hidden="true" id="card_adduser">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- <div id="timer"></div>
                        <input type="button" id="startx" value="start" /> --}}


                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-success" hidden="true" id="select_all"
                                    onclick="select_all()">เลือกทั้งหมด</a>
                                <a href="javascript:void(0)" class="btn btn-info" hidden="true" id="reset_select"
                                    onclick="reset_select()">รีเซต</a>
                            </div>
                            <div align="right">
                                <button class="btn btn-info" status="0" onclick="showInputChouse(event)"
                                    id="btn_chouse">เลือก</button>
                                <a href="javascript:void(0)" class="btn btn-danger" hidden="true" id="delete_select"
                                    onclick="select_delete()">ลบข้อมูลที่เลือก</a>

                                <a href="javascript:void(0)" class="btn btn-success " id="create-new-post"
                                    onclick="addPost()">เพิ่มรายชื่อ</a>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered table-striped table-dark"
                                id="table_crud">
                                <thead>
                                    <tr align="center">
                                        <th id="th_choese" hidden>เลือก</th>
                                        <th scope="col">ชื่อ-สกุล</th>
                                        <th scope="col">ชื่อผู้ใช้</th>
                                        <th scope="col">เบอร์โทร</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($customers as $customer)
                                        <tr id="row_{{ $customer->id }}">
                                            <th id="td_choese" class="align-middle" hidden>
                                                <div align="center">
                                                    <input type="checkbox" class="form-check" name="select"
                                                        id="select_input" value="{{ $customer->id }}">
                                                </div>
                                            </th>
                                            <td class="align-middle">{{ $customer->name }}</td>
                                            <td class="align-middle">{{ $customer->username }}</td>
                                            <td class="align-middle">{{ $customer->tel }}</td>
                                            <td class="align-middle" align="center">
                                                <a href="javascript:void(0)" class="btn btn-warning"
                                                    data-id="{{ $customer->id }}" onclick="editPost(event.target)"
                                                    id='btn_edit'>แก้ไข</a>
                                                <a href="javascript:void(0)" class="btn btn-danger"
                                                    data-id="{{ $customer->id }}" onclick="deletePost(event.target)"
                                                    id='btn_delete'>ลบ</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- content ด้านล่าง --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-secondary text-white" style="background-color: #91810B">
                    <div class="card-header d-flex justify-content-between">{{ __('รายชื่อที่สุ่มได้') }}
                        <a href="{{route('history.random')}}" class="btn btn-info">ประวัติการสุ่ม</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{-- <div id="timer"></div>
                        <input type="button" id="startx" value="start" /> --}}

                        <table class="table table-hover table-bordered table-striped table-dark" id="table_random">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่อ-สกุล</th>
                                    <th scope="col">ชื่อผู้ใช้</th>
                                    <th scope="col">เบอร์โทร</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (is_array($random_session) || is_object($random_session))
                                    @foreach ($random_session as $random)
                                        <tr id="{{ 'row_' . $random['id'] }}">
                                            <td class="align-middle">{{ $random['name'] }}</td>
                                            <td class="align-middle">{{ $random['username'] }}</td>
                                            <td class="align-middle">{{ $random['tel'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="post-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="text_addcus">เพิ่มรายชื่อ</h4>
                </div>
                <div class="modal-body">
                    <form name="userForm" class="form-horizontal">
                        <input type="hidden" name="post_id" id="post_id">
                        <div class="form-group">
                            <label for="name">ชื่อ-สกุล</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="กรุณากรอกชื่อ-สกุล ที่ไม่ตํ่ากว่า 6 ตัวอักษร และ ไม่เกิน 255 ตัวอักษร">
                                <span id="nameError" class="alert-message text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="กรุณากรอกชื่อผู้ใช้ ที่ไม่ตํ่ากว่า 6 ตัวอักษร และ ไม่เกิน 12 ตัวอักษร">
                                <span id="usernameError" class="alert-message text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="tel" name="tel"
                                    placeholder="กรุณากรอกเบอร์โทร 10 ตัวอักษร">
                                <span id="telError" class="alert-message text-danger"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="createPost()">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ModalRandom -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">สุ่มรายชื่อ</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {{-- <div align="center">
                        <span style="font-size: 16px; color: rgb(105, 165, 14)">สุ่มได้ คุณ: <span id="showName"></span>
                            !!!</span>
                    </div> --}}
                    <h1 id="headerNames">?</h1>
                    {{-- <div id="timerWrapper">Time left: <span id="timer"></span></div>
                    <div id="timesUp">
                        Time's Up!
                        <a href="https://codepen.io/screener13/pen/PJJLLo">RESET</a>
                    </div> --}}
                    <form id="formRandom">
                        <div class="form-group">
                            <label for="random">จำนวนที่ต้องการสุ่ม</label>
                            <input type="number" id="random" name="random" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="button" id="startButton">เริ่ม</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        "use strict";
        // Change to false if you don't want a timer
        const showTimer = true;
        // Set timer countdown time here in minutes : seconds format
        const time = 0 + ":" + 19;

        // Default variables
        let i = 0;
        let x = 0;
        let intervalHandle = null;
        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const headerOne = document.getElementById('headerNames');

        ///เริ่มกดปุ่ม
        startButton.addEventListener('click', function() {
            // $("#random").prop('disabled', true);
            // $("#save_changes").prop('disabled', true);
            var number = $("#random").val();
            let url = "{{ route('random') }}";
            let _token = $('meta[name="csrf-token"]').attr('content');
            console.log(number);
            var response;
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    number: number,
                    _token: _token,
                },
                success: function(res) {
                    // console.log(res);
                    if (res.code == "424") {
                        $("#random").prop('disabled', false);
                        $("#save_changes").prop('disabled', false);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.message,
                        })
                        // var list = [1, 2, 3, 4];
                    } else {
                        console.log(res);
                        //เริ่มคอมเม้น
                        startButton.style.pointerEvents = "none";
                        startButton.style.background = "grey";
                        // stopButton.style.display = "block";
                        let y = 0;
                        var data;
                        let index;
                        var counter = 0;
                        var arr_pass = [];
                        let _url = '{{ route('random.saveRandom') }}';
                        let _token = $('meta[name="csrf-token"]').attr('content');
                        // for (var x = 0, ln = number; x < ln; x++) {
                        //     setTimeout(function(y) {
                        intervalHandle = setInterval(() => {
                            y++
                            index = i++ % res.data.length
                            try {
                                headerNames.textContent = res.data[index].name;
                                data = res.data[index];

                            } catch (error) {}
                            if (y === 50) {
                                clearInterval(intervalHandle);
                                $.ajax({
                                    type: "POST",
                                    url: _url,
                                    data: {
                                        _token: _token,
                                        number: number,
                                    },
                                    success: function(res) {
                                        $('#table_random tbody').html("");
                                        startButton.style.pointerEvents = "auto";
                                        startButton.style.background = "#1fa91f";
                                        console.log(res)
                                        for (let index = 0; index < res.data
                                            .length; index++) {
                                            $('#table_random tbody').prepend(
                                                "<tr id=" + res.data[index].id +
                                                ">" +
                                                "<td class='align-middle'>" +
                                                res.data[index].name + "</td>" +
                                                "<td class='align-middle'>" +
                                                res.data[index].username +
                                                "</td>" +
                                                "<td class='align-middle'>" +
                                                res.data[index].tel + "</td>" +
                                                "</tr>"
                                            );
                                        }
                                        Swal.fire(
                                            'สำเร็จ!',
                                            'รายการสุ่มของท่านสำเร็จแล้ว',
                                            'success'
                                        )
                                    }
                                })
                            }
                        }, 50);

                        //จบคอมเม้น
                    }
                }
            });


        });

    </script>
@endsection

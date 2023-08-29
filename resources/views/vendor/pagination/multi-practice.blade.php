<!DOCTYPE html>
<html>


<head>

</head>



@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-between mt-5">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="btn btn-danger" href="#" tabindex="-1">Previous</a>
                </li>
            @else
                <li class="page-item"><a onclick="previous({{ $paginator->currentPage() }},{{ $paginator->lastPage() }})"
                        class="btn btn-danger" href="#">
                        <i class="bi bi-caret-left-fill"></i> Previous</a>
                </li>
            @endif

            {{-- <h3>{{ $paginator->lastPage() }}</h3>
            <h3>{{ $paginator->currentPage() }}</h3> --}}

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a id="btnNext" onclick="next({{ $paginator->currentPage() }},{{ $paginator->lastPage() }})"
                        class="btn btn-danger" href="#" rel="next">Next <i
                            class="bi bi-caret-right-fill"></i></a>
                </li>
            @else
                <li class="page-item disabled">
                    <a id="btnSubmit" onclick="submit({{ $paginator->currentPage() }})" class="btn btn-danger"
                        href="#">Submit</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
<script src="{{ url('assets/js/service.js') }}"></script>
<script>
    let api = new ApiService();
    let uans = 0;
    $(document).ready(function() {
        // let radio = $('input:radio[name="uans"]').is(":checked");
        var radio = $('input:radio[name="uans"]');
        if (radio.filter(':checked').length == 1) {
            uans = $(radio).val();

        }
        // uans = $(radio).val();
        $('input:radio[name="uans"]').change(function() {
            uans = $(this).val();
            // alert($(this).val())
            // let val = $(this).parent().find("input[type=text]").val()
            // $(this).val(val)

        });
    })

    function submit(id) {
        $("#btnSubmit").html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit`
        );
        var url = window.location.href;
        url = url.substr(0, url.lastIndexOf("?"));
        let slash = url.lastIndexOf('/');
        let exid = url.substring(slash + 1);


        var data = {
            "_token": "{{ csrf_token() }}",
            "exid": exid,
            "qid": $('#txtqid').val(),
            "seconds": mainSeconds,
            "uans": uans,

        };
        let req = api.setData(api.url() + "/practice/result", data);
        $("#btnSubmit").attr("disabled", true);
        req.then((res) => {
            if (res.status == true) {
                alert(res.message);
                // location.href = api.url() + "/result/" + exid;
                location.href = api.url() + "/home";
            } else {
                alert(res.message);
                location.reload();
            }
        });
    }

    async function next(id, last) {


        // if ($('#txtuans').val() != "") {
        //     if (id != last) {

        //         $("#btnNext").html(
        //             `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Next`
        //         );
        //         var url = window.location.href;
        //         url = url.substr(0, url.lastIndexOf("?"));
        //         let slash = url.lastIndexOf('/');
        //         let exid = url.substring(slash + 1);
        //         if (exid == "") {
        //             url = window.location.href;
        //             slash = url.lastIndexOf('/');
        //             exid = url.substring(slash + 1);
        //         }
        //         url += "?page=";
        //         url += id + 1;
        //         var data = {
        //             "_token": "{{ csrf_token() }}",
        //             "exid": exid,
        //             "qid": $('#txtqid').val(),
        //             "uans": $('#txtuans').val(),

        //         };
        //         let req = api.setData(api.url() + "/student/ans", data);
        //         $("#btnNext").attr("disabled", true);
        //         req.then((res) => {
        //             if (res.status == true) {

        //                 sessionStorage.setItem("sec", $('#txtime').text());
        //                 location.assign(url)
        //             } else {
        //                 alert(res.message);
        //                 location.reload();
        //             }
        //         });



        //     }
        // } else {

        //     if (id != last) {
        //         var url = window.location.href;
        //         url = url.substr(0, url.lastIndexOf("?"));
        //         let slash = url.lastIndexOf('/');
        //         let exid = url.substring(slash + 1);
        //         url += "?page=";
        //         url += id + 1;
        //         sessionStorage.setItem("sec", $('#txtime').text());
        //         location.assign(url)


        //     }

        // }


        $("#btnNext").html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Next`
        );
        var url = window.location.href;
        url = url.substr(0, url.lastIndexOf("?"));
        let slash = url.lastIndexOf('/');
        let exid = url.substring(slash + 1);
        if (exid == "") {
            url = window.location.href;
            slash = url.lastIndexOf('/');
            exid = url.substring(slash + 1);
        }
        url += "?page=";
        url += id + 1;
        // let uans = 0;
        // if ($('#txtuans').val() == null && $('#txtuans').val() == "") {
        //     uans = 0;
        // } else {
        //     uans = $('#txtuans').val()
        // }
        var data = {
            "_token": "{{ csrf_token() }}",
            "exid": exid,
            "qid": $('#txtqid').val(),
            "uans": uans,

        };
        let req = api.setData(api.url() + "/student/ans", data);
        $("#btnNext").attr("disabled", true);
        req.then((res) => {
            if (res.status == true) {

                // sessionStorage.setItem("sec", $('#txtime').text());
                location.assign(url)
            } else {
                alert(res.message);
                location.reload();
            }
        });






    }

    async function previous(id, last) {
        var url = window.location.href;
        url = url.substr(0, url.lastIndexOf("?"));
        url += "?page=";
        url += id - 1;
        // sessionStorage.setItem("sec", $('#txtime').text());
        location.assign(url)


    }
</script>

</html>

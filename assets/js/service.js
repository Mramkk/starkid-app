class ApiService {
    constructor() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    }
    url() {
        var getUrl = window.location;
        var baseurl = getUrl.origin;
        return getUrl.origin + '/' + getUrl.pathname.split('/')[1];
    }
    alignModal(ctx) {
        var modalDialog = $(ctx).find(".modal-dialog");

        // Applying the top margin on modal to align it vertically center
        modalDialog.css(
            "margin-top",
            Math.max(0, ($(window).height() - modalDialog.height()) / 2.5)
        );
    }
    modelShow(modelalign) {
        $(".modal").on("shown.bs.modal", modelalign);

        // Align modal when user resize the window
        $(window).on("resize", function () {
            $(".modal:visible").each(modelalign);
        });
        $("#myModal").modal({
            backdrop: "static",
            keyboard: false,
        });
    }
    setFormData(subUrl, form) {
        return Promise.resolve(
            $.ajax({
                url: subUrl,
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                cache: false,
            })
        );
    }
    setData(Url, data) {
        return Promise.resolve(
            $.ajax({
                url: Url,
                method: "POST",
                data: JSON.stringify(data),
                dataType: "json",
                contentType: "application/json;",
            })
        );
    }
    // setData(subUrl, data) {
    //     return Promise.resolve(
    //         $.ajax({
    //             url: subUrl,
    //             method: "POST",
    //             data: JSON.stringify(data),
    //             dataType: "json",
    //             contentType: "application/json;",
    //         })
    //     );
    // }
    getData(subUrl) {
        return Promise.resolve(
            $.ajax({
                url: "http://192.168.43.10/vridhi-api/api/" + subUrl,
                type: "GET",
            })
        );
    }

    login(form) {
        return Promise.resolve(
            $.ajax({
                url: "login",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                cache: false,
            })
        );
    }
    userLogin(form) {
        return Promise.resolve(
            $.ajax({
                url: "login",
                method: "POST",
                data: new FormData(form),
                contentType: false,
                processData: false,
                cache: false,
            })
        );
    }
    setAction(ctx, action) {
        $(ctx).append(
            '<input type="hidden" name="action" value="' + action + '" /> '
        );
    }
    setId(ctx, id) {
        $(ctx).append('<input type="hidden" name="id" value="' + id + '" /> ');
    }
    setStatus(ctx, status) {
        $(ctx).append(
            '<input type="hidden" name="status" value="' + status + '" /> '
        );
    }
    hideLoading() {
        $("#load").hide();
    }
    showLoading() {
        $("#load").show();
    }
    showMsg(msg) {
        $("#msg").text(msg);
    }
    hideBtnSmt() {
        $("#btnsmt").hide();
    }
    showBtnSmt() {
        $("#btnsmt").show();
    }
    showBtnGroup() {
        $("#btngroup").show();
    }
    hideBtnGroup() {
        $("#btngroup").hide();
    }
    statusLoad() {
        $("#txtstatus").append(
            $("<option>", { value: "Setect" }).text("Setect")
        );
        $("#txtstatus").append(
            $("<option>", { value: "Active" }).text("Active")
        );
        $("#txtstatus").append(
            $("<option>", { value: "Inactive" }).text("Inactive")
        );
    }
}

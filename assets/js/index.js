$(document).ready(function () {

    var sp = spInit();
    $('#btnAdd').click(function () {

        speakNow(sp, "Addition")
        sessionStorage.setItem('calc', "Addition");
        location.assign('setup')
    })
    $('#btnSub').click(function () {
        speakNow(sp, "Substraction")
        sessionStorage.setItem('calc', "Substraction");
        location.assign('setup')
    })
    $('#btnAS').click(function () {
        speakNow(sp, "Addition & Substraction")
        sessionStorage.setItem('calc', "Addition & Substraction");
        location.assign('setup')
    })
    $('#btnMul').click(function () {
        speakNow(sp, "Multiplication")
        sessionStorage.setItem('calc', "Multiplication");
        location.assign('setup')
    })
    $('#btnDvi').click(function () {
        speakNow(sp, "Division")
        sessionStorage.setItem('calc', "Division");
        location.assign('setup')
    })
    $('#btnRan').click(function () {
        speakNow(sp, "Random Numbers")
        sessionStorage.setItem('calc', "Random Numbers");
        location.assign('setup')
    })
})

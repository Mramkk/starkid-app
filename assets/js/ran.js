$(document).ready(function () {
    var calc = sessionStorage.getItem('calc');
    var digit = sessionStorage.getItem('digit');
    var sec = sessionStorage.getItem('sec');
    console.log(sec);
    $('#page-title').text(calc);
    var sp = spInit();

    if (digit == '1') {

        setInterval(function () {
            randomNum = randomIntFromInterval(0, 9);
            $('#num').text(randomNum)
            speakNow(sp, randomNum)
        }, 1000 * sec)
    } else if (digit == '2') {

        setInterval(function () {
            randomNum = randomIntFromInterval(10, 99);
            $('#num').text(randomNum)
            speakNow(sp, randomNum)
        }, 1000 * sec)
    } else if (digit == '1-2') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {
            if (i % 2 == 0) {
                randomNum = randomIntFromInterval(0, 9);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(10, 99)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }




        }, 1000 * sec)

    } else if (digit == '3') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {
            randomNum = randomIntFromInterval(100, 999);
            $('#num').text(randomNum)
            speakNow(sp, randomNum)

        }, 1000 * sec)

    } else if (digit == '1-3') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {
            if (i % 2 == 0) {
                randomNum = randomIntFromInterval(10, 99);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (i % 3 == 0) {
                randomNum = randomIntFromInterval(100, 999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(0, 9)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }
        }, 1000 * sec)

    }
    else if (digit == '4') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {



            if (randomNum.toString().length == 1) {
                randomNum = randomIntFromInterval(10, 99);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 2) {
                randomNum = randomIntFromInterval(100, 999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 3) {
                randomNum = randomIntFromInterval(1000, 9999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(0, 9)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }
        }, 1000 * sec)

    }
    else if (digit == '5') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {

            if (randomNum.toString().length == 1) {
                randomNum = randomIntFromInterval(10, 99);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 2) {
                randomNum = randomIntFromInterval(100, 999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 3) {
                randomNum = randomIntFromInterval(1000, 9999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 4) {
                randomNum = randomIntFromInterval(10000, 99999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(0, 9)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }
        }, 1000 * sec)

    }
    else if (digit == '6') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {

            if (randomNum.toString().length == 1) {
                randomNum = randomIntFromInterval(10, 99);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 2) {
                randomNum = randomIntFromInterval(100, 999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 3) {
                randomNum = randomIntFromInterval(1000, 9999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 4) {
                randomNum = randomIntFromInterval(10000, 99999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 5) {
                randomNum = randomIntFromInterval(100000, 999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(0, 9)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }
        }, 1000 * sec)

    }
    else if (digit == '7') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {

            if (randomNum.toString().length == 1) {
                randomNum = randomIntFromInterval(10, 99);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 2) {
                randomNum = randomIntFromInterval(100, 999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 3) {
                randomNum = randomIntFromInterval(1000, 9999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 4) {
                randomNum = randomIntFromInterval(10000, 99999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 5) {
                randomNum = randomIntFromInterval(100000, 999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 6) {
                randomNum = randomIntFromInterval(1000000, 9999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(0, 9)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }
        }, 1000 * sec)

    } else if (digit == '8') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {

            if (randomNum.toString().length == 1) {
                randomNum = randomIntFromInterval(10, 99);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 2) {
                randomNum = randomIntFromInterval(100, 999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 3) {
                randomNum = randomIntFromInterval(1000, 9999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 4) {
                randomNum = randomIntFromInterval(10000, 99999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 5) {
                randomNum = randomIntFromInterval(100000, 999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 6) {
                randomNum = randomIntFromInterval(1000000, 9999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 7) {
                randomNum = randomIntFromInterval(10000000, 99999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(0, 9)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }
        }, 1000 * sec)

    } else if (digit == '9') {
        var i = 0;
        var randomNum = 0;
        setInterval(function () {

            if (randomNum.toString().length == 1) {
                randomNum = randomIntFromInterval(10, 99);
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 2) {
                randomNum = randomIntFromInterval(100, 999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 3) {
                randomNum = randomIntFromInterval(1000, 9999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 4) {
                randomNum = randomIntFromInterval(10000, 99999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 5) {
                randomNum = randomIntFromInterval(100000, 999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 6) {
                randomNum = randomIntFromInterval(1000000, 9999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 7) {
                randomNum = randomIntFromInterval(10000000, 99999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else if (randomNum.toString().length == 8) {
                randomNum = randomIntFromInterval(100000000, 999999999)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            } else {
                randomNum = randomIntFromInterval(0, 9)
                $('#num').text(randomNum)
                speakNow(sp, randomNum)
                i++;
            }
        }, 1000 * sec)

    }

    // /////////////////////////////

})

function randomIntFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}


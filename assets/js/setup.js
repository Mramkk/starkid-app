
$(document).ready(function () {
    var calc = sessionStorage.getItem('calc');
    // const sec = $('#txtsecond').val();


    $('#cal').text(calc)
    $('#page-title').text(calc);
    if (calc == "Random Numbers") {
        $('#divSum').hide()
    }
    $('#btnstart').click(function () {
        const digit = $('#txtdigit').val();
        const sec = $('#txtsecond').val();
        if (calc == "Random Numbers") {
            sessionStorage.setItem('digit', digit)
            sessionStorage.setItem('sec', sec)
            location.assign('random-number')
            return
        }
        const sum = parseInt($('#txtsum').val())

        if ($('#txtdigit').val() == '1') {
            generateDigit(sum, sec, 1, 9)
        } else if ($('#txtdigit').val() == '2') {
            generateDigit(sum, sec, 10, 99)
        } else if ($('#txtdigit').val() == '1-2') {
            const nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {

                if (i % 2 == 0) {
                    randomNum = generateRandomNumber(1, 9)
                } else {
                    randomNum = generateRandomNumber(10, 99)
                }
                nums[i] = randomNum;


            }
            nums.sort(function () { return 0.5 - Math.random() });
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')




        } else if ($('#txtdigit').val() == '3') {
            generateDigit(sum, sec, 100, 999)
        } else if ($('#txtdigit').val() == '1-3') {
            const nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i % 2 == 0) {
                    if (i == 2) {
                        randomNum = generateRandomNumber(1, 9)
                    } else if (i == 4) {
                        randomNum = generateRandomNumber(10, 99)
                    } else {
                        randomNum = generateRandomNumber(100, 999)
                    }

                } else {
                    if (i == 1) {
                        randomNum = generateRandomNumber(100, 999)
                    } else if (i == 3) {
                        randomNum = generateRandomNumber(10, 99)
                    } else {
                        randomNum = generateRandomNumber(0, 9)
                    }

                }
                nums[i] = randomNum;

            }
            nums.sort(function () { return 0.5 - Math.random() });
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')
        } else if ($('#txtdigit').val() == '2-3') {
            const nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i % 2 == 0) {
                    if (i == 2) {
                        randomNum = generateRandomNumber(10, 99)
                    } else {
                        randomNum = generateRandomNumber(100, 999)
                    }

                } else {
                    if (i == 1) {
                        randomNum = generateRandomNumber(100, 999)

                    } else {
                        randomNum = generateRandomNumber(10, 99)
                    }

                }
                nums[i] = randomNum;

            }

            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')
        } else if ($('#txtdigit').val() == '4') {
            var nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i == 1) {
                    randomNum = generateRandomNumber(0, 9999)

                }

                if (i > 1) {

                    var num = nums[i - 1];
                    if (num.toString().length == 4) {
                        randomNum = generateRandomNumber(0, 999)
                    } else if (num.toString().length == 3) {
                        randomNum = generateRandomNumber(0, 99)
                    } else if (num.toString().length == 2) {
                        randomNum = generateRandomNumber(0, 9)
                    } else {
                        randomNum = generateRandomNumber(0, 9999)
                    }


                }
                nums[i] = randomNum;
            }

            var numstr = nums.toString().replaceAll(',', ' ')
            numstr = numstr.trim()
            var array = numstr.split(' ');
            nums = [];
            var newNum;
            for (var i = 1; i < array.length; i++) {
                nums[i] = array[Math.floor(Math.random() * array.length)];

            }
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')


        } else if ($('#txtdigit').val() == '5') {
            var nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i == 1) {
                    randomNum = generateRandomNumber(0, 99999)

                }

                if (i > 1) {

                    var num = nums[i - 1];
                    if (num.toString().length == 5) {
                        randomNum = generateRandomNumber(0, 9999)
                    }
                    else if (num.toString().length == 4) {
                        randomNum = generateRandomNumber(0, 999)
                    } else if (num.toString().length == 3) {
                        randomNum = generateRandomNumber(0, 99)
                    } else if (num.toString().length == 2) {
                        randomNum = generateRandomNumber(0, 9)
                    } else {
                        randomNum = generateRandomNumber(0, 99999)
                    }


                }
                nums[i] = randomNum;
            }

            var numstr = nums.toString().replaceAll(',', ' ')
            numstr = numstr.trim()
            var array = numstr.split(' ');
            nums = [];
            var newNum;
            for (var i = 1; i < array.length; i++) {
                nums[i] = array[Math.floor(Math.random() * array.length)];

            }
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')
        } else if ($('#txtdigit').val() == '6') {
            var nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i == 1) {
                    randomNum = generateRandomNumber(0, 999999)

                }

                if (i > 1) {

                    var num = nums[i - 1];
                    if (num.toString().length == 6) {
                        randomNum = generateRandomNumber(0, 99999)
                    }
                    else if (num.toString().length == 5) {
                        randomNum = generateRandomNumber(0, 9999)
                    }
                    else if (num.toString().length == 4) {
                        randomNum = generateRandomNumber(0, 999)
                    } else if (num.toString().length == 3) {
                        randomNum = generateRandomNumber(0, 99)
                    } else if (num.toString().length == 2) {
                        randomNum = generateRandomNumber(0, 9)
                    } else {
                        randomNum = generateRandomNumber(0, 999999)
                    }


                }
                nums[i] = randomNum;
            }

            var numstr = nums.toString().replaceAll(',', ' ')
            numstr = numstr.trim()
            var array = numstr.split(' ');
            nums = [];
            var newNum;
            for (var i = 1; i < array.length; i++) {
                nums[i] = array[Math.floor(Math.random() * array.length)];

            }
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')
        } else if ($('#txtdigit').val() == '7') {
            var nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i == 1) {
                    randomNum = generateRandomNumber(0, 9999999)

                }

                if (i > 1) {

                    var num = nums[i - 1];
                    if (num.toString().length == 7) {
                        randomNum = generateRandomNumber(0, 999999)
                    }
                    if (num.toString().length == 6) {
                        randomNum = generateRandomNumber(0, 99999)
                    }
                    else if (num.toString().length == 5) {
                        randomNum = generateRandomNumber(0, 9999)
                    }
                    else if (num.toString().length == 4) {
                        randomNum = generateRandomNumber(0, 999)
                    } else if (num.toString().length == 3) {
                        randomNum = generateRandomNumber(0, 99)
                    } else if (num.toString().length == 2) {
                        randomNum = generateRandomNumber(0, 9)
                    } else {
                        randomNum = generateRandomNumber(0, 9999999)
                    }


                }
                nums[i] = randomNum;
            }

            var numstr = nums.toString().replaceAll(',', ' ')
            numstr = numstr.trim()
            var array = numstr.split(' ');
            nums = [];
            var newNum;
            for (var i = 1; i < array.length; i++) {
                nums[i] = array[Math.floor(Math.random() * array.length)];

            }
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')
        } else if ($('#txtdigit').val() == '8') {
            var nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i == 1) {
                    randomNum = generateRandomNumber(0, 99999999)

                }

                if (i > 1) {

                    var num = nums[i - 1];
                    if (num.toString().length == 7) {
                        randomNum = generateRandomNumber(0, 9999999)
                    }
                    else if (num.toString().length == 6) {
                        randomNum = generateRandomNumber(0, 999999)
                    }
                    else if (num.toString().length == 5) {
                        randomNum = generateRandomNumber(0, 9999)
                    }
                    else if (num.toString().length == 4) {
                        randomNum = generateRandomNumber(0, 999)
                    } else if (num.toString().length == 3) {
                        randomNum = generateRandomNumber(0, 99)
                    } else if (num.toString().length == 2) {
                        randomNum = generateRandomNumber(0, 9)
                    } else {
                        randomNum = generateRandomNumber(0, 9999999)
                    }


                }
                nums[i] = randomNum;
            }

            var numstr = nums.toString().replaceAll(',', ' ')
            numstr = numstr.trim()
            var array = numstr.split(' ');
            nums = [];
            var newNum;
            for (var i = 1; i < array.length; i++) {
                nums[i] = array[Math.floor(Math.random() * array.length)];

            }
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')
        } else if ($('#txtdigit').val() == '9') {
            var nums = [];
            var randomNum = 0;
            for (var i = 1; i <= sum; i++) {
                if (i == 1) {
                    randomNum = generateRandomNumber(0, 999999999)

                }

                if (i > 1) {

                    var num = nums[i - 1];
                    if (num.toString().length == 8) {
                        randomNum = generateRandomNumber(0, 99999999)
                    }
                    else if (num.toString().length == 7) {
                        randomNum = generateRandomNumber(0, 9999999)
                    }
                    else if (num.toString().length == 6) {
                        randomNum = generateRandomNumber(0, 999999)
                    }
                    else if (num.toString().length == 5) {
                        randomNum = generateRandomNumber(0, 9999)
                    }
                    else if (num.toString().length == 4) {
                        randomNum = generateRandomNumber(0, 999)
                    } else if (num.toString().length == 3) {
                        randomNum = generateRandomNumber(0, 99)
                    } else if (num.toString().length == 2) {
                        randomNum = generateRandomNumber(0, 9)
                    } else {
                        randomNum = generateRandomNumber(0, 99999999)
                    }


                }
                nums[i] = randomNum;
            }

            var numstr = nums.toString().replaceAll(',', ' ')
            numstr = numstr.trim()
            var array = numstr.split(' ');
            nums = [];
            var newNum;
            for (var i = 1; i < array.length; i++) {
                nums[i] = array[Math.floor(Math.random() * array.length)];

            }
            let calc = sessionStorage.getItem('calc');
            sessionStorage.setItem('nums', nums)
            sessionStorage.setItem('sec', sec)
            sessionStorage.setItem('calc', calc)
            location.assign('sum')
        }


    })
})
function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}
function generateDigit(sum, sec, min, max) {
    const nums = [];
    for (var i = 1; i <= sum; i++) {
        var randomNum = generateRandomNumber(min, max);
        nums[i] = randomNum;
    }
    let calc = sessionStorage.getItem('calc');
    sessionStorage.setItem('nums', nums)
    sessionStorage.setItem('sec', sec)
    sessionStorage.setItem('calc', calc)
    location.assign('sum')

}


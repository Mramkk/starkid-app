
$(document).ready(function () {
    var sp = spInit();
    $('#ansDiv').hide();
    let nums = sessionStorage.getItem('nums');
    let sec = sessionStorage.getItem('sec');
    let calc = sessionStorage.getItem('calc');
    $('#page-title').text(calc);
    nums = nums.replaceAll(',', ' ')
    nums = nums.trim()
    var array = nums.split(' ');
    let len = array.length;
    let calcStr = "";






    $('#btnans').click(function () {
        // $('#nums').hide();
        let sum = 0;
        if (calc == "Addition") {
            calcStr = nums.replaceAll(' ', '+')
            var array = nums.split(' ');

            array.forEach(element => {
                sum += parseInt(element);
            });
        } else if (calc == "Substraction") {
            calcStr = nums.replaceAll(' ', '-')
            var array = nums.split(' ');
            sum = array.shift();
            array.forEach(element => {
                sum -= parseInt(element);
            });
        } else if (calc == "Multiplication") {
            calcStr = nums.replaceAll(' ', '*')
            var array = nums.split(' ');
            sum = array.shift();
            array.forEach(element => {
                sum *= parseInt(element);
            });
        } else if (calc == "Division") {
            calcStr = nums.replaceAll(' ', '/')
            var array = nums.split(' ');
            sum = array.shift();
            array.forEach(element => {
                sum /= parseInt(element);
                sum = Math.round(sum);
            });
        }


        $('#ansDiv').hide();
        //console.log(calcStr);
        $('#nums').text(calcStr);
        $('#txtans').text('Answer :' + " " + sum)

        if (sum.toString().substring(0, 1) == "-") {
            speakNow(sp, "Sum is minus" + sum);
        } else {
            speakNow(sp, "Sum is" + sum);
        }



    })

    for (let i = 0; i < array.length; i++) {
        task(i, len);
    }





    function task(i, len) {



        setTimeout(function () {

            speakNow(sp, array[i]);
            $('#nums').text(array[i]);

            if (i + 1 >= len) {

                $('#ansDiv').show();

            }

        }, 1000 * i * sec);

    }


})


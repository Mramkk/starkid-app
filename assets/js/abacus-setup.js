var digit = sessionStorage.getItem("digit");
console.log(digit);
var nums = generateCalc();
sessionStorage.setItem("nums", nums);
sessionStorage.setItem("digit", digit);
// var url = window.location.origin + '/' + window.location.pathname.split('/')[1] + '/';
// location.assign(url + "flash");

function generateRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function generateCalc() {
    var nums = null;
    if (digit == '1') {
        nums = generateRandomNumber(1, 9)

    } else if (digit == '2') {
        nums = generateRandomNumber(10, 99)

    } else if (digit == '3') {
        nums = generateRandomNumber(100, 999)

    } else if (digit == '4') {
        nums = generateRandomNumber(1000, 9999)

    } else if (digit == '5') {
        nums = generateRandomNumber(10000, 99999)
    } else if (digit == '6') {
        nums = generateRandomNumber(100000, 999999)

    } else if (digit == '7') {
        nums = generateRandomNumber(1000000, 9999999)

    } else if (digit == '8') {
        nums = generateRandomNumber(10000000, 99999999)

    } else if (digit == '9') {
        nums = generateRandomNumber(100000000, 999999999)

    }
    return nums;


}

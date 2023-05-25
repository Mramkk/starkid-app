let my = {}
var digit = sessionStorage.getItem("digit");
var nums = sessionStorage.getItem("nums");
let beadSize = 40, beadStroke = 'rgba(0,0,0,.25)', beadFill = 'radial-gradient(ellipse farthest-corner at 25px 10px, rgba(0,232,254,1),rgba(0,232,254,1))', rodStroke = '#333', rodThickness = 5, rodFill = '#fff', frameStroke = '#bf9573', frameThickness = 8
let widthResize = 0;
function init() {
    my.wd = digit * 80;
    my.ht = 180;
    let s = ''
    s += '<div id="abacus" style="position:relative; width:' + my.wd + 'px; height:0px; margin:auto; display:block;">'
    s += '</div>'
    docInsert(s)
    createHTML()
    my.abacus = new Abacus()
    if (nums != null) {
        console.log(nums);
        decChg(nums);
    }
}

// =======================================

function createHTML() {
    let wrapper = document.getElementById('abacus')
    wrapper.style.textAlign = 'center'
    let abacusBorder = createDiv({ width: my.wd + frameThickness * 2 + 'px', borderRadius: '6px', border: '8px outset ' + frameStroke, background: frameStroke, })
    let container = createDiv({ border: frameThickness + 'px inset ' + frameStroke, background: 'linear-gradient(to top left,rgb(252, 250, 248),rgb(252, 250, 248))', display: 'flex', borderRadius: '5px', position: 'relative', width: my.wd + 'px', })
    let divider = createDiv({ position: 'absolute', top: my.ht / 4 + 'px', left: 0 + 'px', width: my.wd - 2 + 'px', height: frameThickness + 'px', border: '1px solid rgba(0,0,0,.25)', background: frameStroke, boxShadow: '0px 5px 10px rgba(0,0,0,.25)', })
    // wrapper.appendChild(createInputHTML())
    for (let i = 0; i < digit; i++) { container.appendChild(createColumnHTML(i)) }
    container.appendChild(divider)
    abacusBorder.appendChild(container)
    wrapper.appendChild(abacusBorder)
}
function createInputHTML() {
    // let div = document.createElement('div')
    // div.innerHTML = '<input id="dec" class="input" style="font-size:28px; margin: 0 -40px 4px 0;" value="0" oninput="decChg()" onchange="decChg()"></input> '
    // return div
}
function decChg(str) {
    let div = document.getElementById('dec')
    my.abacus.setValue(str)
    refresh()
}
function createDiv(style) {
    let e = document.createElement('div')
    for (let s in style) { e.style[s] = style[s] }
    return e
}
function createBeadHTML(col, row) {
    let bead = createDiv({ background: beadFill, borderRadius: '43%', border: '1px solid ' + beadStroke, width: beadSize + 'px', height: beadSize / 2 + 'px', transition: 'all .5s', boxShadow: 'rgba(0,0,0,.2) -5px 5px 8px', cursor: 'pointer', })
    bead.id = 'bead-' + col + '-' + row
    bead.onclick = function () {
        my.abacus.toggleBead(col, row)
        document.getElementById('dec').value = my.abacus.getValue()
        refresh()
    }
    return bead
}
function createColumnHTML(idx) {
    let col = createDiv({ height: my.ht + 'px', border: '', position: 'relative', flex: 1, })
    let bar = createDiv({ width: rodThickness + 'px', height: my.ht - 5 + 'px', background: "#ffffff", border: '2px solid ' + rodStroke, position: 'absolute', left: '50%', transform: 'translateX(-50%)', boxShadow: '-5px 0px 10px rgba(0,0,0,.25)', })
    let top = createDiv({ position: 'absolute', top: 0, left: '50%', transform: 'translateX(-50%)', })
    let bottom = createDiv({ position: 'absolute', bottom: 0, left: '50%', transform: 'translateX(-50%)', })
    for (let i = 0; i < 5; i++) {
        let b = createBeadHTML(idx, i)
        if (i < 1) top.appendChild(b)
        else bottom.appendChild(b)
    }
    col.appendChild(bar)
    col.appendChild(top)
    col.appendChild(bottom)
    return col
}
function refresh() {
    for (let col = 0; col < my.abacus.columns.length; col++) {
        if (!my.abacus.columns[col]) {
            console.log('ERROR. COlumn does not exist')
            return
        }
        for (let row = 0; row < my.abacus.columns[col].length; row++) {
            let bead = document.getElementById('bead-' + col + '-' + row)
            let toggled = my.abacus.columns[col][row]
            // top bread touch translateY
            if (row < 1) { bead.style.transform = toggled ? 'translateY(25px)' : 'translateY(0px)' } else { bead.style.transform = toggled ? 'translateY(-48px)' : 'translateY(0px)' }
        }
    }
}
let Abacus = function () {
    function getDisplayStates(n) {
        let states = [[0, 0, 0, 0, 0], [0, 1, 0, 0, 0], [0, 1, 1, 0, 0], [0, 1, 1, 1, 0], [0, 1, 1, 1, 1], [1, 0, 0, 0, 0], [1, 1, 0, 0, 0], [1, 1, 1, 0, 0], [1, 1, 1, 1, 0], [1, 1, 1, 1, 1], [1, 0, 0, 0, 0], [1, 1, 0, 0, 0], [1, 1, 1, 0, 0], [1, 1, 1, 1, 0], [1, 1, 1, 1, 1], [1, 1, 1, 1, 1],]
        return states[n]
    }
    this.columns = []
    for (let i = 0; i < digit; i++) { this.columns.push([0, 0, 0, 0, 0]) }
    function colVal(arr) {
        let sum = 0
        for (let i = 0; i < arr.length; i++) {
            if (arr[i] == false) continue
            if (i < 1) sum += 5
            else sum += 1
        }
        return sum
    }
    function colState(val) { return getDisplayStates(val) }
    this.getValue = function () {
        let sum = 0
        for (let i = 0; i < this.columns.length; i++) {
            let place = Math.pow(10, this.columns.length - i - 1)
            sum += colVal(this.columns[i]) * place
        }
        return sum
    }
    this.setValue = function (n) {
        if (isNaN(n)) return
        let sum = n
        for (let i = 0; i < this.columns.length; i++) {
            let m = Math.pow(10, this.columns.length - i - 1)
            this.columns[i] = getDisplayStates(0)
            if (sum < m) { continue } else {
                let remainder = sum % m
                this.columns[i] = getDisplayStates((sum - remainder) / m)
                sum = remainder
            }
        }
        if (sum != 0) { console.log('Error: Number too large to display') }
    }
    this.toggleBead = function (col, row) {
        let arr = this.columns[col]
        let toggled = !arr[row]
        arr[row] = toggled
        if (row == 0 && toggled) { arr[1] = true } else if (row == 1 && !toggled) { arr[0] = false } else if (row > 1 && !toggled) { for (let i = arr.length - 1; i > row; i--) { arr[i] = false } } else if (row > 1 && toggled) { for (let i = row; i > 1; i--) { arr[i] = true } }
    }
}
function docInsert(s) {
    let div = document.createElement('div')
    div.innerHTML = s
    let script = document.currentScript
    script.parentElement.insertBefore(div, script)
}
init()

// COMPTABILITE

document.getElementById('toggle-ajouter-compta').addEventListener('click', () => {
    console.log('hello world')
    document.getElementById('inputform').classList.toggle('hidden');
})


function printTable() {
    var divToPrint = document.getElementById("table-compta");
    newWin = window.open("");
    newWin.document.write(divToPrint.innerHTML);
    newWin.print();
    // newWin.close();
}

const filterByDate = () => {
    let startDate = Date.parse(document.getElementById('start_date').value);
    let endDate = Date.parse(document.getElementById('end_date').value);
    if (startDate && endDate) {
        rowsToShow = data.map((el) => {
            //Get the date for each row and /Format to YYYY-MM-DD
            let date = Date.parse('20' + el.querySelector('.rdate').innerText.replace(/\s/g,'').split('-').reverse().join('-'));

            if (date >= startDate && date <= endDate) {
                el.classList.remove('hidden');
            } else {
              el.classList.add('hidden');
            }
        })
    }
    document.getElementById('totalRetrocession').innerText = totalRetroForThePeriod();
    document.getElementById('totalDay').innerText = totalForThePeriod();
  }

const totalForThePeriod = () => {
    if (!data.filter(el => !el.classList.contains('hidden')).length) return 0;
    return data.filter(el => !el.classList.contains('hidden'))
        .map(el => Number(el.querySelector('.totd').innerText))
        .reduce((a,b)=> a+b);
}

const totalRetroForThePeriod = () => {
    if (!data.filter(el => !el.classList.contains('hidden')).length) return 0;
    return data.filter(el => !el.classList.contains('hidden'))
        .map(el => Number(el.querySelector('.tret').innerText))
        .reduce((a,b)=> a+b);
}

let inputStartDate = document.getElementById('start_date');
let inputEndDate = document.getElementById('end_date');
let data = [...document.querySelectorAll('.data-row')];

inputStartDate.addEventListener('change', filterByDate);
inputEndDate.addEventListener('change', filterByDate);

filterByDate();
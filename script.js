const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')

let addWorkerButton = document.querySelector('#addWorkerButton');
let addWorkerDiv = document.querySelector('#addWorkerDiv');

let EditWorkerButton = document.querySelector('#EditWorkerButton');
let EditWorkerDiv = document.querySelector('#EditWorkerDiv');

let DelWorkerButton = document.querySelector('#DeleteWorkerButton');
let DelWorkerDiv = document.querySelector('#DeletetWorkerDiv');
//const inputs = document.documentElement.inputz;

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget)
        tabContents.forEach(tabContent => { tabContent.classList.remove('active')})
        tabs.forEach(tab => { tab.classList.remove('active')})
        
        target.classList.add('active')
        tab.classList.add('active')
    })

})


addWorkerButton.addEventListener('click', () =>{

    if(addWorkerDiv.style.display === 'none'){
        addWorkerDiv.style.display = 'block';
    }else{
        addWorkerDiv.style.display = 'none';
    }
})
EditWorkerButton.addEventListener('click', () =>{

    if(EditWorkerDiv.style.display === 'none'){
        EditWorkerDiv.style.display = 'block';
    }else{
        EditWorkerDiv.style.display = 'none';
    }
})
DelWorkerButton.addEventListener('click', () =>{

    if(DelWorkerDiv.style.display === 'none'){
        DelWorkerDiv.style.display = 'block';
    }else{
        DelWorkerDiv.style.display = 'none';
    }
})

function lettersOnly(input){
    var regex = /[^a-z]/gi;
    input.value=input.value.replace(regex, "");
}
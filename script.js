const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content')
let addWorkerButton = document.querySelector('#addWorkerButton');
let addWorkerDiv = document.querySelector('#addWorkerDiv');
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

function lettersOnly(input){
    var regex = /[^a-z]/gi;
    input.value=input.value.replace(regex, "");
}
const tabs = document.querySelectorAll('[content]')
const tabContent = document.querySelectorAll('[data-tab-content')

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.CDATA_SECTION_NODE.tabTarget)
        tabContent.forEach(tabContent => tabContent.classList.remove('active'))
        target.classList.add('active')
    })


})
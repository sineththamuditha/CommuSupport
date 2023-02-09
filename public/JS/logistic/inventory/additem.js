import { getData } from "../../request.js";
import {displayTable} from "../../components/table.js";

let addBtn = document.getElementById('addBtn');
let filterBtn = document.getElementById('filterBtn');
let closeBtn = document.getElementById('closeBtnDiv');
let itemForm = document.getElementById('itemForm');
let resultMsg = document.getElementById('resultMsg');
let inventoryDisplay = document.getElementById('inventoryDisplay');

let category = document.getElementById('category');
let activeSubcategory = '';
let subcategorySelectDivs = [];
let subcategorySelect = [];

let confirmBtn = document.getElementById('addToInventory');
let amount = document.getElementById('amount');

let filterCategory = document.getElementById('filterCategory');

prepareCategoryOptionArray();
prepareSubcategorySelectionArray();
addBtn.addEventListener('click', function() {
    show(itemForm);
});

closeBtn.addEventListener('click', function() {
    hide(itemForm);
});

category.addEventListener('change', function() {
    if(activeSubcategory !== '') {
        hide(subcategorySelectDivs[activeSubcategory]);
    }
    activeSubcategory = category.value;
    if(activeSubcategory !== '') {
        show(subcategorySelectDivs[activeSubcategory]);
    }
});

confirmBtn.addEventListener('click', async function() {
    resultMsg.innerHTML = "";
    if(verifyForm()) {
        let data = {
            subcategoryID: subcategorySelect[activeSubcategory].value,
            amount: amount.value };
        let array = await getData('./inventory/add', 'POST', { data:data });
        console.log(array);
        if(array['success']) {
            resultMsg.innerHTML = "Item added to inventory";
            resultMsg.style.color = "green";
            filterBtn.click();
        }
        else {
            resultMsg.innerHTML = "Item not added to inventory";
            resultMsg.style.color = "red";
        }
    }
});

filterBtn.addEventListener('click', async function() {
    let filters = {};
    if(filterCategory.value !== '') {
        filters['categoryID'] = filterCategory.value;
    }
    let array = await getData('./inventory/filter', 'POST', { filters: filters });
    let data = {
        headings: ['Item Name', 'Amount', 'Unit', 'Last Updated'],
        keys: ['subcategoryName', 'amount', 'scale', 'updatedTime'],
        data: array
    };
    displayTable(inventoryDisplay, data);
});


function verifyForm() {
    return required(category) && required(subcategorySelect[activeSubcategory]);
}

function required(element) {
    if(element.value === '') {
        element.nextElementSibling.innerHTML = "This field is required";
        return false;
    }
    element.nextElementSibling.innerHTML = "";
    return true;
}




function prepareCategoryOptionArray() {
    for(let i = 1; i < category.options.length; i++) {
        subcategorySelectDivs[category.options[i].value] = document.getElementById(category.options[i].value);
    }
}

function prepareSubcategorySelectionArray() {
    for( let key in subcategorySelectDivs) {
        subcategorySelect[key] = subcategorySelectDivs[key].getElementsByTagName('select')[0];
    }
}

function toggleHidden(element) {
    if(element.style.display === "none") {
        show(element);
    } else {
        hide(element);
    }
}

function hide(element) {
    element.style.display = "none";
}

function show(element) {
    element.style.display = "flex";
}
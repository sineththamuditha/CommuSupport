import {getData} from "../../request.js";
import {displayTable} from "../../components/table.js";
import flash from "../../flashmessages/flash.js";
import {PopUp} from "../../popup/popUp.js";
import togglePages from "../../togglePages.js";


const toggle = new togglePages(
                        [{btnId:'donations',pageId:'donationTable',title:''}]);

const donationTableDiv = document.getElementById('donationTable');

let filterOptions = document.getElementById('filterOptions');
let sortOptions = document.getElementById('sortOptions');

document.getElementById('filter').addEventListener('click', function(e) {
    if(filterOptions.style.display === 'block') {
        filterOptions.style.display = 'none';
    } else {
        filterOptions.style.display = 'block';
    }
    sortOptions.style.display = 'none';
});

document.getElementById('sort').addEventListener('click', function(e) {
    if(sortOptions.style.display === 'block') {
        sortOptions.style.display = 'none';
    } else {
        sortOptions.style.display = 'block';
    }
    filterOptions.style.display = 'none';
});

filterOptions.addEventListener('click', function(e) {
    e.stopPropagation();
});

sortOptions.addEventListener('click', function(e) {
    e.stopPropagation();
});

const filterBtn = document.getElementById('filterBtn');
const sortBtn = document.getElementById('sortBtn');
const searchBtn = document.getElementById('searchBtn');

const ccFilter = document.getElementById('ccFilter');
const itemFilter = document.getElementById('subcategoryFilter');

const dateSort = document.getElementById('dateSort');

const searchInput = document.getElementById('searchInput');

filterBtn.addEventListener('click', async function() {

    let filters = {};

    if(ccFilter.value) {
        filters['ccID'] = ccFilter.value;
    }

    if(itemFilter.value) {
        filters['item'] = itemFilter.value;
    }

    let sort = {DESC:[]};

    if(dateSort.checked) {
        sort['DESC'].push('date');
    }

    let search = '';

    if(searchInput.value) {
        search = searchInput.value;
    }

    let data = await getData('./donations/filter', 'post',{filters:filters, sortBy:sort, search:search});

    if(!data['status']) {
        flash.showMessage({type:'error', value:data['msg']});
        return;
    }

    toggle.removeNoData();

    const tableData = {
        headings: ["Create By", "Item", "Amount", "Date", "Donate To","Delivery Status"],
        keys: ["username", "subcategoryName", "amount", "date", "city","deliveryStatus",['','View','#',[],'donationID']],
        data: data['donations']
    }

    displayTable(donationTableDiv, tableData);

    toggle.checkNoData();

    filterOptions.style.display = 'none';
    sortOptions.style.display = 'none';

    // console.log(data);

    assignEventListeners();

});

sortBtn.addEventListener('click', async function() {
    filterBtn.click();
});

searchBtn.addEventListener('click', async function() {
    filterBtn.click();
});

function assignEventListeners() {

    const donationBtns = Array.from(document.getElementsByClassName('view'));

    donationBtns.forEach(function(btn) {
        btn.addEventListener('click', showDonationPopup)
    });

}

assignEventListeners();

const popup = new PopUp();

async function showDonationPopup(e) {

    const donationID = e.target.id;

    const result = await getData('./donation/popup', 'post', {donationID:donationID});

    console.log(result);

    if(!result['status']) {
        flash.showMessage({type:'error', value:result['msg']});
        return;
    }

    const donation = result['donation'];
    const deliveries = result['deliveries'];

    popup.clearPopUp();

    popup.setHeader('Donation Details');

    popup.startSplitDiv();
    popup.setBody(donation,['username','subcategoryName','date'],['Donated By','Item','Created Date']);
    popup.setBody(donation,['cc','amount'],['Donated To','Amount']);
    popup.endSplitDiv();

    popup.setDeliveryDetails(deliveries);

    popup.showPopUp();

}